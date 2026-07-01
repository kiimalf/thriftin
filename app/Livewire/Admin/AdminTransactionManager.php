<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class AdminTransactionManager extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    
    // Properties for modal updating resi
    public $showUpdateModal = false;
    public $selectedOrderId = null;
    public $trackingNumber = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }
    
    public function openUpdateModal($orderId, $currentTrackingNumber)
    {
        $this->selectedOrderId = $orderId;
        $this->trackingNumber = $currentTrackingNumber;
        $this->showUpdateModal = true;
    }
    
    public function closeUpdateModal()
    {
        $this->showUpdateModal = false;
        $this->selectedOrderId = null;
        $this->trackingNumber = '';
    }

    public function updateReceipt()
    {
        $this->validate([
            'trackingNumber' => 'required|string|max:255',
        ]);
        
        $order = Order::find($this->selectedOrderId);
        
        if ($order) {
            $order->update([
                'tracking_number' => $this->trackingNumber,
                'status' => $order->status === 'packed' || $order->status === 'confirmed' ? 'shipped' : $order->status
            ]);
            
            session()->flash('success', 'Tracking number updated successfully.');
        }
        
        $this->closeUpdateModal();
    }

    public function render()
    {
        $orders = Order::with(['buyer', 'seller', 'product'])
            ->when($this->search, function ($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                      ->orWhere('midtrans_order_id', 'like', '%' . $this->search . '%')
                      ->orWhereHas('buyer', function ($q) {
                          $q->where('name', 'like', '%' . $this->search . '%');
                      })
                      ->orWhereHas('seller', function ($q) {
                          $q->where('name', 'like', '%' . $this->search . '%');
                      });
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.admin-transaction-manager', [
            'orders' => $orders
        ])->layout('layouts.admin');
    }
}
