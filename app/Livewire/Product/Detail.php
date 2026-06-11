<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;

class Detail extends Component
{
    public Product $product;
    public $activeImage;

    public function mount(Product $product)
    {
        $this->product = $product->load('images', 'seller', 'category', 'reviews.reviewer');
        
        // Increase view count
        $sessionKey = 'viewed_product_' . $this->product->id;
        if (!session()->has($sessionKey)) {
            $this->product->increment('views_count');
            session()->put($sessionKey, true);
        }
        
        $this->activeImage = $this->product->primaryImage ? $this->product->primaryImage->url : null;
    }

    public function setActiveImage($url)
    {
        $this->activeImage = $url;
    }

    public function addToCart()
    {
        if (!\Illuminate\Support\Facades\Auth::check()) {
            return redirect()->route('login');
        }

        $cartItem = \App\Models\CartItem::firstOrCreate([
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'product_id' => $this->product->id,
        ]);

        if (!$cartItem->wasRecentlyCreated) {
            $cartItem->increment('quantity');
        }

        $this->dispatch('cart-updated');
        session()->flash('message', 'Product added to cart!');
    }

    public function render()
    {
        return view('livewire.product.detail', [
            'relatedProducts' => Product::where('category_id', $this->product->category_id)
                                        ->where('id', '!=', $this->product->id)
                                        ->where('status', 'active')
                                        ->with('primaryImage', 'seller')
                                        ->take(4)
                                        ->get()
        ])->layout('layouts.app');
    }
}
