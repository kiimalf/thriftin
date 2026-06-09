<?php

namespace App\Livewire\Order;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class SellerOrderManager extends Component
{
    public $trackingNumbers = [];

    public function updateStatus($orderId, $status)
    {
        $order = Order::where('seller_id', Auth::id())->findOrFail($orderId);
        
        if ($status === 'processing' && $order->status === 'processing') {
            // Technically Midtrans moves to processing, so Seller confirms to 'packed' maybe? Wait, let's skip 'packed' and go to 'shipped' if they input tracking.
            // Let's allow seller to confirm order. Midtrans makes it processing.
        }

        // We'll let seller move from processing to shipped
    }
    
    public function shipOrder($orderId)
    {
        $order = Order::where('seller_id', Auth::id())->findOrFail($orderId);
        
        $trackingNumber = $this->trackingNumbers[$orderId] ?? null;
        
        $order->validate = [
            'trackingNumbers.'.$orderId => 'required|string|min:5'
        ];
        
        if ($trackingNumber) {
            $order->update([
                'status' => 'shipped',
                'tracking_number' => $trackingNumber
            ]);
            session()->flash('message', 'Order marked as shipped!');
        } else {
            session()->flash('error', 'Please input a tracking number first.');
        }
    }

    public function cancelOrder($orderId)
    {
        $order = Order::where('seller_id', Auth::id())->findOrFail($orderId);
        
        if ($order->status === 'processing') {
            $order->update(['status' => 'cancelled']);
            session()->flash('message', 'Order cancelled. Refund will be processed manually.');
        }
    }

    public function render()
    {
        $orders = Order::where('seller_id', Auth::id())
            ->where('status', '!=', 'pending_payment') // Sellers usually don't need to see unpaid unless they want to
            ->with(['product', 'buyer', 'shippingAddress'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.order.seller-order-manager', [
            'orders' => $orders
        ])->layout('layouts.app');
    }
}
