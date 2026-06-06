<?php

namespace App\Livewire\Catalog;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductFilter extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $condition = '';
    public $gender = '';
    public $minPrice = '';
    public $maxPrice = '';
    public $sort = 'latest';

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'condition' => ['except' => ''],
        'gender' => ['except' => ''],
        'minPrice' => ['except' => ''],
        'maxPrice' => ['except' => ''],
        'sort' => ['except' => 'latest'],
    ];

    public function updating($name, $value)
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset(['search', 'category', 'condition', 'gender', 'minPrice', 'maxPrice', 'sort']);
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::with('primaryImage', 'seller')->where('status', 'active');

        if (!empty($this->search)) {
            $query->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
        }

        if (!empty($this->category)) {
            // Find category ID from slug
            $cat = Category::where('slug', $this->category)->first();
            if ($cat) {
                $query->where('category_id', $cat->id);
            }
        }

        if (!empty($this->condition)) {
            $query->where('condition', $this->condition);
        }

        if (!empty($this->gender)) {
            $query->where('gender', $this->gender);
        }

        if (!empty($this->minPrice)) {
            $query->where('price', '>=', $this->minPrice);
        }

        if (!empty($this->maxPrice)) {
            $query->where('price', '<=', $this->maxPrice);
        }

        switch ($this->sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'latest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        return view('livewire.catalog.product-filter', [
            'products' => $query->paginate(12),
            'categories' => Category::whereNull('parent_id')->get(),
        ])->layout('layouts.app');
    }
}
