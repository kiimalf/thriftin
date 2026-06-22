<div class="bg-white min-h-screen">
    <!-- Header -->
    <div class="border-b border-gray-100">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold text-gray-900">Order Details</h1>
            <p class="mt-1 text-sm text-gray-500">View information about order #{{ $order->midtrans_order_id ?? $order->id }}</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-6">
        @if(Auth::id() === $order->seller_id)
            <a href="{{ route('seller.dashboard', ['status' => 'processing']) }}" class="inline-flex items-center text-sm font-medium text-primary-600 hover:text-primary-700 transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/></svg>
                Back to My Listings
            </a>
        @else
            <a href="{{ route('orders.index') }}" class="inline-flex items-center text-sm font-medium text-primary-600 hover:text-primary-700 transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/></svg>
                Back to Orders
            </a>
        @endif
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 sm:px-8 flex justify-between items-center">
            <div>
                <h3 class="text-lg font-bold text-gray-900">
                    Order #{{ $order->id }}
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    Placed on {{ $order->created_at->format('M d, Y h:i A') }}
                </p>
            </div>
            <span class="px-3 py-1.5 inline-flex text-xs font-medium rounded-lg 
                @if($order->status === 'completed') bg-green-50 text-green-700 
                @elseif($order->status === 'cancelled') bg-red-50 text-red-700 
                @elseif($order->status === 'shipped') bg-blue-50 text-blue-700 
                @else bg-yellow-50 text-yellow-700 @endif">
                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
            </span>
        </div>

        <div class="border-t border-gray-100 px-6 py-5 sm:p-0">
            <dl class="sm:divide-y sm:divide-gray-100">
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-8">
                    <dt class="text-sm font-medium text-gray-500">Product</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex items-center">
                        @if($order->product->primaryImage)
                            <img src="{{ $order->product->primaryImage->url }}" alt="{{ $order->product->title }}" class="w-12 h-12 rounded-xl object-cover mr-4">
                        @else
                            <div class="w-12 h-12 bg-gray-50 rounded-xl mr-4 flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                        <div>
                            <p class="font-medium"><a href="{{ route('products.show', $order->product->slug) }}" class="hover:text-primary-600 text-primary-600 transition-colors">{{ $order->product->title }}</a></p>
                            <p class="text-gray-500">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        </div>
                    </dd>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-8">
                    @if(Auth::id() === $order->buyer_id)
                        <dt class="text-sm font-medium text-gray-500">Seller</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex items-center">
                            @if($order->seller->avatar)
                                <img src="{{ $order->seller->avatar }}" alt="{{ $order->seller->name }}" class="w-8 h-8 rounded-full mr-3 object-cover">
                            @else
                                <div class="w-8 h-8 rounded-full bg-primary-50 text-primary-600 flex items-center justify-center font-bold mr-3 text-xs">
                                    {{ substr($order->seller->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <div class="font-medium">{{ $order->seller->name }}</div>
                            </div>
                        </dd>
                    @else
                        <dt class="text-sm font-medium text-gray-500">Buyer Information</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex items-center">
                            @if($order->buyer->avatar)
                                <img src="{{ $order->buyer->avatar }}" alt="{{ $order->buyer->name }}" class="w-8 h-8 rounded-full mr-3 object-cover">
                            @else
                                <div class="w-8 h-8 rounded-full bg-primary-50 text-primary-600 flex items-center justify-center font-bold mr-3 text-xs">
                                    {{ substr($order->buyer->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <div class="font-medium">{{ $order->buyer->name }}</div>
                                <div class="text-xs text-gray-500">{{ $order->buyer->email }}</div>
                            </div>
                        </dd>
                    @endif
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-8">
                    <dt class="text-sm font-medium text-gray-500">Shipping Information</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @if($order->shippingAddress)
                            <p class="font-medium">{{ $order->shippingAddress->recipient_name }}</p>
                            <p class="text-gray-600">{{ $order->shippingAddress->phone }}</p>
                            <p class="text-gray-600">{{ $order->shippingAddress->detail }}</p>
                            <p class="text-gray-600">{{ $order->shippingAddress->district }}, {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->province }} {{ $order->shippingAddress->postal_code }}</p>
                        @else
                            <p class="text-gray-400 italic">No shipping address provided.</p>
                        @endif
                        
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="space-y-1">
                                <p><span class="font-medium text-gray-700">Courier:</span> <span class="text-gray-600">{{ strtoupper($order->shipping_provider) }}</span></p>
                                <p><span class="font-medium text-gray-700">Tracking Number:</span> <span class="text-gray-600">{{ $order->tracking_number ?: 'Not provided yet' }}</span></p>
                                <p><span class="font-medium text-gray-700">Shipping Cost:</span> <span class="text-gray-600">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span></p>
                            </div>
                        </div>
                    </dd>
                </div>
                
                @if($order->status === 'completed')
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-8 bg-gray-50/50">
                    <dt class="text-sm font-medium text-gray-900 flex items-center">
                        Product Review
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @if(session()->has('message'))
                            <div class="mb-4 p-4 bg-green-50 border border-green-100 text-green-700 rounded-xl">
                                {{ session('message') }}
                            </div>
                        @endif
                        
                        @if(session()->has('error'))
                            <div class="mb-4 p-4 bg-red-50 border border-red-100 text-red-700 rounded-xl">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if($order->review)
                            <!-- Display existing review -->
                            <div class="bg-white p-5 border border-gray-100 rounded-2xl">
                                <div class="flex items-center mb-3">
                                    <div class="flex text-yellow-400 mr-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-5 h-5 {{ $i <= $order->review->rating ? 'text-yellow-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                    </div>
                                    <span class="text-sm font-medium text-gray-600">{{ $order->review->rating }} / 5</span>
                                </div>
                                <p class="text-gray-700">{{ $order->review->comment }}</p>
                                <p class="text-xs text-gray-400 mt-3">Submitted on {{ $order->review->created_at->format('M d, Y') }}</p>
                            </div>
                        @elseif(Auth::id() === $order->buyer_id)
                            <!-- Review Form -->
                            <form wire:submit.prevent="submitReview" class="bg-white p-5 border border-gray-100 rounded-2xl">
                                <h4 class="font-bold text-gray-900 mb-4">Leave a Review</h4>
                                
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Rating</label>
                                    <div class="flex items-center space-x-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <button type="button" wire:click="$set('rating', {{ $i }})" class="focus:outline-none">
                                                <svg class="w-8 h-8 {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-200 hover:text-yellow-200' }} transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            </button>
                                        @endfor
                                    </div>
                                    @error('rating') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="comment" class="block text-sm font-medium text-gray-700 mb-1.5">Review Comment</label>
                                    <textarea id="comment" wire:model="comment" rows="3" class="focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-200 rounded-lg px-3.5 py-2.5" placeholder="Tell us what you think about this item and seller..."></textarea>
                                    @error('comment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <button type="submit" class="inline-flex justify-center py-2.5 px-5 border border-transparent text-sm font-medium rounded-xl text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200" wire:loading.attr="disabled">
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

</div>

</div>
