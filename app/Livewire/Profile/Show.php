<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\User;
use App\Models\Product;

class Show extends Component
{
    public User $user;
    public $activeTab = 'items'; // 'items' or 'reviews'

    public function mount(User $user)
    {
        // Count active products
        $this->user = $user->loadCount(['products' => function ($query) {
            $query->where('status', 'active');
        }]);
    }

    public function render()
    {
        $products = Product::where('user_id', $this->user->id)
            ->where('status', 'active')
            ->with('primaryImage')
            ->orderBy('created_at', 'desc')
            ->get();

        $reviews = $this->user->receivedReviews()
            ->with(['reviewer', 'product'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.profile.show', [
            'products' => $products,
            'reviews' => $reviews,
        ])->layout('layouts.app');
    }
}
