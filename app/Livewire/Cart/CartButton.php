<?php

namespace App\Livewire\Cart;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartButton extends Component
{
    public $count = 0;

    public function mount()
    {
        $this->updateCount();
    }

    #[On('cart-updated')]
    public function updateCount()
    {
        if (Auth::check()) {
            $this->count = CartItem::where('user_id', Auth::id())->sum('quantity');
        } else {
            $this->count = 0;
        }
    }

    public function render()
    {
        return view('livewire.cart.cart-button');
    }
}
