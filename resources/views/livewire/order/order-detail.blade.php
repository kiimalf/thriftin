<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        @if(Auth::id() === $order->seller_id)
            <a href="{{ route('seller.dashboard', ['status' => 'processing']) }}" class="text-sm font-medium text-primary-600 hover:text-primary-500">
                &larr; Back to My Listings
            </a>
        @else
            <a href="{{ route('orders.index') }}" class="text-sm font-medium text-primary-600 hover:text-primary-500">
                &larr; Back to Orders
            </a>
        @endif
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Order Details #{{ $order->id }}
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Placed on {{ $order->created_at->format('M d, Y h:i A') }}
                </p>
            </div>
            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                @if($order->status === 'completed') bg-green-100 text-green-800 
                @elseif($order->status === 'cancelled') bg-red-100 text-red-800 
                @elseif($order->status === 'shipped') bg-blue-100 text-blue-800 
                @else bg-yellow-100 text-yellow-800 @endif">
                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
            </span>
        </div>

        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
            <dl class="sm:divide-y sm:divide-gray-200">
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Product</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex items-center">
                        @if($order->product->primaryImage)
                            <img src="{{ $order->product->primaryImage->url }}" alt="{{ $order->product->title }}" class="w-12 h-12 rounded object-cover mr-4">
                        @else
                            <div class="w-12 h-12 bg-gray-200 rounded mr-4"></div>
                        @endif
                        <div>
                            <p class="font-medium"><a href="{{ route('products.show', $order->product->slug) }}" class="hover:underline text-primary-600">{{ $order->product->title }}</a></p>
                            <p class="text-gray-500">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        </div>
                    </dd>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    @if(Auth::id() === $order->buyer_id)
                        <dt class="text-sm font-medium text-gray-500">Seller</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex items-center">
                            @if($order->seller->avatar)
                                <img src="{{ $order->seller->avatar }}" alt="{{ $order->seller->name }}" class="w-8 h-8 rounded-full mr-2">
                            @else
                                <div class="w-8 h-8 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold mr-2 text-xs">
                                    {{ substr($order->seller->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <div>{{ $order->seller->name }}</div>
                            </div>
                        </dd>
                    @else
                        <dt class="text-sm font-medium text-gray-500">Buyer Information</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex items-center">
                            @if($order->buyer->avatar)
                                <img src="{{ $order->buyer->avatar }}" alt="{{ $order->buyer->name }}" class="w-8 h-8 rounded-full mr-2">
                            @else
                                <div class="w-8 h-8 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold mr-2 text-xs">
                                    {{ substr($order->buyer->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <div>{{ $order->buyer->name }}</div>
                                <div class="text-xs text-gray-500">{{ $order->buyer->email }}</div>
                            </div>
                        </dd>
                    @endif
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Shipping Information</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @if($order->shippingAddress)
                            <p class="font-medium">{{ $order->shippingAddress->recipient_name }}</p>
                            <p>{{ $order->shippingAddress->phone }}</p>
                            <p>{{ $order->shippingAddress->detail }}</p>
                            <p>{{ $order->shippingAddress->district }}, {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->province }} {{ $order->shippingAddress->postal_code }}</p>
                        @else
                            <p class="text-gray-500 italic">No shipping address provided.</p>
                        @endif
                        
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <p><strong>Courier:</strong> {{ strtoupper($order->shipping_provider) }}</p>
                            <p><strong>Tracking Number:</strong> {{ $order->tracking_number ?: 'Not provided yet' }}</p>
                            <p><strong>Shipping Cost:</strong> Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</p>
                        </div>
                    </dd>
                </div>
                
                @if($order->status === 'completed')
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50">
                    <dt class="text-sm font-medium text-gray-900 flex items-center">
                        Product Review
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @if(session()->has('message'))
                            <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-md">
                                {{ session('message') }}
                            </div>
                        @endif
                        
                        @if(session()->has('error'))
                            <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-md">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if($order->review)
                            <!-- Display existing review -->
                            <div class="bg-white p-4 border border-gray-200 rounded-md shadow-sm">
                                <div class="flex items-center mb-2">
                                    <div class="flex text-yellow-400 mr-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-5 h-5 {{ $i <= $order->review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                    </div>
                                    <span class="text-sm font-medium text-gray-700">{{ $order->review->rating }} / 5</span>
                                </div>
                                <p class="text-gray-700">{{ $order->review->comment }}</p>
                                <p class="text-xs text-gray-500 mt-2">Submitted on {{ $order->review->created_at->format('M d, Y') }}</p>
                            </div>
                        @elseif(Auth::id() === $order->buyer_id)
                            <!-- Review Form -->
                            <form wire:submit.prevent="submitReview" class="bg-white p-4 border border-gray-200 rounded-md shadow-sm">
                                <h4 class="font-medium mb-3">Leave a Review</h4>
                                
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                                    <div class="flex items-center space-x-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <button type="button" wire:click="$set('rating', {{ $i }})" class="focus:outline-none">
                                                <svg class="w-8 h-8 {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-300 hover:text-yellow-200' }} transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            </button>
                                        @endfor
                                    </div>
                                    @error('rating') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="comment" class="block text-sm font-medium text-gray-700 mb-1">Review Comment</label>
                                    <textarea id="comment" wire:model="comment" rows="3" class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md px-3 py-2" placeholder="Tell us what you think about this item and seller..."></textarea>
                                    @error('comment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500" wire:loading.attr="disabled">
                                        <span wire:loading.remove wire:target="submitReview">Submit Review</span>
                                        <span wire:loading wire:target="submitReview">Submitting...</span>
                                    </button>
                                </div>
                            </form>
                        @endif
                    </dd>
                </div>
                @endif
            </dl>
        </div>
    </div>
</div>
