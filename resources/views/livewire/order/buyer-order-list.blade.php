<div class="bg-gray-50">
    <!-- Header -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">My Orders</h1>
            <p class="mt-2 text-sm text-gray-500">View and track your purchases.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            
            @if (session()->has('message'))
                <div class="mb-4 bg-green-50 border-l-4 border-green-400 p-4 rounded-md">
                    <p class="text-sm text-green-700">{{ session('message') }}</p>
                </div>
            @endif

            <div class="space-y-8">
                @forelse($orders as $order)
                <div class="bg-white border-t border-b border-gray-200 shadow-sm sm:rounded-lg sm:border">
                    <div class="px-4 py-6 sm:px-6 lg:p-8">
                        <div class="sm:flex sm:items-center sm:justify-between mb-4">
                            <div>
                                <p class="text-sm text-gray-500">Order placed <time datetime="{{ $order->created_at->format('Y-m-d') }}">{{ $order->created_at->format('F j, Y') }}</time></p>
                                <p class="text-sm text-gray-500 mt-1">Order #{{ $order->midtrans_order_id }}</p>
                            </div>
                            <div class="mt-4 sm:mt-0 text-right">
                                <p class="text-sm font-medium text-gray-900">Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img src="{{ $order->product->primaryImage ? $order->product->primaryImage->url : '' }}" alt="" class="w-20 h-20 rounded-md object-center object-cover">
                                </div>
                                <div class="ml-6 flex-1">
                                    <h3 class="text-lg font-medium text-gray-900">
                                        <a href="{{ route('products.show', $order->product->slug) }}">{{ $order->product->title }}</a>
                                    </h3>
                                    <p class="text-sm text-gray-500">Seller: {{ $order->seller->name }}</p>
                                    <p class="text-sm text-gray-500 mt-1">Status: 
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                               ($order->status === 'shipped' ? 'bg-blue-100 text-blue-800' : 
                                               ($order->status === 'pending_payment' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800')) }}">
                                            {{ ucwords(str_replace('_', ' ', $order->status)) }}
                                        </span>
                                    </p>
                                    @if($order->tracking_number)
                                        <p class="text-sm text-gray-500 mt-1">Tracking Number: <span class="font-medium">{{ $order->tracking_number }}</span></p>
                                    @endif
                                </div>
                                
                                <div class="ml-4 flex flex-col space-y-2">
                                    <a href="{{ route('orders.show', $order->id) }}" class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        View Details
                                    </a>
                                    @if($order->status === 'pending_payment')
                                        <a href="{{ route('payment.checkout', ['order_id' => $order->midtrans_order_id]) }}" class="inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700">
                                            Pay Now
                                        </a>
                                    @endif
                                    @if($order->status === 'shipped')
                                        <button wire:click="updateStatus({{ $order->id }}, 'completed')" wire:confirm="Are you sure you have received the item in good condition?" class="inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700">
                                            Confirm Receipt
                                        </button>
                                    @endif
                                    @if($order->status === 'completed' && !$order->review)
                                        <a href="{{ route('orders.show', $order->id) }}" class="inline-flex justify-center items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700">
                                            Write a Review
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-12 bg-white rounded-lg shadow-sm border border-gray-200">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No orders yet</h3>
                    <p class="mt-1 text-sm text-gray-500">When you buy something, it will appear here.</p>
                    <div class="mt-6">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700">
                            Start Shopping
                        </a>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
