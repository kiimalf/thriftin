<?php

namespace App\Livewire\Wishlist;

use App\Models\WishlistItem;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class WishlistManager extends Component
{
    use WithPagination;

    public function remove($wishlistItemId)
    {
        $item = WishlistItem::where('id', $wishlistItemId)
                            ->where('user_id', Auth::id())
                            ->first();
                            
        if ($item) {
            $item->product->decrement('saves_count');
            $item->delete();
        }
    }

    public function render()
    {
        $wishlistItems = WishlistItem::where('user_id', Auth::id())
                                     ->with(['product.primaryImage', 'product.seller'])
                                     ->latest()
                                     ->paginate(12);

        return view('livewire.wishlist.wishlist-manager', [
            'wishlistItems' => $wishlistItems
        ])->layout('layouts.app');
    }
}
