<?php

namespace App\Livewire\Order;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class BuyerOrderList extends Component
{
    public function updateStatus($orderId, $status)
    {
        $order = Order::where('buyer_id', Auth::id())->findOrFail($orderId);
        
        // Buyer can only update to 'completed' or 'cancelled' (before payment)
        if ($status === 'completed' && $order->status === 'shipped') {
            $order->update(['status' => 'completed']);
            session()->flash('message', 'Order marked as completed. Thank you!');
        }
    }

    public function render()
    {
        $orders = Order::where('buyer_id', Auth::id())
            ->with(['product', 'seller'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.order.buyer-order-list', [
            'orders' => $orders
        ])->layout('layouts.app');
    }
}
