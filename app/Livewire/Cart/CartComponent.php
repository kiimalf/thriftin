<?php

namespace App\Livewire\Cart;

use Livewire\Component;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartComponent extends Component
{
    public function remove($cartItemId)
    {
        $item = CartItem::where('user_id', Auth::id())->where('id', $cartItemId)->first();
        if ($item) {
            $item->delete();
            $this->dispatch('cart-updated');
        }
    }

    public function render()
    {
        $cartItems = CartItem::where('user_id', Auth::id())
            ->with(['product.primaryImage'])
            ->get();
            
        $subtotal = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        return view('livewire.cart.cart-component', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal
        ])->layout('layouts.app');
    }
}
