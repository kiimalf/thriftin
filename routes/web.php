<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Catalog\ProductFilter;
use App\Livewire\Product\Detail;
use App\Livewire\Wishlist\WishlistManager;
use App\Livewire\Seller\ListingManager;
use App\Livewire\Seller\CreateListing;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Catalog
Route::get('/products', ProductFilter::class)->name('products.index');
Route::get('/products/{product}', Detail::class)->name('products.show');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Unified authenticated routes (formerly split by seller/buyer)
Route::middleware('auth')->group(function () {
    Route::get('/sell', ListingManager::class)->name('seller.dashboard');
    Route::get('/sell/create', CreateListing::class)->name('seller.products.create');
    Route::get('/wishlist', WishlistManager::class)->name('wishlist.index');
    Route::get('/cart', \App\Livewire\Cart\CartComponent::class)->name('cart.index');
    Route::get('/checkout', \App\Livewire\Checkout\CheckoutComponent::class)->name('checkout.index');
    
    // Payment
    Route::get('/payment/checkout', [\App\Http\Controllers\PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::get('/payment/success', [\App\Http\Controllers\PaymentController::class, 'success'])->name('payment.success');

    // Orders
    Route::get('/orders', \App\Livewire\Order\BuyerOrderList::class)->name('orders.index');
    Route::get('/sell/orders', \App\Livewire\Order\SellerOrderManager::class)->name('seller.orders.index');
});

require __DIR__.'/auth.php';
