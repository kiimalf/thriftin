<div class="bg-white">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav aria-label="Breadcrumb" class="mb-8">
            <ol role="list" class="flex items-center space-x-2">
                <li>
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-500 hover:text-gray-900">Home</a>
                </li>
                <li>
                    <svg class="h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                    </svg>
                </li>
                <li>
                    <a href="{{ route('products.index', ['category' => $product->category->slug ?? '']) }}" class="text-sm font-medium text-gray-500 hover:text-gray-900">{{ $product->category->name ?? 'Category' }}</a>
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
                    <div class="grid grid-cols-4 gap-6" aria-orientation="horizontal" role="tablist">
                        @foreach($product->images as $image)
                        <button wire:click="setActiveImage('{{ $image->url }}')" class="relative h-24 bg-white rounded-md flex items-center justify-center text-sm font-medium uppercase text-gray-900 cursor-pointer hover:bg-gray-50 focus:outline-none focus:ring focus:ring-offset-4 focus:ring-opacity-50" aria-selected="false">
                            <span class="sr-only">Image {{ $loop->iteration }}</span>
                            <span class="absolute inset-0 rounded-md overflow-hidden">
                                <img src="{{ $image->url }}" alt="" class="w-full h-full object-center object-cover">
                            </span>
                            <!-- Ring -->
                            <span class="{{ $activeImage === $image->url ? 'ring-primary-500' : 'ring-transparent' }} absolute inset-0 rounded-md ring-2 ring-offset-2 pointer-events-none" aria-hidden="true"></span>
                        </button>
                        @endforeach
                    </div>
                </div>

                <div class="w-full aspect-w-1 aspect-h-1 rounded-lg overflow-hidden bg-gray-100">
                    @if($activeImage)
                        <img src="{{ $activeImage }}" alt="{{ $product->title }}" class="w-full h-full object-center object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">No Image Available</div>
                    @endif
                </div>
            </div>

            <!-- Product info -->
            <div class="mt-10 px-4 sm:px-0 sm:mt-16 md:mt-0">
                <div class="flex justify-between items-center">
                    <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ $product->title }}</h1>
                    @livewire('product.wishlist-button', ['product' => $product], key('wishlist-main-'.$product->id))
                </div>
                
                <div class="mt-3">
                    <h2 class="sr-only">Product information</h2>
                    <p class="text-3xl text-gray-900 font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>

                <div class="mt-4">
                    <div class="flex items-center space-x-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            Condition: {{ ucwords(str_replace('_', ' ', $product->condition)) }}
                        </span>
                        @if($product->size)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            Size: {{ $product->size }}
                        </span>
                        @endif
                        @if($product->gender)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                            Gender: {{ ucfirst($product->gender) }}
                        </span>
                        @endif
                    </div>
                </div>

                <div class="mt-6 border-t border-b border-gray-200 py-6">
                    <!-- Seller Profile -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            @if($product->seller->avatar)
                                <img src="{{ $product->seller->avatar }}" alt="" class="w-12 h-12 rounded-full mr-4">
                            @else
                                <div class="w-12 h-12 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center text-xl font-bold mr-4">
                                    {{ substr($product->seller->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">{{ $product->seller->name }}</h3>
                                <p class="text-sm text-gray-500 flex items-center">
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
                    <div class="text-base text-gray-700 space-y-6">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                    
                    @if($product->brand || $product->weight)
                    <div class="mt-8 border-t border-gray-200 pt-8">
                        <h3 class="text-sm font-medium text-gray-900">Additional Details</h3>
                        <div class="mt-4 prose prose-sm text-gray-500">
                            <ul role="list">
                                @if($product->brand) <li><strong>Brand:</strong> {{ $product->brand }}</li> @endif
                                @if($product->weight) <li><strong>Weight:</strong> {{ $product->weight }} grams</li> @endif
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="mt-10 flex sm:flex-col1">
                    <button type="button" wire:click="addToCart" class="max-w-xs flex-1 bg-primary-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 focus:ring-offset-gray-50 sm:w-full" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="addToCart">Add to Cart</span>
                        <span wire:loading wire:target="addToCart">Adding...</span>
                    </button>
                    <button type="button" class="ml-4 max-w-xs flex-1 bg-gray-900 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 focus:ring-offset-gray-50 sm:w-full">
                        Buy Now
                    </button>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if(count($relatedProducts) > 0)
        <section aria-labelledby="related-heading" class="mt-16 sm:mt-24">
            <h2 id="related-heading" class="text-lg font-medium text-gray-900">Similar items you might like</h2>

            <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach($relatedProducts as $related)
                    <x-product-card :product="$related" />
                @endforeach
            </div>
        </section>
        @endif
    </div>
</div>
