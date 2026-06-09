<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        @if (session()->has('message'))
            <div class="mb-4 bg-green-50 border-l-4 border-green-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">
                            {{ session('message') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mb-4 bg-red-50 border-l-4 border-red-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">
                            {{ session('error') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="mb-8">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Incoming Orders</h3>
                    <p class="mt-1 text-sm text-gray-500">Manage orders placed by buyers for your items.</p>
                </div>

                <div class="space-y-6">
                    @forelse($orders as $order)
                        <div class="bg-white border {{ $order->status === 'processing' ? 'border-primary-500 ring-1 ring-primary-500' : 'border-gray-200' }} shadow-sm rounded-lg overflow-hidden">
                            <div class="px-4 py-5 sm:px-6 flex justify-between items-center bg-gray-50">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Order #{{ substr($order->midtrans_order_id, 0, 15) }}...</h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Placed on {{ $order->created_at->format('M j, Y H:i') }}</p>
                                </div>
                                <div>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                        {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                           ($order->status === 'processing' ? 'bg-blue-100 text-blue-800' : 
                                           ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                        {{ strtoupper($order->status) }}
                                    </span>
                                </div>
                            </div>
                            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                                <dl class="sm:divide-y sm:divide-gray-200">
                                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Buyer Information</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $order->buyer->name }}<br>
                                            {{ $order->buyer->email }}<br>
                                            {{ $order->shippingAddress ? $order->shippingAddress->phone : '' }}
                                        </dd>
                                    </div>
                                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Shipping Address</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            @if($order->shippingAddress)
                                                {{ $order->shippingAddress->recipient_name }}<br>
                                                {{ $order->shippingAddress->detail }}<br>
                                                {{ $order->shippingAddress->district ? $order->shippingAddress->district . ', ' : '' }}{{ $order->shippingAddress->city }}, {{ $order->shippingAddress->province }} {{ $order->shippingAddress->postal_code }}<br>
                                                <span class="mt-2 inline-flex font-semibold text-primary-600">Kurir: {{ $order->shipping_provider }}</span>
                                            @else
                                                <span class="text-red-500">No shipping address provided</span>
                                            @endif
                                        </dd>
                                    </div>
                                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50">
                                        <dt class="text-sm font-medium text-gray-500">Product Ordered</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex items-center">
                                            @if($order->product->primaryImage)
                                                <img src="{{ $order->product->primaryImage->url }}" class="h-12 w-12 rounded object-cover mr-4">
                                            @endif
                                            <div>
                                                <span class="font-bold">{{ $order->product->title }}</span><br>
                                                Rp {{ number_format($order->product->price, 0, ',', '.') }}
                                            </div>
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                            
                            <!-- Actions -->
                            <div class="bg-gray-50 px-4 py-4 sm:px-6 border-t border-gray-200 flex flex-col sm:flex-row justify-between items-center">
                                <div class="text-sm font-bold text-gray-900 mb-4 sm:mb-0">
                                    Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </div>
                                
                                <div class="flex items-center space-x-3">
                                    @if($order->status === 'processing')
                                        <div class="flex items-center space-x-2">
                                            <input type="text" wire:model.defer="trackingNumbers.{{ $order->id }}" placeholder="Input Resi (e.g. JNE12345)" class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                            <button wire:click="shipOrder({{ $order->id }})" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 whitespace-nowrap">
                                                Mark as Shipped
                                            </button>
                                        </div>
                                        <button wire:click="cancelOrder({{ $order->id }})" wire:confirm="Are you sure you want to cancel this order?" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                            Cancel Order
                                        </button>
                                    @elseif($order->status === 'shipped')
                                        <span class="text-sm text-gray-500">Resi: <span class="font-bold text-gray-900">{{ $order->tracking_number }}</span></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No incoming orders</h3>
                            <p class="mt-1 text-sm text-gray-500">When someone buys your items, they will appear here.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
