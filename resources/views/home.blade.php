<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left animate-fade-in-up">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Quality Preloved Fashion</span>
                            <span class="block text-primary-600 mt-1">Better Finds, Better Prices</span>
                        </h1>
                        <p class="mt-4 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0 leading-relaxed">
                            Discover unique styles and sustainable fashion choices from our community of sellers. Shop smart, save money, and help the planet.
                        </p>
                        <div class="mt-8 sm:mt-10 sm:flex sm:justify-center lg:justify-start">
                            <div>
                                <a href="{{ route('products.index') }}" class="w-full flex items-center justify-center px-8 py-3.5 border border-transparent text-base font-semibold rounded-xl text-white bg-primary-600 hover:bg-primary-700 transition-all duration-200 shadow-sm hover:shadow-md md:py-4 md:text-lg md:px-10">
                                    Start Browsing
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-4">
                                <a href="{{ route('seller.dashboard') }}" class="w-full flex items-center justify-center px-8 py-3.5 border-2 border-primary-200 text-base font-semibold rounded-xl text-primary-700 bg-white hover:bg-primary-50 transition-all duration-200 md:py-4 md:text-lg md:px-10">
                                    Start Selling
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 bg-gray-50 flex items-center justify-center overflow-hidden">
            <!-- Hero Image Grid -->
            <div class="grid grid-cols-2 gap-4 p-8 transform rotate-3 scale-105">
                <div class="space-y-4">
                    <div class="h-64 w-48 bg-gray-100 rounded-2xl shadow-lg relative overflow-hidden">
                        <img src="{{ asset('images/hero/fashion-1.png') }}" alt="Fashion" class="absolute inset-0 w-full h-full object-cover img-zoom">
                    </div>
                    <div class="h-48 w-48 bg-gray-100 rounded-2xl shadow-lg relative overflow-hidden">
                        <img src="{{ asset('images/hero/fashion-2.png') }}" alt="Fashion" class="absolute inset-0 w-full h-full object-cover img-zoom">
                    </div>
                </div>
                <div class="space-y-4 mt-8">
                    <div class="h-48 w-48 bg-gray-100 rounded-2xl shadow-lg relative overflow-hidden">
                        <img src="{{ asset('images/hero/fashion-3.png') }}" alt="Fashion" class="absolute inset-0 w-full h-full object-cover img-zoom">
                    </div>
                    <div class="h-64 w-48 bg-gray-100 rounded-2xl shadow-lg relative overflow-hidden">
                        <img src="{{ asset('images/hero/fashion-4.png') }}" alt="Fashion" class="absolute inset-0 w-full h-full object-cover img-zoom">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Trending Categories -->
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center sm:text-left">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">Trending Categories</h2>
            </div>
            
            <div class="mt-8 grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
                @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="group relative flex flex-col items-center justify-center p-6 bg-white rounded-2xl border border-gray-100 hover:border-primary-200 hover:bg-primary-50/30 transition-all duration-200 card-hover">
                    <span class="text-4xl mb-3 group-hover:scale-110 transition-transform duration-200">{{ $category->icon }}</span>
                    <span class="text-sm font-medium text-gray-700 group-hover:text-primary-600 transition-colors">{{ $category->name }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Featured Products -->
    <div class="bg-gray-50/50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">Featured Deals</h2>
                <a href="{{ route('products.index') }}" class="hidden sm:inline-flex items-center text-sm font-semibold text-primary-600 hover:text-primary-700 transition-colors">
                    Browse all products <span class="ml-1" aria-hidden="true">&rarr;</span>
                </a>
            </div>

            <div class="mt-8 grid grid-cols-2 gap-4 sm:gap-6 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                @foreach($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            <div class="mt-8 sm:hidden text-center">
                <a href="{{ route('products.index') }}" class="inline-flex items-center text-sm font-semibold text-primary-600 hover:text-primary-700 transition-colors">
                    Browse all products <span class="ml-1" aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </div>
    </div>

    <!-- How it works -->
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">How ThriftIn Works</h2>
                <p class="mt-3 max-w-2xl text-lg text-gray-500 mx-auto">Buying and selling preloved fashion has never been easier.</p>
            </div>

            <div class="mt-16">
                <div class="grid grid-cols-1 gap-12 md:grid-cols-3">
                    <div class="text-center group">
                        <div class="flex items-center justify-center h-14 w-14 rounded-2xl bg-primary-50 text-primary-600 mx-auto group-hover:bg-primary-100 group-hover:scale-105 transition-all duration-200">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </div>
                        <h3 class="mt-6 text-lg font-semibold text-gray-900">1. Discover</h3>
                        <p class="mt-2 text-sm text-gray-500 leading-relaxed">Find amazing deals on quality preloved items from our trusted community.</p>
                    </div>
                    <div class="text-center group">
                        <div class="flex items-center justify-center h-14 w-14 rounded-2xl bg-primary-50 text-primary-600 mx-auto group-hover:bg-primary-100 group-hover:scale-105 transition-all duration-200">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                            </svg>
                        </div>
                        <h3 class="mt-6 text-lg font-semibold text-gray-900">2. Buy Securely</h3>
                        <p class="mt-2 text-sm text-gray-500 leading-relaxed">Checkout safely with Midtrans. Your money is held securely until you receive the item.</p>
                    </div>
                    <div class="text-center group">
                        <div class="flex items-center justify-center h-14 w-14 rounded-2xl bg-primary-50 text-primary-600 mx-auto group-hover:bg-primary-100 group-hover:scale-105 transition-all duration-200">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="mt-6 text-lg font-semibold text-gray-900">3. Enjoy</h3>
                        <p class="mt-2 text-sm text-gray-500 leading-relaxed">Receive your items, leave a review, and look great while saving money and the planet.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Latest Articles -->
    @if(isset($recentArticles) && $recentArticles->count() > 0)
    <div class="bg-gray-50/50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Thrifting Tips & Stories</h2>
                    <p class="mt-2 text-sm text-gray-500">Get the latest fashion advice, styling tips, and community stories.</p>
                </div>
                <a href="{{ route('blog.index') }}" class="hidden sm:inline-flex items-center text-sm font-semibold text-primary-600 hover:text-primary-700 transition-colors">
                    Read our blog <span class="ml-1" aria-hidden="true">&rarr;</span>
                </a>
            </div>

            <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($recentArticles as $article)
                <article class="flex flex-col bg-white rounded-2xl border border-gray-100 overflow-hidden card-hover">
                    @if($article->image)
                        <div class="flex-shrink-0 overflow-hidden">
                            <img class="h-48 w-full object-cover img-zoom" src="{{ $article->image_url }}" alt="{{ $article->title }}">
                        </div>
                    @else
                        <div class="flex-shrink-0 h-48 w-full bg-gray-50 flex items-center justify-center">
                            <svg class="h-12 w-12 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        </div>
                    @endif
                    <div class="flex-1 p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <p class="text-xs font-medium text-primary-600">
                                <a href="{{ route('blog.index') }}" class="hover:underline">ThriftIn Blog</a>
                            </p>
                            <a href="{{ route('blog.show', $article->slug) }}" class="block mt-2">
                                <p class="text-lg font-semibold text-gray-900 line-clamp-2 hover:text-primary-600 transition-colors">{{ $article->title }}</p>
                                <p class="mt-2 text-sm text-gray-500 line-clamp-3 leading-relaxed">{{ $article->excerpt ?? Str::limit(strip_tags($article->content), 120) }}</p>
                            </a>
                        </div>
                        <div class="mt-5 flex items-center">
                            <div class="flex space-x-1 text-xs text-gray-400">
                                <time datetime="{{ $article->published_at->format('Y-m-d') }}">
                                    {{ $article->published_at->format('M d, Y') }}
                                </time>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
            
        </div>
    </div>
    @endif
</x-app-layout>
