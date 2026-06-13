<?php

namespace App\Livewire\Admin;

use App\Models\Article;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
class AdminArticleEditor extends Component
{
    use WithFileUploads;

    public ?Article $article = null;
    
    public $title = '';
    public $slug = '';
    public $content = '';
    public $excerpt = '';
    public $status = 'draft';
    public $image;
    public $existingImage;

    public function mount(?Article $article = null)
    {
        if ($article && $article->exists) {
            $this->article = $article;
            $this->title = $article->title;
            $this->slug = $article->slug;
            $this->content = $article->content;
            $this->excerpt = $article->excerpt;
            $this->status = $article->status;
            $this->existingImage = $article->image;
        }
    }

    public function updatedTitle($value)
    {
        if (!$this->article || !$this->article->exists) {
            $this->slug = Str::slug($value);
        }
    }

    public function removeImage()
    {
        $this->image = null;
    }

    public function removeExistingImage()
    {
        $this->existingImage = null;
    }

    public function save($status = null)
    {
        if ($status) {
            $this->status = $status;
        }

        $ignoreId = ($this->article && $this->article->exists) ? ',' . $this->article->id : '';

        $this->validate([
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:articles,slug' . $ignoreId,
            'content' => 'required',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,gif,bmp,svg,webp,avif|max:5120',
        ]);

        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'excerpt' => $this->excerpt,
            'status' => $this->status,
            'author_id' => auth()->id() ?? 1, // Fallback to 1 just in case
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('articles', 'public');
        } elseif ($this->existingImage === null) {
            $data['image'] = null; // Removed existing image
        }

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
