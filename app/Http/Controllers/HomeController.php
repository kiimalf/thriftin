<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the landing page.
     */
    public function index(): View
    {
        $categories = Category::whereNull('parent_id')->get();
        
        $featuredProducts = \App\Models\Product::with('primaryImage', 'seller')
                            ->where('status', 'active')
                            ->orderBy('created_at', 'desc')
                            ->take(8)
                            ->get();

        return view('home', [
            'categories' => $categories,
            'featuredProducts' => $featuredProducts,
        ]);
    }
}
