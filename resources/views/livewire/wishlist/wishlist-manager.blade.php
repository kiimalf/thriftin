<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-2xl font-bold leading-6 text-gray-900">My Wishlist</h3>
                        <p class="mt-2 text-sm text-gray-500">Items you've loved and saved for later.</p>
                    </div>
                </div>

                @if($wishlistItems->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-y-10 gap-x-6 xl:gap-x-8">
                        @foreach($wishlistItems as $item)
                            <div class="relative group">
                                <x-product-card :product="$item->product" />
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-8">
                        {{ $wishlistItems->links() }}
                    </div>
                @else
                    <div class="text-center py-16">
                        <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Your wishlist is empty</h3>
                        <p class="mt-2 text-sm text-gray-500">Browse our catalog and tap the heart icon to save items you love.</p>
                        <div class="mt-6">
                            <a href="{{ route('products.index') }}" class="inline-flex items-center rounded-md border border-transparent bg-primary-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                                Browse Products
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
