<?php

namespace App\Livewire\Seller;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class ListingManager extends Component
{
    use WithPagination;

    #[\Livewire\Attributes\Url(as: 'status')]
    public $statusFilter = 'active'; // processing, shipped, active, sold, draft
    
    public $trackingNumbers = [];

    public function mount()
    {
        if (request()->routeIs('seller.orders.index') && !request()->has('status')) {
            $this->statusFilter = 'processing';
        }
    }

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

    public function shipOrder($orderId)
    {
        $order = Order::where('seller_id', Auth::id())->findOrFail($orderId);
        
        $trackingNumber = $this->trackingNumbers[$orderId] ?? null;
        
        $this->validate([
            'trackingNumbers.'.$orderId => 'required|string|min:5'
        ]);
        
        if ($trackingNumber) {
            $order->update([
                'status' => 'shipped',
                'tracking_number' => $trackingNumber
            ]);
            
            \App\Services\NotificationService::send(
                $order->buyer_id,
                'order_update',
                'Order Shipped!',
                "Your order '{$order->product->title}' has been shipped. Resi: {$trackingNumber}",
                ['order_id' => $order->id, 'url' => '/orders']
            );
            
            session()->flash('message', 'Order marked as shipped!');
        } else {
            session()->flash('error', 'Please input a tracking number first.');
        }
    }

    public function cancelOrder($orderId)
    {
        $order = \App\Models\Order::where('seller_id', Auth::id())->findOrFail($orderId);
        
        if ($order->status === 'processing') {
            $order->update(['status' => 'cancelled']);
            session()->flash('message', 'Order cancelled. Refund will be processed manually.');
        }
    }

    public function render()
    {
        $products = collect();
        $orders = collect();
        $isOrderTab = in_array($this->statusFilter, ['processing', 'shipped', 'sold', 'completed']);

        if ($isOrderTab) {
            $query = \App\Models\Order::where('seller_id', Auth::id())
                ->with(['product', 'buyer', 'shippingAddress'])
                ->orderBy('created_at', 'desc');
                
            $orderStatus = $this->statusFilter === 'sold' ? 'completed' : $this->statusFilter;
            $query->where('status', $orderStatus);
            
            $orders = $query->paginate(10);
        } else {
            $query = Product::where('user_id', Auth::id())
                ->with(['primaryImage', 'category', 'orders' => function($q) {
                    $q->latest();
                }])
                ->orderBy('created_at', 'desc');

            if ($this->statusFilter !== 'all') {
                $query->where('status', $this->statusFilter);
            }
            
            $products = $query->paginate(10);
        }

        return view('livewire.seller.listing-manager', [
            'products' => $products,
            'orders' => $orders,
            'isOrderTab' => $isOrderTab,
            'activeCount' => Product::where('user_id', Auth::id())->where('status', 'active')->count(),
            'processCount' => Order::where('seller_id', Auth::id())->where('status', 'processing')->count(),
            'shippingCount' => Order::where('seller_id', Auth::id())->where('status', 'shipped')->count(),
            'soldCount' => Product::where('user_id', Auth::id())->where('status', 'sold')->count(),
        ])->layout('layouts.app');
    }
}
