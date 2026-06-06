<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Models\WishlistItem;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class WishlistButton extends Component
{
    public Product $product;
    public $isLoved = false;

    public function mount(Product $product)
    {
        $this->product = $product;
        
        if (Auth::check()) {
            $this->isLoved = WishlistItem::where('user_id', Auth::id())
                                         ->where('product_id', $this->product->id)
                                         ->exists();
        }
    }

    public function toggleWishlist()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($this->isLoved) {
            WishlistItem::where('user_id', Auth::id())
                        ->where('product_id', $this->product->id)
                        ->delete();
            $this->product->decrement('saves_count');
            $this->isLoved = false;
        } else {
            WishlistItem::create([
                'user_id' => Auth::id(),
                'product_id' => $this->product->id
            ]);
            $this->product->increment('saves_count');
            $this->isLoved = true;
        }
    }

    public function render()
    {
        return view('livewire.product.wishlist-button');
    }
}
