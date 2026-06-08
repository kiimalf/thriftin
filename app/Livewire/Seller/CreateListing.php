<?php

namespace App\Livewire\Seller;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CreateListing extends Component
{
    use WithFileUploads;

    public $title = '';
    public $description = '';
    public $price = '';
    public $condition = 'good';
    public $category_id = '';
    public $gender = '';
    public $size = '';
    public $brand = '';
    public $weight = '';
    public $images = [];

    public $previewMode = false;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'condition' => 'required|string|in:new,like_new,good,fair',
        'category_id' => 'required|exists:categories,id',
        'gender' => 'nullable|string|in:men,women,unisex,kids',
        'size' => 'nullable|string|max:50',
        'brand' => 'nullable|string|max:100',
        'weight' => 'nullable|numeric|min:0',
        'images.*' => 'image|max:5120', // 5MB Max
        'images' => 'required|array|min:1|max:8',
    ];

    public function preview()
    {
        $this->validate();
        $this->previewMode = true;
    }

    public function backToEdit()
    {
        $this->previewMode = false;
    }

    public function save($status = 'active')
    {
        $this->validate();

        $slug = Str::slug($this->title) . '-' . uniqid();

        $product = Product::create([
            'user_id' => Auth::id(),
            'title' => $this->title,
            'slug' => $slug,
            'description' => $this->description,
            'price' => $this->price,
            'condition' => $this->condition,
            'category_id' => $this->category_id,
            'gender' => $this->gender,
            'size' => $this->size,
            'brand' => $this->brand,
            'weight' => $this->weight,
            'status' => $status,
        ]);

        foreach ($this->images as $index => $image) {
            $path = $image->store('products', 'public');
            
            ProductImage::create([
                'product_id' => $product->id,
                'url' => '/storage/' . $path,
                'is_primary' => $index === 0,
                'order' => $index,
            ]);
        }

        session()->flash('message', $status === 'draft' ? 'Product saved as draft!' : 'Product listed successfully!');
        return redirect()->route('seller.dashboard');
    }

    public function removeImage($index)
    {
        array_splice($this->images, $index, 1);
    }

    public function render()
    {
        return view('livewire.seller.create-listing', [
            'categories' => Category::whereNull('parent_id')->with('children')->get(),
        ])->layout('layouts.app');
    }
}
