<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Seller routes
Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/sell', function () {
        return view('seller.dashboard');
    })->name('seller.dashboard');
});

// Buyer routes (placeholder for future milestones)
Route::middleware(['auth', 'role:buyer'])->group(function () {
    // Wishlist, cart, checkout, orders — to be added in Milestone 2+
});

require __DIR__.'/auth.php';
