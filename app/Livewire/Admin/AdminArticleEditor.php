<?php

namespace App\Livewire\Admin;

use App\Models\Article;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class AdminArticleEditor extends Component
{
    public ?Article $article = null;
    
    public $title = '';
    public $slug = '';
    public $content = '';
    public $excerpt = '';
    public $status = 'draft';

    public function mount(?Article $article = null)
    {
        if ($article && $article->exists) {
            $this->article = $article;
            $this->title = $article->title;
            $this->slug = $article->slug;
            $this->content = $article->content;
            $this->excerpt = $article->excerpt;
            $this->status = $article->status;
        }
    }

    public function updatedTitle($value)
    {
        if (!$this->article || !$this->article->exists) {
            $this->slug = Str::slug($value);
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:articles,slug,' . ($this->article ? $this->article->id : 'NULL'),
            'content' => 'required',
            'status' => 'required|in:draft,published',
        ]);

        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'excerpt' => $this->excerpt,
            'status' => $this->status,
            'author_id' => auth()->id(),
        ];

        if ($this->status === 'published' && (!$this->article || !$this->article->published_at)) {
            $data['published_at'] = now();
        } elseif ($this->status === 'draft') {
            $data['published_at'] = null;
        }

        if ($this->article && $this->article->exists) {
            $this->article->update($data);
        } else {
            Article::create($data);
        }

        return redirect()->route('admin.articles.index');
    }

    public function render()
    {
        return view('livewire.admin.admin-article-editor');
    }
}
