<?php

namespace App\Livewire\Order;

use Livewire\Component;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class OrderDetail extends Component
{
    public Order $order;
    
    // Review form properties
    public $rating = 5;
    public $comment = '';

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|min:5|max:500',
    ];

    public function mount(Order $order)
    {
        // Ensure the logged in user is the buyer or the seller of this order
        if ($order->buyer_id !== Auth::id() && $order->seller_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $order->load(['product.images', 'seller', 'shippingAddress', 'review']);
        $this->order = $order;
    }

    public function submitReview()
    {
        $this->validate();

        // Check if already reviewed
        if ($this->order->review) {
            session()->flash('error', 'You have already reviewed this order.');
            return;
        }

        // Only allow review if order is completed
        if ($this->order->status !== 'completed') {
            session()->flash('error', 'You can only review completed orders.');
            return;
        }

        if ($this->order->buyer_id !== Auth::id()) {
            session()->flash('error', 'Only the buyer can review this order.');
            return;
        }

        Review::create([
            'order_id' => $this->order->id,
            'reviewer_id' => Auth::id(),
            'seller_id' => $this->order->seller_id,
            'product_id' => $this->order->product_id,
            'rating' => $this->rating,
            'comment' => $this->comment,
        ]);

        // Recalculate seller average rating
        $seller = $this->order->seller;
        $newAvg = Review::where('seller_id', $seller->id)->avg('rating');
        $seller->update(['rating_avg' => $newAvg]);

        // Refresh the order to load the new review
        $this->order->load('review');
        
        session()->flash('message', 'Review submitted successfully! Thank you.');
    }

    public function render()
    {
        return view('livewire.order.order-detail')->layout('layouts.app');
    }
}
