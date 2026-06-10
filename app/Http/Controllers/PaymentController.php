<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production', false);
        \Midtrans\Config::$isSanitized = config('services.midtrans.is_sanitized', true);
        \Midtrans\Config::$is3ds = config('services.midtrans.is_3ds', true);
    }

    public function checkout(Request $request)
    {
        $midtransOrderId = $request->query('order_id');
        
        if (!$midtransOrderId) {
            return redirect()->route('cart.index')->with('error', 'Invalid Order ID');
        }

        // Get all orders with this midtrans ID for the current user
        $orders = Order::where('buyer_id', Auth::id())
                       ->where('midtrans_order_id', $midtransOrderId)
                       ->where('status', 'pending_payment')
                       ->with('product')
                       ->get();

        if ($orders->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Order not found or already paid');
        }

        $grossAmount = $orders->sum('total_price');
        $itemDetails = [];

        foreach ($orders as $order) {
            // Product item
            $itemDetails[] = [
                'id' => $order->product_id,
                'price' => $order->product->price,
                'quantity' => 1, // Assumption: Thrift items have quantity 1
                'name' => substr($order->product->title, 0, 50),
            ];
            
            // Shipping cost item
            if ($order->shipping_cost > 0) {
                $itemDetails[] = [
                    'id' => 'SHIPPING-' . $order->id,
                    'price' => $order->shipping_cost,
                    'quantity' => 1,
                    'name' => 'Shipping (' . $order->shipping_provider . ')',
                ];
            }
        }

        $params = [
            'transaction_details' => [
                'order_id' => $midtransOrderId,
                'gross_amount' => $grossAmount,
            ],
            'item_details' => $itemDetails,
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone ?? '081234567890',
            ],
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            
            return view('payment.checkout', [
                'snapToken' => $snapToken,
                'orders' => $orders,
                'grossAmount' => $grossAmount,
            ]);
            
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', 'Payment gateway error: ' . $e->getMessage());
        }
    }

    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        
        // Very basic signature validation for MVP
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        
        if ($hashed == $request->signature_key) {
            // Valid notification
            $transactionStatus = $request->transaction_status;
            $orderId = $request->order_id;
            
            $orders = Order::where('midtrans_order_id', $orderId)->get();
            
            if ($orders->isEmpty()) return response()->json(['message' => 'Order not found'], 404);

            $statusMap = [
                'capture' => 'processing',
                'settlement' => 'processing',
                'pending' => 'pending_payment',
                'deny' => 'cancelled',
                'expire' => 'cancelled',
                'cancel' => 'cancelled',
            ];

            $newStatus = $statusMap[$transactionStatus] ?? null;

            if ($newStatus) {
                foreach ($orders as $order) {
                    $order->update([
                        'status' => $newStatus,
                        'paid_at' => in_array($transactionStatus, ['capture', 'settlement']) ? now() : null,
                    ]);
                    
                    if (in_array($transactionStatus, ['capture', 'settlement'])) {
                        \App\Services\NotificationService::send(
                            $order->seller_id,
                            'order_update',
                            'New Order Received!',
                            "Your item '{$order->product->title}' has been paid. Please prepare for shipping.",
                            ['order_id' => $order->id, 'url' => '/sell/orders']
                        );
                    }
                }
            }
            
            return response()->json(['message' => 'Callback processed']);
        }
        
        return response()->json(['message' => 'Invalid signature'], 403);
    }
    
    public function success(Request $request)
    {
        $midtransOrderId = $request->query('order_id');
        return view('payment.success', compact('midtransOrderId'));
    }
}
