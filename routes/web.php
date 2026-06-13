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
Route::get('/profile/{user}', \App\Livewire\Profile\Show::class)->name('profile.show');

// Blog Routes
Route::get('/blog', \App\Livewire\Blog\ArticleIndex::class)->name('blog.index');
Route::get('/blog/{article:slug}', \App\Livewire\Blog\ArticleShow::class)->name('blog.show');

// Public Product Routes
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
    Route::get('/sell', \App\Livewire\Seller\ListingManager::class)->name('seller.dashboard');
    Route::get('/sell/create', CreateListing::class)->name('seller.products.create');
    Route::get('/sell/orders', \App\Livewire\Seller\ListingManager::class)->name('seller.orders.index');
    Route::get('/sell/{product}', \App\Livewire\Seller\ListingDetail::class)->name('seller.products.show');
    Route::get('/wishlist', WishlistManager::class)->name('wishlist.index');
    Route::get('/cart', \App\Livewire\Cart\CartComponent::class)->name('cart.index');
    Route::get('/checkout', \App\Livewire\Checkout\CheckoutComponent::class)->name('checkout.index');
    
    // Payment
    Route::get('/payment/checkout', [\App\Http\Controllers\PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::get('/payment/success', [\App\Http\Controllers\PaymentController::class, 'success'])->name('payment.success');

    // Orders
    Route::get('/orders', \App\Livewire\Order\BuyerOrderList::class)->name('orders.index');
    Route::get('/orders/{order}', \App\Livewire\Order\OrderDetail::class)->name('orders.show');

    // Notifications
    Route::get('/notifications', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/{id}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
});

require __DIR__.'/auth.php';

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', \App\Livewire\Admin\AdminDashboard::class)->name('dashboard');
    Route::get('/users', \App\Livewire\Admin\AdminUserManagement::class)->name('users.index');
    Route::get('/products', \App\Livewire\Admin\AdminProductModeration::class)->name('products.index');
    Route::get('/articles', \App\Livewire\Admin\AdminArticleManager::class)->name('articles.index');
    Route::get('/articles/create', \App\Livewire\Admin\AdminArticleEditor::class)->name('articles.create');
    Route::get('/articles/{article}/edit', \App\Livewire\Admin\AdminArticleEditor::class)->name('articles.edit');
    Route::post('/upload-image', [\App\Http\Controllers\Admin\ImageUploadController::class, 'upload'])->name('upload-image');
});
