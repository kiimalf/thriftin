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

        return view('home', [
            'categories' => $categories,
        ]);
    }
}
