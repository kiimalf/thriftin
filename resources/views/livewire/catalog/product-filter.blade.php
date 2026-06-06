<div class="bg-gray-50">
    <!-- Header -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">Thrift Catalog</h1>
            <p class="mt-2 text-sm text-gray-500">Find the best preloved fashion deals.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-row gap-8 items-start relative">
            
            <!-- Sidebar Filters (Left) -->
            <div class="w-64 flex-shrink-0 space-y-6 sticky top-24 max-h-[calc(100vh-6rem)] overflow-y-auto pr-4 hidden md:block">
                <div>
                    <h3 class="font-medium text-gray-900">Search</h3>
                    <div class="mt-2">
                        <input type="text" wire:model.live.debounce.500ms="search" placeholder="Search keywords..." class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                    </div>
                </div>

                <div>
                    <h3 class="font-medium text-gray-900">Category</h3>
                    <div class="mt-2 space-y-2">
                        <div class="flex items-center">
                            <input id="cat-all" name="category" type="radio" value="" wire:model.live="category" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500">
                            <label for="cat-all" class="ml-3 text-sm text-gray-600">All Categories</label>
                        </div>
                        @foreach($categories as $cat)
                        <div class="flex items-center">
                            <input id="cat-{{ $cat->id }}" name="category" type="radio" value="{{ $cat->slug }}" wire:model.live="category" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500">
                            <label for="cat-{{ $cat->id }}" class="ml-3 text-sm text-gray-600">{{ $cat->name }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h3 class="font-medium text-gray-900">Gender</h3>
                    <div class="mt-2 space-y-2">
                        <div class="flex items-center">
                            <input id="gen-all" name="gender" type="radio" value="" wire:model.live="gender" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500">
                            <label for="gen-all" class="ml-3 text-sm text-gray-600">Any</label>
                        </div>
                        <div class="flex items-center">
                            <input id="gen-men" name="gender" type="radio" value="men" wire:model.live="gender" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500">
                            <label for="gen-men" class="ml-3 text-sm text-gray-600">Men</label>
                        </div>
                        <div class="flex items-center">
                            <input id="gen-women" name="gender" type="radio" value="women" wire:model.live="gender" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500">
                            <label for="gen-women" class="ml-3 text-sm text-gray-600">Women</label>
                        </div>
                        <div class="flex items-center">
                            <input id="gen-unisex" name="gender" type="radio" value="unisex" wire:model.live="gender" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500">
                            <label for="gen-unisex" class="ml-3 text-sm text-gray-600">Unisex</label>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="font-medium text-gray-900">Condition</h3>
                    <div class="mt-2 space-y-2">
                        <div class="flex items-center">
                            <input id="cond-all" name="condition" type="radio" value="" wire:model.live="condition" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500">
                            <label for="cond-all" class="ml-3 text-sm text-gray-600">Any Condition</label>
                        </div>
                        <div class="flex items-center">
                            <input id="cond-new" name="condition" type="radio" value="new" wire:model.live="condition" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500">
                            <label for="cond-new" class="ml-3 text-sm text-gray-600">New</label>
                        </div>
                        <div class="flex items-center">
                            <input id="cond-like-new" name="condition" type="radio" value="like_new" wire:model.live="condition" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500">
                            <label for="cond-like-new" class="ml-3 text-sm text-gray-600">Like New</label>
                        </div>
                        <div class="flex items-center">
                            <input id="cond-good" name="condition" type="radio" value="good" wire:model.live="condition" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500">
                            <label for="cond-good" class="ml-3 text-sm text-gray-600">Good</label>
                        </div>
                        <div class="flex items-center">
                            <input id="cond-fair" name="condition" type="radio" value="fair" wire:model.live="condition" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500">
                            <label for="cond-fair" class="ml-3 text-sm text-gray-600">Fair</label>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="font-medium text-gray-900">Price Range (Rp)</h3>
                    <div class="mt-2 grid grid-cols-2 gap-2">
                        <input type="number" wire:model.live.debounce.500ms="minPrice" placeholder="Min" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                        <input type="number" wire:model.live.debounce.500ms="maxPrice" placeholder="Max" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                    </div>
                </div>

                <div>
                    <button wire:click="clearFilters" class="w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                        Clear All Filters
                    </button>
                </div>
            </div>

            <!-- Product Grid (Right) -->
            <div class="flex-1 min-w-0">
                <!-- Toolbar -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 space-y-4 sm:space-y-0">
                    <p class="text-sm text-gray-500">Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} results</p>
                    <div class="flex items-center">
                        <label for="sort" class="mr-2 text-sm text-gray-500 whitespace-nowrap">Sort by:</label>
                        <select id="sort" wire:model.live="sort" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                            <option value="latest">Newest Arrivals</option>
                            <option value="price_low">Price: Low to High</option>
                            <option value="price_high">Price: High to Low</option>
                            <option value="oldest">Oldest</option>
                        </select>
                    </div>
                </div>

                <!-- Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-6 sm:gap-8 relative" wire:loading.class="opacity-50 transition-opacity">
                    @forelse($products as $product)
                        <x-product-card :product="$product" />
                    @empty
                        <div class="col-span-full py-12 text-center bg-white rounded-lg border border-gray-200 border-dashed">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No products found</h3>
                            <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filters to find what you're looking for.</p>
                            <div class="mt-6">
                                <button wire:click="clearFilters" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700">
                                    Clear Filters
                                </button>
                            </div>
                        </div>
                    @endforelse
                    
                    <div wire:loading class="absolute inset-0 flex items-center justify-center">
                        <div class="bg-white/80 p-4 rounded-full shadow-lg backdrop-blur-sm">
                            <svg class="animate-spin h-8 w-8 text-primary-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-10">
                    {{ $products->links() }}
                </div>
            </div>
            
        </div>
    </div>
</div>
