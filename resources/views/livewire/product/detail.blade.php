<div class="bg-white">
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav aria-label="Breadcrumb" class="mb-8">
            <ol role="list" class="flex items-center space-x-2">
                <li>
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-500 hover:text-primary-600 transition-colors">Home</a>
                </li>
                <li>
                    <svg class="h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                    </svg>
                </li>
                <li>
                    <a href="{{ route('products.index', ['category' => $product->category->slug ?? '']) }}" class="text-sm font-medium text-gray-500 hover:text-primary-600 transition-colors">{{ $product->category->name ?? 'Category' }}</a>
                </li>
                <li>
                    <svg class="h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                    </svg>
                </li>
                <li class="text-sm font-medium text-gray-900">
                    {{ $product->title }}
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-x-12 items-start">
            <!-- Image Gallery -->
            <div class="flex flex-col-reverse">
                <!-- Image selector -->
                <div class="hidden mt-6 w-full max-w-2xl mx-auto sm:block lg:max-w-none">
                    <div class="grid grid-cols-4 gap-4" aria-orientation="horizontal" role="tablist">
                        @foreach($product->images as $image)
                        <button wire:click="setActiveImage('{{ $image->url }}')" class="relative h-24 bg-white rounded-xl flex items-center justify-center text-sm font-medium uppercase text-gray-900 cursor-pointer hover:opacity-80 focus:outline-none focus:ring focus:ring-offset-2 focus:ring-primary-500 focus:ring-opacity-50 transition-all duration-200 overflow-hidden" aria-selected="false">
                            <span class="sr-only">Image {{ $loop->iteration }}</span>
                            <span class="absolute inset-0 rounded-xl overflow-hidden">
                                <img src="{{ $image->url }}" alt="" class="w-full h-full object-center object-cover">
                            </span>
                            <!-- Ring -->
                            <span class="{{ $activeImage === $image->url ? 'ring-primary-500' : 'ring-transparent' }} absolute inset-0 rounded-xl ring-2 ring-offset-2 pointer-events-none transition-all duration-200" aria-hidden="true"></span>
                        </button>
                        @endforeach
                    </div>
                </div>

                <div class="w-full aspect-w-1 aspect-h-1 rounded-2xl overflow-hidden bg-gray-50">
                    @if($activeImage)
                        <img src="{{ $activeImage }}" alt="{{ $product->title }}" class="w-full h-full object-center object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">No Image Available</div>
                    @endif
                </div>
            </div>

            <!-- Product info -->
            <div class="mt-10 px-4 sm:px-0 sm:mt-16 md:mt-0">
                <div class="flex justify-between items-start">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">{{ $product->title }}</h1>
                    @livewire('product.wishlist-button', ['product' => $product], key('wishlist-main-'.$product->id))
                </div>
                
                <div class="mt-3">
                    <h2 class="sr-only">Product information</h2>
                    <p class="text-2xl text-gray-900 font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>

                <div class="mt-4">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                            Condition: {{ ucwords(str_replace('_', ' ', $product->condition)) }}
                        </span>
                        @if($product->size)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                            Size: {{ $product->size }}
                        </span>
                        @endif
                        @if($product->gender)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-50 text-primary-700">
                            Gender: {{ ucfirst($product->gender) }}
                        </span>
                        @endif
                    </div>
                </div>

                <div class="mt-6 border-t border-b border-gray-100 py-6">
                    <!-- Seller Profile -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            @if($product->seller->avatar)
                                <img src="{{ $product->seller->avatar }}" alt="" class="w-12 h-12 rounded-full ring-2 ring-gray-100 mr-4">
                            @else
                                <div class="w-12 h-12 rounded-full bg-primary-50 text-primary-600 ring-2 ring-gray-100 flex items-center justify-center text-xl font-bold mr-4">
                                    {{ substr($product->seller->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900">
                                    <a href="{{ route('profile.show', $product->seller->id) }}" class="hover:text-primary-600 transition-colors">{{ $product->seller->name }}</a>
                                </h3>
                                <p class="text-sm text-gray-500 flex items-center mt-0.5">
                                    <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    {{ $product->seller->rating_avg > 0 ? $product->seller->rating_avg . ' (' . $product->seller->receivedReviews()->count() . ' reviews)' : 'No reviews yet' }} &middot; {{ $product->seller->total_sold }} Sold
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="sr-only">Description</h3>
                    <div class="text-sm text-gray-600 leading-relaxed space-y-4">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                    
                    @if($product->brand || $product->weight)
                    <div class="mt-8 border-t border-gray-100 pt-8">
                        <h3 class="text-sm font-semibold text-gray-900">Additional Details</h3>
                        <div class="mt-4 text-sm text-gray-500 space-y-2">
                            <ul role="list" class="space-y-1">
                                @if($product->brand) <li class="flex items-center gap-2"><span class="font-medium text-gray-700">Brand:</span> {{ $product->brand }}</li> @endif
                                @if($product->weight) <li class="flex items-center gap-2"><span class="font-medium text-gray-700">Weight:</span> {{ $product->weight }} grams</li> @endif
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="mt-10 flex gap-3">
                    <button type="button" wire:click="addToCart" class="flex-1 bg-primary-600 border border-transparent rounded-xl py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200 shadow-sm hover:shadow-md sm:w-full" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="addToCart">Add to Cart</span>
                        <span wire:loading wire:target="addToCart">Adding...</span>
                    </button>
                    <button type="button" wire:click="buyNow" class="flex-1 bg-gray-900 border border-transparent rounded-xl py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-all duration-200 shadow-sm hover:shadow-md sm:w-full" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="buyNow">Buy Now</span>
                        <span wire:loading wire:target="buyNow">Processing...</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Product Reviews -->
        @if($product->reviews->count() > 0)
        <section aria-labelledby="reviews-heading" class="mt-20">
            <h2 id="reviews-heading" class="text-lg font-semibold text-gray-900">Customer Reviews</h2>
            <div class="mt-6 border-t border-gray-100 pt-10 pb-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($product->reviews as $review)
                        <div class="bg-gray-50/70 p-6 rounded-2xl">
                            <div class="flex items-center mb-4">
                                @if($review->reviewer->avatar)
                                    <img src="{{ $review->reviewer->avatar }}" alt="{{ $review->reviewer->name }}" class="w-10 h-10 rounded-full ring-2 ring-gray-100 mr-4">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-primary-50 flex items-center justify-center text-primary-600 font-bold mr-4">
                                        {{ substr($review->reviewer->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-900">
                                        <a href="{{ route('profile.show', $review->reviewer->id) }}" class="hover:text-primary-600 transition-colors">{{ $review->reviewer->name }}</a>
                                    </h4>
                                    <div class="flex items-center mt-1">
                                        <div class="flex text-yellow-400">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endfor
                                        </div>
                                        <p class="ml-2 text-xs text-gray-400">{{ $review->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed">{{ $review->comment }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        <!-- Related Products -->
        @if(count($relatedProducts) > 0)
        <section aria-labelledby="related-heading" class="mt-20">
            <h2 id="related-heading" class="text-lg font-semibold text-gray-900">Similar items you might like</h2>

            <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach($relatedProducts as $related)
                    <x-product-card :product="$related" />
                @endforeach
            </div>
        </section>
        @endif
    </div>
</div>
