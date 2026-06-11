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

                <!-- Tabs -->
                <div class="border-b border-gray-200 mb-6">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <a href="{{ route('seller.orders.index', ['status' => 'processing']) }}" class="{{ $statusFilter === 'processing' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Incoming Orders
                        </a>
                        <a href="{{ route('seller.orders.index', ['status' => 'shipped']) }}" class="{{ $statusFilter === 'shipped' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Shipped
                        </a>
                        <a href="{{ route('seller.dashboard', ['status' => 'active']) }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Active
                        </a>
                        <a href="{{ route('seller.dashboard', ['status' => 'sold']) }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Sold
                        </a>
                        <a href="{{ route('seller.dashboard', ['status' => 'draft']) }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Drafts
                        </a>
                    </nav>
                </div>

                <div class="flex flex-col">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Order Details</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Product</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Buyer & Shipping</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        @forelse($orders as $order)
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                                <div class="font-medium text-gray-900">#{{ substr($order->midtrans_order_id, 0, 15) }}...</div>
                                                <div class="text-gray-500">{{ $order->created_at->format('M j, Y H:i') }}</div>
                                                <div class="font-bold mt-1 text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                <div class="flex items-center">
                                                    <div class="h-10 w-10 flex-shrink-0">
                                                        @if($order->product->primaryImage)
                                                            <img class="h-10 w-10 rounded-md object-cover" src="{{ $order->product->primaryImage->url }}" alt="">
                                                        @else
                                                            <div class="h-10 w-10 rounded-md bg-gray-200"></div>
                                                        @endif
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="font-medium text-gray-900">{{ $order->product->title }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-3 py-4 text-sm text-gray-500">
                                                <div class="font-medium text-gray-900">{{ $order->buyer->name }}</div>
                                                @if($order->shippingAddress)
                                                    <div class="text-xs mt-1 text-gray-500 max-w-xs truncate" title="{{ $order->shippingAddress->detail }}, {{ $order->shippingAddress->city }}">
                                                        {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->province }}
                                                    </div>
                                                    <div class="text-xs font-semibold text-primary-600 mt-1">{{ $order->shipping_provider }}</div>
                                                @else
                                                    <div class="text-xs text-red-500">No address</div>
                                                @endif
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                <span class="inline-flex rounded-full px-2 py-1 text-xs font-semibold leading-5 
                                                    {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                                       ($order->status === 'processing' ? 'bg-blue-100 text-blue-800' : 
                                                       ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                @if($order->status === 'processing')
                                                    <div class="flex flex-col space-y-2 w-48">
                                                        <input type="text" wire:model.defer="trackingNumbers.{{ $order->id }}" placeholder="Input Resi (JNE...)" class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full text-xs border-gray-300 rounded-md py-1.5 px-2">
                                                        @error('trackingNumbers.'.$order->id) <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                        <div class="flex space-x-2">
                                                            <button wire:click="shipOrder({{ $order->id }})" class="inline-flex flex-1 justify-center py-1.5 px-2 border border-transparent shadow-sm text-xs font-medium rounded text-white bg-primary-600 hover:bg-primary-700">
                                                                Ship
                                                            </button>
                                                            <button wire:click="cancelOrder({{ $order->id }})" wire:confirm="Cancel order?" class="inline-flex flex-1 justify-center py-1.5 px-2 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50">
                                                                Cancel
                                                            </button>
                                                        </div>
                                                    </div>
                                                @elseif($order->status === 'shipped' || $order->status === 'completed')
                                                    <div class="text-xs text-gray-500">Resi: <br><span class="font-bold text-gray-900 text-sm">{{ $order->tracking_number }}</span></div>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="px-3 py-12 text-center text-sm text-gray-500">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                                </svg>
                                                <h3 class="mt-2 text-sm font-medium text-gray-900">No incoming orders</h3>
                                                <p class="mt-1 text-sm text-gray-500">When someone buys your items, they will appear here.</p>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
