<?php

namespace App\Livewire\Blog;

use App\Models\Article;
use Livewire\Component;

class ArticleShow extends Component
{
    public Article $article;

    public function mount(Article $article)
    {
        if ($article->status !== 'published') {
            abort(404);
        }
        
        $this->article = $article;
    }

    public function render()
    {
        // Get some related articles (just recent ones for now)
        $relatedArticles = Article::with('author')
            ->where('status', 'published')
            ->where('id', '!=', $this->article->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('livewire.blog.article-show', [
            'relatedArticles' => $relatedArticles,
        ])->layout('layouts.app');
    }
}
