<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;

class Detail extends Component
{
    public Product $product;
    public $activeImage;

    public function mount(Product $product)
    {
        $this->product = $product->load('images', 'seller', 'category', 'reviews.reviewer');
        
        // Increase view count
        $this->product->increment('views_count');
        
        $this->activeImage = $this->product->primaryImage ? $this->product->primaryImage->url : null;
    }

    public function setActiveImage($url)
    {
        $this->activeImage = $url;
    }

    public function render()
    {
        return view('livewire.product.detail', [
            'relatedProducts' => Product::where('category_id', $this->product->category_id)
                                        ->where('id', '!=', $this->product->id)
                                        ->where('status', 'active')
                                        ->with('primaryImage', 'seller')
                                        ->take(4)
                                        ->get()
        ])->layout('layouts.app');
    }
}
