<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class AdminProductModeration extends Component
{
    use WithPagination;

    public $search = '';
    public $status = 'all'; // all, active, sold, draft, taken_down

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => 'all'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function takeDown($productId)
    {
        $product = Product::findOrFail($productId);
        $product->status = 'taken_down';
        $product->save();
        $this->dispatch('product-updated');
    }

    public function restore($productId)
    {
        $product = Product::findOrFail($productId);
        $product->status = 'active';
        $product->save();
        $this->dispatch('product-updated');
    }

    public function render()
    {
        $query = Product::query()
            ->with(['seller', 'primaryImage', 'category'])
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->status !== 'all', function ($query) {
                $query->where('status', $this->status);
            })
            ->latest();

        return view('livewire.admin.admin-product-moderation', [
            'products' => $query->paginate(15)
        ]);
    }
}
