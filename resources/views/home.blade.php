<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Quality Preloved Fashion</span>
                            <span class="block text-primary-600">Better Finds, Better Prices</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Discover unique styles and sustainable fashion choices from our community of sellers. Shop smart, save money, and help the planet.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 md:py-4 md:text-lg md:px-10">
                                    Start Browsing
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-primary-700 bg-primary-100 hover:bg-primary-200 md:py-4 md:text-lg md:px-10">
                                    Start Selling
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 bg-gray-100 flex items-center justify-center overflow-hidden">
            <!-- Hero Image Placeholder -->
            <div class="grid grid-cols-2 gap-4 p-8 transform rotate-3 scale-105">
                <div class="space-y-4">
                    <div class="h-64 w-48 bg-gray-300 rounded-xl shadow-lg relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Fashion" class="absolute inset-0 w-full h-full object-cover">
                    </div>
                    <div class="h-48 w-48 bg-gray-300 rounded-xl shadow-lg relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Fashion" class="absolute inset-0 w-full h-full object-cover">
                    </div>
                </div>
                <div class="space-y-4 mt-8">
                    <div class="h-48 w-48 bg-gray-300 rounded-xl shadow-lg relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1571513722275-4b41e4050459?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Fashion" class="absolute inset-0 w-full h-full object-cover">
                    </div>
                    <div class="h-64 w-48 bg-gray-300 rounded-xl shadow-lg relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1550614000-4b95d4669f6b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Fashion" class="absolute inset-0 w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Trending Categories -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">Trending Categories</h2>
            
            <div class="mt-8 grid grid-cols-2 gap-y-6 gap-x-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:gap-x-8">
                @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="group relative flex flex-col items-center justify-center p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow border border-gray-100">
                    <span class="text-4xl mb-3">{{ $category->icon }}</span>
                    <span class="text-sm font-medium text-gray-900">{{ $category->name }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Featured Products -->
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">Featured Deals</h2>
                <a href="{{ route('products.index') }}" class="hidden sm:block text-sm font-semibold text-primary-600 hover:text-primary-500">
                    Browse all products <span aria-hidden="true">&rarr;</span>
                </a>
            </div>

            <div class="mt-8 grid grid-cols-2 gap-6 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                @foreach($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            <div class="mt-8 sm:hidden">
                <a href="{{ route('products.index') }}" class="block text-sm font-semibold text-primary-600 hover:text-primary-500">
                    Browse all products <span aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </div>
    </div>

    <!-- How it works -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">How ThriftIn Works</h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">Buying and selling preloved fashion has never been easier.</p>
            </div>

            <div class="mt-16">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    <div class="text-center">
                        <div class="flex items-center justify-center h-16 w-16 rounded-full bg-primary-100 text-primary-600 mx-auto">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <h3 class="mt-6 text-xl font-medium text-gray-900">1. Discover</h3>
                        <p class="mt-2 text-base text-gray-500">Find amazing deals on quality preloved items from our trusted community.</p>
                    </div>
                    <div class="text-center">
                        <div class="flex items-center justify-center h-16 w-16 rounded-full bg-primary-100 text-primary-600 mx-auto">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="mt-6 text-xl font-medium text-gray-900">2. Buy Securely</h3>
                        <p class="mt-2 text-base text-gray-500">Checkout safely with Midtrans. Your money is held securely until you receive the item.</p>
                    </div>
                    <div class="text-center">
                        <div class="flex items-center justify-center h-16 w-16 rounded-full bg-primary-100 text-primary-600 mx-auto">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h3 class="mt-6 text-xl font-medium text-gray-900">3. Enjoy</h3>
                        <p class="mt-2 text-base text-gray-500">Receive your items, leave a review, and look great while saving money and the planet.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Latest Articles -->
    @if(isset($recentArticles) && $recentArticles->count() > 0)
    <div class="bg-white py-16 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">Thrifting Tips & Stories</h2>
                    <p class="mt-2 text-base text-gray-500">Get the latest fashion advice, styling tips, and community stories.</p>
                </div>
                <a href="{{ route('blog.index') }}" class="text-sm font-semibold text-primary-600 hover:text-primary-500">
                    Read our blog <span aria-hidden="true">&rarr;</span>
                </a>
            </div>

            <div class="mt-8 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($recentArticles as $article)
                <article class="flex flex-col bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                    @if($article->image)
                        <div class="flex-shrink-0">
                            <img class="h-48 w-full object-cover" src="{{ $article->image_url }}" alt="{{ $article->title }}">
                        </div>
                    @else
                        <div class="flex-shrink-0 h-48 w-full bg-slate-100 flex items-center justify-center">
                            <svg class="h-12 w-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        </div>
                    @endif
                    <div class="flex-1 p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-primary-600">
                                <a href="{{ route('blog.index') }}" class="hover:underline">ThriftIn Blog</a>
                            </p>
                            <a href="{{ route('blog.show', $article->slug) }}" class="block mt-2">
                                <p class="text-xl font-semibold text-gray-900 line-clamp-2 hover:text-primary-600 transition-colors">{{ $article->title }}</p>
                                <p class="mt-3 text-base text-gray-500 line-clamp-3">{{ $article->excerpt ?? Str::limit(strip_tags($article->content), 120) }}</p>
                            </a>
                        </div>
                        <div class="mt-6 flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    @if($article->author->avatar)
                                        <img class="h-10 w-10 rounded-full object-cover border border-gray-200" src="{{ $article->author->avatar }}" alt="{{ $article->author->name }}">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold text-sm border border-primary-200">
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
                            <a href="{{ route('blog.show', $article->slug) }}" class="inline-flex items-center px-3 py-1.5 border border-primary-600 text-sm font-medium rounded-md text-primary-600 bg-white hover:bg-primary-50 transition-colors">
                                Read Article
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
            
        </div>
    </div>
    @endif
</x-app-layout>
