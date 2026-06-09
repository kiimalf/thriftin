<?php

namespace App\Livewire\Checkout;

use Livewire\Component;
use App\Models\CartItem;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CheckoutComponent extends Component
{
    public $addresses = [];
    public $selectedAddressId = null;
    
    // New Address Form
    public $showNewAddressForm = false;
    public $label, $recipient_name, $phone, $province, $city, $postal_code, $detail;

    // Shipping
    public $shippingCost = 15000; // Static dummy shipping cost for MVP
    public $shippingProvider = 'JNE Reguler';

    public function mount()
    {
        $this->loadAddresses();
        if ($this->addresses->count() > 0) {
            $this->selectedAddressId = $this->addresses->where('is_default', true)->first()->id ?? $this->addresses->first()->id;
        }
    }

    public function loadAddresses()
    {
        $this->addresses = Address::where('user_id', Auth::id())->get();
    }

    public function toggleNewAddressForm()
    {
        $this->showNewAddressForm = !$this->showNewAddressForm;
    }

    public function saveAddress()
    {
        $this->validate([
            'label' => 'required|string|max:100',
            'recipient_name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'province' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'detail' => 'required|string',
        ]);

        $address = Address::create([
            'user_id' => Auth::id(),
            'label' => $this->label,
            'recipient_name' => $this->recipient_name,
            'phone' => $this->phone,
            'province' => $this->province,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'detail' => $this->detail,
            'is_default' => $this->addresses->count() === 0, // Make default if it's the first one
        ]);

        $this->loadAddresses();
        $this->selectedAddressId = $address->id;
        $this->showNewAddressForm = false;
        
        $this->reset(['label', 'recipient_name', 'phone', 'province', 'city', 'postal_code', 'detail']);
    }

    public function processCheckout()
    {
        if (!$this->selectedAddressId) {
            session()->flash('error', 'Please select a shipping address.');
            return;
        }

        $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index');
        }

        // Since this is a marketplace, a buyer could checkout multiple products from different sellers.
        // For simplicity in this MVP, we create one order per product (split orders).
        // Midtrans SNAP token generation requires a single total amount, so we group them under a single transaction or handle them separately.
        // Actually, Midtrans can take multiple items in one transaction. 
        // But since `orders` table has `seller_id` and `product_id`, the DB schema implies one order = one product.
        // Let's create an order for the first item for now to match the PRD schema, or loop and create multiple orders.
        // Wait, if it's one transaction for multiple orders, we need a parent transaction table. 
        // We'll process only ONE item checkout for MVP or loop and create orders but payment will be complicated.
        // Let's create an Order for each cart item, and process payment for the total sum using a master Order ID.
        // Wait, I'll generate a single unique Midtrans Order ID for this checkout session and save it to all split orders.
        
        $midtransOrderId = 'TRX-' . time() . '-' . Auth::id();
        
        foreach ($cartItems as $item) {
            $totalPrice = ($item->product->price * $item->quantity) + $this->shippingCost;
            
            Order::create([
                'buyer_id' => Auth::id(),
                'seller_id' => $item->product->user_id,
                'product_id' => $item->product_id,
                'status' => 'pending_payment',
                'total_price' => $totalPrice,
                'shipping_cost' => $this->shippingCost,
                'shipping_provider' => $this->shippingProvider,
                'shipping_address_id' => $this->selectedAddressId,
                'midtrans_order_id' => $midtransOrderId,
            ]);
            
            // Delete from cart
            $item->delete();
        }

        // Redirect to payment page to generate snap token
        return redirect()->route('payment.checkout', ['order_id' => $midtransOrderId]);
    }

    public function render()
    {
        $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            // Can't checkout empty cart
            $subtotal = 0;
        } else {
            $subtotal = $cartItems->sum(function($item) {
                return $item->product->price * $item->quantity;
            });
        }
        
        // If there are multiple items, shipping cost multiplies in this dummy logic
        $totalShipping = $this->shippingCost * $cartItems->count();
        $total = $subtotal + $totalShipping;

        return view('livewire.checkout.checkout-component', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'totalShipping' => $totalShipping,
            'total' => $total,
        ])->layout('layouts.app');
    }
}
