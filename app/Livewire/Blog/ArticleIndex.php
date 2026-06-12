<?php

namespace App\Livewire\Blog;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleIndex extends Component
{
    use WithPagination;

    public function render()
    {
        $featured = Article::with('author')
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->first();

        $articles = Article::with('author')
            ->where('status', 'published')
            ->when($featured, function($query) use ($featured) {
                $query->where('id', '!=', $featured->id);
            })
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        return view('livewire.blog.article-index', [
            'featured' => $featured,
            'articles' => $articles,
        ])->layout('layouts.app');
    }
}
