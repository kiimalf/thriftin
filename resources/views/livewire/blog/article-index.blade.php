<div>
    <div class="bg-white py-12 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl">ThriftIn Blog</h1>
                <p class="mt-4 text-xl text-gray-500">Discover styling tips, sustainability practices, and the latest trends in the preloved fashion world.</p>
            </div>

            @if($featured)
            <!-- Featured Article -->
            <div class="mb-16">
                <div class="relative rounded-2xl overflow-hidden shadow-lg group block">
                    <div class="absolute inset-0">
                        @if($featured->image)
                            <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="{{ $featured->image }}" alt="{{ $featured->title }}">
                        @else
                            <div class="w-full h-full bg-slate-800 transition-transform duration-500 group-hover:scale-105 flex items-center justify-center">
                                <svg class="h-24 w-24 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                    </div>
                    <div class="relative p-8 sm:p-12 h-full flex flex-col justify-end min-h-[400px]">
                        <div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-500 text-white mb-4">
                                Featured
                            </span>
                            <a href="{{ route('blog.show', $featured->slug) }}" class="block">
                                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4 hover:underline">{{ $featured->title }}</h2>
                                <p class="text-lg text-gray-200 mb-6 max-w-3xl line-clamp-2">{{ $featured->excerpt ?? Str::limit(strip_tags($featured->content), 150) }}</p>
                            </a>
                            <div class="flex items-center">
                                @if($featured->author->avatar)
                                    <img class="h-10 w-10 rounded-full object-cover mr-3 border-2 border-white" src="{{ $featured->author->avatar }}" alt="{{ $featured->author->name }}">
                                @else
                                    <div class="h-10 w-10 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold text-sm mr-3 border-2 border-white">
                                        {{ substr($featured->author->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <p class="text-sm font-medium text-white">{{ $featured->author->name }}</p>
                                    <p class="text-sm text-gray-300">
                                        {{ $featured->published_at->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Article Grid -->
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($articles as $article)
                <article class="flex flex-col bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                    @if($article->image)
                        <div class="flex-shrink-0">
                            <img class="h-48 w-full object-cover" src="{{ $article->image }}" alt="{{ $article->title }}">
                        </div>
                    @else
                        <div class="flex-shrink-0 h-48 w-full bg-slate-100 flex items-center justify-center">
                            <svg class="h-12 w-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        </div>
                    @endif
                    <div class="flex-1 p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <a href="{{ route('blog.show', $article->slug) }}" class="block mt-2">
                                <p class="text-xl font-semibold text-gray-900 line-clamp-2 hover:text-primary-600 transition-colors">{{ $article->title }}</p>
                                <p class="mt-3 text-base text-gray-500 line-clamp-3">{{ $article->excerpt ?? Str::limit(strip_tags($article->content), 120) }}</p>
                            </a>
                        </div>
                        <div class="mt-6 flex items-center">
                            <div class="flex-shrink-0">
                                @if($article->author->avatar)
                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ $article->author->avatar }}" alt="{{ $article->author->name }}">
                                @else
                                    <div class="h-10 w-10 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold text-sm">
                                        {{ substr($article->author->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $article->author->name }}
                                </p>
                                <div class="flex space-x-1 text-sm text-gray-500">
                                    <time datetime="{{ $article->published_at->format('Y-m-d') }}">
                                        {{ $article->published_at->format('M d, Y') }}
                                    </time>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                @empty
                    @if(!$featured)
                    <div class="col-span-full text-center py-12">
                        <p class="text-lg text-gray-500">No articles published yet. Check back later!</p>
                    </div>
                    @endif
                @endforelse
            </div>

            <div class="mt-12">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</div>
