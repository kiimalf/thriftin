<?php

namespace App\Livewire\Seller;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ListingManager extends Component
{
    use WithPagination;

    public $statusFilter = 'active'; // active, sold, draft

    public function setStatusFilter($status)
    {
        $this->statusFilter = $status;
        $this->resetPage();
    }

    public function publishListing($id)
    {
        $product = Product::where('user_id', Auth::id())->findOrFail($id);
        if ($product->status === 'draft') {
            $product->update(['status' => 'active']);
            session()->flash('message', 'Listing published successfully!');
        }
    }

    public function deleteListing($id)
    {
        $product = Product::where('user_id', Auth::id())->findOrFail($id);
        $product->delete();
        session()->flash('message', 'Listing deleted successfully!');
    }

    public function render()
    {
        $query = Product::where('user_id', Auth::id())
                        ->with('primaryImage', 'category')
                        ->orderBy('created_at', 'desc');

        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        return view('livewire.seller.listing-manager', [
            'products' => $query->paginate(10),
            'activeCount' => Product::where('user_id', Auth::id())->where('status', 'active')->count(),
            'soldCount' => Product::where('user_id', Auth::id())->where('status', 'sold')->count(),
        ])->layout('layouts.app', ['header' => view('components.seller-header')]);
    }
}
