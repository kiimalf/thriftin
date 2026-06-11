<?php

namespace App\Livewire\Seller;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ListingDetail extends Component
{
    public Product $product;

    public function mount(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $this->product = $product->loadCount('wishlistItems')->load('images');
    }

    public function render()
    {
        // Calculate Conversion Rate
        $ordersCount = \App\Models\Order::where('product_id', $this->product->id)->count();
        $conversionRate = $this->product->views_count > 0 
            ? round(($ordersCount / $this->product->views_count) * 100, 2) 
            : 0;

        // Get buyer info per order
        $orders = \App\Models\Order::where('product_id', $this->product->id)
            ->with('buyer')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.seller.listing-detail', [
            'ordersCount' => $ordersCount,
            'conversionRate' => $conversionRate,
            'savesCount' => $this->product->wishlist_items_count,
            'orders' => $orders
        ])->layout('layouts.app');
    }
}
