<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class AdminDashboard extends Component
{
    public function render()
    {
        $totalUsers = User::count();
        $activeProducts = Product::where('status', 'active')->count();
        $successfulOrders = Order::where('status', 'delivered')->count();
        $gmv = Order::where('status', 'delivered')->sum('total_price');

        $recentOrders = Order::with(['buyer', 'product'])
            ->latest()
            ->take(5)
            ->get();

        $recentUsers = User::latest()
            ->take(5)
            ->get();

        return view('livewire.admin.admin-dashboard', [
            'totalUsers' => $totalUsers,
            'activeProducts' => $activeProducts,
            'successfulOrders' => $successfulOrders,
            'gmv' => $gmv,
            'recentOrders' => $recentOrders,
            'recentUsers' => $recentUsers,
        ]);
    }
}
