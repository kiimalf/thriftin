<div>
    @section('title', $article->title)

    <!-- Article Header -->
    <div class="bg-white pt-16 pb-8 sm:pt-24 sm:pb-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-100 text-primary-800 mb-6">
                Blog
            </span>
            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl mb-6">{{ $article->title }}</h1>
            
            @if($article->excerpt)
            <p class="text-xl text-gray-500 mb-8">{{ $article->excerpt }}</p>
            @endif

            <div class="flex items-center justify-center">
                @if($article->author->avatar)
                    <img class="h-12 w-12 rounded-full object-cover mr-4" src="{{ $article->author->avatar }}" alt="{{ $article->author->name }}">
                @else
                    <div class="h-12 w-12 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold text-lg mr-4">
                        {{ substr($article->author->name, 0, 1) }}
                    </div>
                @endif
                <div class="text-left">
                    <p class="text-base font-medium text-gray-900">{{ $article->author->name }}</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <time datetime="{{ $article->published_at->format('Y-m-d') }}">{{ $article->published_at->format('F d, Y') }}</time>
                        <span class="mx-2">&middot;</span>
                        <span>{{ ceil(str_word_count(strip_tags($article->content)) / 200) }} min read</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Image -->
    @if($article->image)
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
        <div class="aspect-w-16 aspect-h-9 rounded-2xl overflow-hidden shadow-lg bg-gray-100">
            <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
        </div>
    </div>
    @endif

    <!-- Article Content -->
    <div class="bg-white pb-16 sm:pb-24">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg prose-primary mx-auto text-gray-800">
                {!! $article->content !!}
            </div>
            
            <div class="mt-16 pt-8 border-t border-gray-200">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center font-medium text-primary-600 hover:text-primary-500">
                    <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path></svg>
                    Back to all articles
                </a>
            </div>
        </div>
    </div>

    <!-- Related Articles -->
    @if($relatedArticles->count() > 0)
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-extrabold tracking-tight text-gray-900 mb-8">Read next</h2>
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($relatedArticles as $related)
                <article class="flex flex-col bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                    @if($related->image)
                        <div class="flex-shrink-0">
                            <img class="h-48 w-full object-cover" src="{{ $related->image }}" alt="{{ $related->title }}">
                        </div>
                    @else
                        <div class="flex-shrink-0 h-48 w-full bg-slate-100 flex items-center justify-center">
                            <svg class="h-12 w-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        </div>
                    @endif
                    <div class="flex-1 p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <a href="{{ route('blog.show', $related->slug) }}" class="block mt-2">
                                <p class="text-xl font-semibold text-gray-900 line-clamp-2 hover:text-primary-600 transition-colors">{{ $related->title }}</p>
                                <p class="mt-3 text-base text-gray-500 line-clamp-3">{{ $related->excerpt ?? Str::limit(strip_tags($related->content), 120) }}</p>
                            </a>
                        </div>
                        <div class="mt-6 flex items-center">
                            <div class="flex-shrink-0">
                                @if($related->author->avatar)
                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ $related->author->avatar }}" alt="{{ $related->author->name }}">
                                @else
                                    <div class="h-10 w-10 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold text-sm">
                                        {{ substr($related->author->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $related->author->name }}
                                </p>
                                <div class="flex space-x-1 text-sm text-gray-500">
                                    <time datetime="{{ $related->published_at->format('Y-m-d') }}">
                                        {{ $related->published_at->format('M d, Y') }}
                                    </time>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
