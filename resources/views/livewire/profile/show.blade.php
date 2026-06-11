<div class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Profile Header -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="h-32 w-full bg-gradient-to-r from-primary-500 to-primary-700"></div>
            <div class="px-4 sm:px-6 lg:px-8 pb-8">
                <div class="-mt-12 sm:-mt-16 sm:flex sm:items-end sm:space-x-5">
                    <div class="flex relative z-10">
                        @if($user->avatar)
                            <img class="h-24 w-24 rounded-full ring-4 ring-white sm:h-32 sm:w-32 object-cover" src="{{ $user->avatar }}" alt="{{ $user->name }}">
                        @else
                            <div class="h-24 w-24 rounded-full ring-4 ring-white sm:h-32 sm:w-32 bg-primary-100 flex items-center justify-center text-primary-700 text-4xl font-bold">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div class="mt-6 sm:flex-1 sm:min-w-0 sm:flex sm:items-center sm:justify-end sm:space-x-6 sm:pb-1">
                        <div class="sm:hidden 2xl:block mt-6 min-w-0 flex-1">
                            <h1 class="text-2xl font-bold text-gray-900 truncate">
                                {{ $user->name }}
                            </h1>
                            <div class="flex items-center text-sm text-gray-500 mt-1">
                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Joined {{ $user->created_at->format('M Y') }}
                                @if($user->location)
                                <span class="mx-2">&middot;</span>
                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $user->location }}
                                @endif
                            </div>
                        </div>
                        <div class="mt-6 flex flex-col justify-stretch space-y-3 sm:flex-row sm:space-y-0 sm:space-x-4 relative z-10">
                            @if(auth()->id() === $user->id)
                                <a href="{{ route('profile.edit') }}" class="inline-flex justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                    Edit Profile
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="hidden sm:block 2xl:hidden mt-6 min-w-0 flex-1">
                    <h1 class="text-2xl font-bold text-gray-900 truncate">
                        {{ $user->name }}
                    </h1>
                </div>

                <!-- Stats -->
                <div class="mt-6 flex gap-6 border-t border-gray-200 pt-6">
                    <div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="text-lg font-bold text-gray-900">{{ number_format($user->rating_avg, 1) }}</span>
                        </div>
                        <p class="text-sm text-gray-500">Average Rating</p>
                    </div>
                    <div>
                        <span class="text-lg font-bold text-gray-900">{{ number_format($user->total_sold) }}</span>
                        <p class="text-sm text-gray-500">Items Sold</p>
                    </div>
                    <div>
                        <span class="text-lg font-bold text-gray-900">{{ $user->products_count }}</span>
                        <p class="text-sm text-gray-500">Active Listings</p>
                    </div>
                </div>
                
                @if($user->bio)
                <div class="mt-6 border-t border-gray-200 pt-6">
                    <p class="text-sm text-gray-700 whitespace-pre-line">{{ $user->bio }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Tabs -->
        <div class="mt-8">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <button wire:click="$set('activeTab', 'items')" class="{{ $activeTab === 'items' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Items for Sale
                    </button>
                    <button wire:click="$set('activeTab', 'reviews')" class="{{ $activeTab === 'reviews' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Reviews ({{ $reviews->count() }})
                    </button>
                </nav>
            </div>
        </div>

        <!-- Tab Content -->
        <div class="mt-8">
            @if($activeTab === 'items')
                @if($products->count() > 0)
                    <div class="grid grid-cols-2 gap-y-10 gap-x-6 sm:grid-cols-3 lg:grid-cols-4 xl:gap-x-8">
                        @foreach($products as $product)
                            <div class="group relative bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                                <div class="w-full h-48 bg-gray-200 aspect-w-1 aspect-h-1 overflow-hidden">
                                    <img src="{{ $product->primaryImage ? $product->primaryImage->url : '' }}" alt="{{ $product->title }}" class="w-full h-full object-center object-cover group-hover:opacity-75">
                                </div>
                                <div class="p-4">
                                    <h3 class="text-sm text-gray-700 truncate">
                                        <a href="{{ route('products.show', $product->slug) }}">
                                            <span aria-hidden="true" class="absolute inset-0"></span>
                                            {{ $product->title }}
                                        </a>
                                    </h3>
                                    <p class="mt-1 text-sm font-medium text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                    <div class="mt-2 flex items-center justify-between text-xs text-gray-500">
                                        <span class="px-2 py-1 bg-gray-100 rounded-full">{{ $product->size }}</span>
                                        <span>{{ ucwords(str_replace('_', ' ', $product->condition)) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 bg-white rounded-lg border border-gray-200">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No items for sale</h3>
                        <p class="mt-1 text-sm text-gray-500">This user doesn't have any active listings right now.</p>
                    </div>
                @endif
            @elseif($activeTab === 'reviews')
                @if($reviews->count() > 0)
                    <div class="bg-white shadow overflow-hidden sm:rounded-md">
                        <ul role="list" class="divide-y divide-gray-200">
                            @foreach($reviews as $review)
                                <li>
                                    <div class="px-4 py-4 sm:px-6">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                @if($review->reviewer->avatar)
                                                    <img class="h-8 w-8 rounded-full" src="{{ $review->reviewer->avatar }}" alt="">
                                                @else
                                                    <div class="h-8 w-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-700 text-xs font-bold">
                                                        {{ substr($review->reviewer->name, 0, 1) }}
                                                    </div>
                                                @endif
                                                <p class="ml-3 text-sm font-medium text-gray-900">{{ $review->reviewer->name }}</p>
                                            </div>
                                            <div class="flex items-center">
                                                <div class="flex text-yellow-400">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2 text-sm text-gray-700">
                                            <p>{{ $review->comment }}</p>
                                        </div>
                                        <div class="mt-2 text-xs text-gray-500 flex justify-between">
                                            <span>Purchased: <a href="{{ route('products.show', $review->product->slug) }}" class="hover:underline text-primary-600">{{ $review->product->title }}</a></span>
                                            <span>{{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="text-center py-12 bg-white rounded-lg border border-gray-200">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No reviews yet</h3>
                        <p class="mt-1 text-sm text-gray-500">This user hasn't received any reviews.</p>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
