<div class="bg-white min-h-screen">
    <!-- Header -->
    <div class="border-b border-gray-100">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold text-gray-900">My Orders</h1>
            <p class="mt-1 text-sm text-gray-500">View and track your purchases.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            
            @if (session()->has('message'))
                <div class="mb-6 bg-green-50 border border-green-100 p-4 rounded-xl">
                    <p class="text-sm text-green-700">{{ session('message') }}</p>
                </div>
            @endif

            <div class="space-y-6">
                @forelse($orders as $order)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-200">
                    <div class="px-5 py-5 sm:px-6 lg:p-8">
                        <div class="sm:flex sm:items-center sm:justify-between mb-4">
                            <div>
                                <p class="text-sm text-gray-500">Order placed <time datetime="{{ $order->created_at->format('Y-m-d') }}">{{ $order->created_at->format('F j, Y') }}</time></p>
                                <p class="text-sm text-gray-400 mt-0.5">Order #{{ $order->midtrans_order_id }}</p>
                            </div>
                            <div class="mt-4 sm:mt-0 text-right">
                                <p class="text-sm font-bold text-gray-900">Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img src="{{ $order->product->primaryImage ? $order->product->primaryImage->url : '' }}" alt="" class="w-20 h-20 rounded-xl object-center object-cover">
                                </div>
                                <div class="ml-5 flex-1">
                                    <h3 class="text-base font-bold text-gray-900">
                                        <a href="{{ route('products.show', $order->product->slug) }}" class="hover:text-primary-600 transition-colors">{{ $order->product->title }}</a>
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-1">Seller: {{ $order->seller->name }}</p>
                                    <div class="mt-1.5">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium 
                                            {{ $order->status === 'completed' ? 'bg-green-50 text-green-700' : 
                                               ($order->status === 'shipped' ? 'bg-blue-50 text-blue-700' : 
                                               ($order->status === 'pending_payment' ? 'bg-yellow-50 text-yellow-700' : 
                                               ($order->status === 'cancelled' ? 'bg-red-50 text-red-700' : 'bg-gray-50 text-gray-600'))) }}">
                                            {{ ucwords(str_replace('_', ' ', $order->status)) }}
                                        </span>
                                    </div>
                                    @if($order->tracking_number)
                                        <p class="text-sm text-gray-500 mt-1.5">Tracking: <span class="font-medium text-gray-700">{{ $order->tracking_number }}</span></p>
                                    @endif
                                </div>
                                
                                <div class="ml-4 flex flex-col space-y-2">
                                    <a href="{{ route('orders.show', $order->id) }}" class="inline-flex justify-center items-center px-4 py-2 border border-gray-200 text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition-all duration-200">
                                        View Details
                                    </a>
                                    @if($order->status === 'pending_payment')
                                        <a href="{{ route('payment.checkout', ['order_id' => $order->midtrans_order_id]) }}" class="inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-xl text-white bg-primary-600 hover:bg-primary-700 transition-all duration-200">
                                            Pay Now
                                        </a>
                                    @endif
                                    @if($order->status === 'shipped')
                                        <button wire:click="updateStatus({{ $order->id }}, 'completed')" wire:confirm="Are you sure you have received the item in good condition?" class="inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-xl text-white bg-green-600 hover:bg-green-700 transition-all duration-200">
                                            Confirm Receipt
                                        </button>
                                    @endif
                                    @if($order->status === 'completed' && !$order->review)
                                        <a href="{{ route('orders.show', $order->id) }}" class="inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-xl text-white bg-primary-600 hover:bg-primary-700 transition-all duration-200">
                                            Write a Review
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-16 bg-white rounded-2xl border border-gray-100">
                    <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <h3 class="mt-3 text-sm font-bold text-gray-900">No orders yet</h3>
                    <p class="mt-1 text-sm text-gray-500">When you buy something, it will appear here.</p>
                    <div class="mt-6">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-xl text-white bg-primary-600 hover:bg-primary-700 transition-all duration-200">
                            Start Shopping
                        </a>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
