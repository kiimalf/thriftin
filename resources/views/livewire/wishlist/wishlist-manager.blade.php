<div class="bg-white min-h-screen">
    <!-- Header -->
    <div class="max-w-7xl mx-auto pt-10 pb-6 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">My Wishlist</h1>
                <p class="mt-1 text-sm text-gray-500">Items you've loved and saved for later.</p>
            </div>
            @if($wishlistItems->count() > 0)
                <span class="inline-flex items-center px-3 py-1 rounded-lg bg-gray-50 border border-gray-100 text-sm text-gray-600 font-medium">
                    {{ $wishlistItems->total() }} {{ Str::plural('item', $wishlistItems->total()) }}
                </span>
            @endif
        </div>
    </div>

    <div class="max-w-7xl mx-auto pb-12 px-4 sm:px-6 lg:px-8">
        @if($wishlistItems->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 xl:gap-6">
                @foreach($wishlistItems as $item)
                    <div class="relative group">
                        <x-product-card :product="$item->product" />
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $wishlistItems->links() }}
            </div>
        @else
            <!-- Empty Wishlist State -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm py-20 px-6 text-center max-w-md mx-auto">
                <div class="mx-auto w-16 h-16 rounded-2xl bg-red-50 flex items-center justify-center mb-5">
                    <svg class="h-8 w-8 text-red-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                    </svg>
                </div>
                <h3 class="text-base font-semibold text-gray-900">Your wishlist is empty</h3>
                <p class="mt-1.5 text-sm text-gray-500 leading-relaxed">Browse our catalog and tap the heart icon to save items you love.</p>
                <div class="mt-6">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-primary-600 text-white text-sm font-medium rounded-xl hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 shadow-sm transition-all duration-200">
                        Browse Products
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
