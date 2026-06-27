<?php

namespace App\Livewire;

use Livewire\Component;

class SearchBar extends Component
{
    public string $query = '';

    public function search()
    {
        if (trim($this->query) !== '') {
            return redirect()->route('products.index', ['search' => $this->query]);
        }
    }

    public function render()
    {
        return view('livewire.search-bar');
    }
}
