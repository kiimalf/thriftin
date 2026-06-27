<div class="bg-gray-50/30" x-data="{ showMobileFilters: false }">


    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        
        <!-- Mobile Filter Overlay -->
        <div x-show="showMobileFilters" 
             x-transition.opacity 
             class="fixed inset-0 z-40 bg-gray-900/50 md:hidden" 
             style="display: none;" 
             @click="showMobileFilters = false"></div>

        <div class="flex flex-row gap-8 items-start relative">
            
            <!-- Sidebar Filters (Left) -->
            <div :class="showMobileFilters ? 'fixed inset-y-0 right-0 z-50 w-full max-w-[85vw] sm:max-w-xs bg-white shadow-2xl flex flex-col transform transition-transform duration-300 ease-in-out block' : 'hidden md:block'" class="w-full md:w-64 flex-shrink-0 md:sticky md:top-24 md:max-h-[calc(100vh-6rem)] md:overflow-y-auto md:bg-transparent md:p-0">
                
                <!-- Mobile Header -->
                <div class="md:hidden flex items-center justify-between p-4 border-b border-gray-100 flex-shrink-0 bg-white">
                    <h2 class="text-lg font-bold text-gray-900">Filters</h2>
                    <button type="button" @click="showMobileFilters = false" class="p-2 -mr-2 text-gray-400 hover:text-gray-500 rounded-lg hover:bg-gray-100 transition-colors">
                        <span class="sr-only">Close menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Filter Content -->
                <div class="flex-1 overflow-y-auto p-4 md:p-0">
                    <div class="bg-white md:rounded-2xl md:border border-gray-100 md:p-6 space-y-8 min-h-full md:min-h-0 pb-6 md:pb-6">
                        
                        <div>
                            <h3 class="font-semibold text-gray-900">Search</h3>
                            <div class="mt-3">
                                <input type="text" wire:model.live.debounce.500ms="search" placeholder="Search keywords..." class="block w-full border-gray-200 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm transition-all duration-200">
                            </div>
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-900">Category</h3>
                            <div class="mt-3 space-y-3">
                                <div class="flex items-center">
                                    <input id="cat-all" name="category" type="radio" value="" wire:model.live="category" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500 transition-colors">
                                    <label for="cat-all" class="ml-3 text-sm text-gray-600 cursor-pointer">All Categories</label>
                                </div>
                                @foreach($categories as $cat)
                                <div class="flex items-center">
                                    <input id="cat-{{ $cat->id }}" name="category" type="radio" value="{{ $cat->slug }}" wire:model.live="category" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500 transition-colors">
                                    <label for="cat-{{ $cat->id }}" class="ml-3 text-sm text-gray-600 cursor-pointer">{{ $cat->name }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-900">Gender</h3>
                            <div class="mt-3 space-y-3">
                                <div class="flex items-center">
                                    <input id="gen-all" name="gender" type="radio" value="" wire:model.live="gender" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500 transition-colors">
                                    <label for="gen-all" class="ml-3 text-sm text-gray-600 cursor-pointer">Any</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="gen-men" name="gender" type="radio" value="men" wire:model.live="gender" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500 transition-colors">
                                    <label for="gen-men" class="ml-3 text-sm text-gray-600 cursor-pointer">Men</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="gen-women" name="gender" type="radio" value="women" wire:model.live="gender" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500 transition-colors">
                                    <label for="gen-women" class="ml-3 text-sm text-gray-600 cursor-pointer">Women</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="gen-unisex" name="gender" type="radio" value="unisex" wire:model.live="gender" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500 transition-colors">
                                    <label for="gen-unisex" class="ml-3 text-sm text-gray-600 cursor-pointer">Unisex</label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-900">Condition</h3>
                            <div class="mt-3 space-y-3">
                                <div class="flex items-center">
                                    <input id="cond-all" name="condition" type="radio" value="" wire:model.live="condition" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500 transition-colors">
                                    <label for="cond-all" class="ml-3 text-sm text-gray-600 cursor-pointer">Any Condition</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="cond-new" name="condition" type="radio" value="new" wire:model.live="condition" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500 transition-colors">
                                    <label for="cond-new" class="ml-3 text-sm text-gray-600 cursor-pointer">New</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="cond-like-new" name="condition" type="radio" value="like_new" wire:model.live="condition" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500 transition-colors">
                                    <label for="cond-like-new" class="ml-3 text-sm text-gray-600 cursor-pointer">Like New</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="cond-good" name="condition" type="radio" value="good" wire:model.live="condition" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500 transition-colors">
                                    <label for="cond-good" class="ml-3 text-sm text-gray-600 cursor-pointer">Good</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="cond-fair" name="condition" type="radio" value="fair" wire:model.live="condition" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500 transition-colors">
                                    <label for="cond-fair" class="ml-3 text-sm text-gray-600 cursor-pointer">Fair</label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-900">Price Range (Rp)</h3>
                            <div class="mt-3 grid grid-cols-2 gap-3">
                                <input type="number" wire:model.live.debounce.500ms="minPrice" placeholder="Min" class="block w-full border-gray-200 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm transition-all duration-200">
                                <input type="number" wire:model.live.debounce.500ms="maxPrice" placeholder="Max" class="block w-full border-gray-200 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm transition-all duration-200">
                            </div>
                        </div>

                        <div class="pt-2 md:border-t md:border-gray-100">
                            <button wire:click="clearFilters" class="w-full bg-white border border-primary-200 rounded-lg py-2.5 px-4 text-sm font-semibold text-primary-600 hover:bg-primary-50 transition-colors focus:outline-none">
                                Clear All Filters
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Mobile Footer (Apply Button) -->
                <div class="md:hidden p-4 border-t border-gray-100 bg-white flex-shrink-0">
                    <button type="button" @click="showMobileFilters = false" class="w-full bg-primary-600 text-white rounded-lg py-3 px-4 text-sm font-semibold hover:bg-primary-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 shadow-sm">
                        Tampilkan Hasil
                    </button>
                </div>
            </div>

            <!-- Product Grid (Right) -->
            <div class="flex-1 min-w-0">
                <!-- Toolbar -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 space-y-4 sm:space-y-0">
                    <div class="flex items-center justify-between w-full sm:w-auto">
                        <p class="text-sm text-gray-500">Showing <span class="font-medium text-gray-900">{{ $products->firstItem() ?? 0 }}</span> to <span class="font-medium text-gray-900">{{ $products->lastItem() ?? 0 }}</span> of <span class="font-medium text-gray-900">{{ $products->total() }}</span> results</p>
                        
                        <!-- Mobile filter toggle -->
                        <button type="button" @click="showMobileFilters = true" class="md:hidden inline-flex items-center gap-2 p-2 -mr-2 text-gray-700 hover:text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            <span class="text-sm font-medium">Filters</span>
                        </button>
                    </div>
                    <div class="flex items-center">
                        <label for="sort" class="mr-3 text-sm font-medium text-gray-600 whitespace-nowrap">Sort by:</label>
                        <select id="sort" wire:model.live="sort" class="block w-full border-gray-200 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm transition-all duration-200">
                            <option value="latest">Newest Arrivals</option>
                            <option value="price_low">Price: Low to High</option>
                            <option value="price_high">Price: High to Low</option>
                            <option value="oldest">Oldest</option>
                        </select>
                    </div>
                </div>

                <!-- Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 relative" wire:loading.class="opacity-60 transition-opacity duration-300">
                    @forelse($products as $product)
                        <div class="animate-fade-in-up" style="animation-delay: {{ $loop->index * 0.05 }}s;">
                            <x-product-card :product="$product" />
                        </div>
                    @empty
                        <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-gray-100 shadow-sm animate-fade-in">
                            <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                            <h3 class="mt-4 text-base font-semibold text-gray-900">No products found</h3>
                            <p class="mt-2 text-sm text-gray-500 max-w-sm mx-auto">We couldn't find any items matching your current filters. Try adjusting them to see more results.</p>
                            <div class="mt-8">
                                <button wire:click="clearFilters" class="inline-flex items-center px-6 py-2.5 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-primary-600 hover:bg-primary-700 transition-colors">
                                    Clear Filters
                                </button>
                            </div>
                        </div>
                    @endforelse
                    
                    <div wire:loading class="absolute inset-0 flex items-center justify-center z-10">
                        <div class="bg-white p-4 rounded-2xl shadow-xl border border-gray-100">
                            <svg class="animate-spin h-8 w-8 text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            </div>
            
        </div>
    </div>
</div>
