<?php

namespace App\Livewire\Admin;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class AdminArticleManager extends Component
{
    use WithPagination;

    public $search = '';
    public $status = 'all'; // all, published, draft

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => 'all'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        Article::findOrFail($id)->delete();
        $this->dispatch('article-deleted');
    }

    public function render()
    {
        $query = Article::query()
            ->with('author')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->status !== 'all', function ($query) {
                $query->where('status', $this->status);
            })
            ->latest();

        return view('livewire.admin.admin-article-manager', [
            'articles' => $query->paginate(15)
        ]);
    }
}
