<div class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">My Listings</h1>
            <p class="mt-2 text-sm text-gray-500">Manage your preloved items for sale.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
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

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex items-center justify-end mb-8">
                    <div>
                        <a href="{{ route('seller.products.create') }}" class="inline-flex items-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                            + Add New Listing
                        </a>
                    </div>
                </div>
                
                <!-- Stats -->
                <dl class="mt-5 grid grid-cols-2 gap-4 lg:grid-cols-5 mb-8">
                    <div class="overflow-hidden rounded-lg bg-gray-50 px-3 py-4 shadow-sm sm:p-3 border border-gray-100">
                        <dt class="truncate text-sm font-medium text-gray-500">Active Listings</dt>
                        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $activeCount }}</dd>
                    </div>
                    <div class="overflow-hidden rounded-lg bg-gray-50 px-4 py-5 shadow-sm sm:p-6 border border-gray-100">
                        <dt class="truncate text-sm font-medium text-gray-500">To Process</dt>
                        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $processCount }}</dd>
                    </div>
                    <div class="overflow-hidden rounded-lg bg-gray-50 px-4 py-5 shadow-sm sm:p-6 border border-gray-100">
                        <dt class="truncate text-sm font-medium text-gray-500">Shipped Items</dt>
                        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $shippingCount }}</dd>
                    </div>
                    <div class="overflow-hidden rounded-lg bg-gray-50 px-4 py-5 shadow-sm sm:p-6 border border-gray-100">
                        <dt class="truncate text-sm font-medium text-gray-500">Total Sold</dt>
                        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $soldCount }}</dd>
                    </div>
                    <div class="overflow-hidden rounded-lg bg-gray-50 px-4 py-5 shadow-sm sm:p-6 border border-gray-100">
                        <dt class="truncate text-sm font-medium text-gray-500">Revenue</dt>
                        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">Rp {{ number_format(auth()->user()->sellerOrders()->where('status', 'completed')->sum('total_price') ?? 0, 0, ',', '.') }}</dd>
                    </div>
                </dl>

                <!-- Tabs -->
                <div class="border-b border-gray-200 mb-6">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <button wire:click="setStatusFilter('active')" class="{{ $statusFilter === 'active' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Active
                        </button>
                        <button wire:click="setStatusFilter('processing')" class="{{ $statusFilter === 'processing' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Incoming Orders
                        </button>
                        <button wire:click="setStatusFilter('shipped')" class="{{ $statusFilter === 'shipped' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Shipped
                        </button>
                        <button wire:click="setStatusFilter('sold')" class="{{ $statusFilter === 'sold' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Sold
                        </button>
                        <button wire:click="setStatusFilter('draft')" class="{{ $statusFilter === 'draft' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Drafts
                        </button>
                    </nav>
                </div>

                @if($isOrderTab)
                    <!-- Order List -->
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
                                                    
                                                    <div class="mt-2">
                                                        <a href="{{ route('orders.show', $order->id) }}" class="text-primary-600 hover:text-primary-900 font-medium text-xs underline">
                                                            View Detail
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="px-3 py-12 text-center text-sm text-gray-500">
                                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                                    </svg>
                                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No {{ $statusFilter }} orders</h3>
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
                    <div class="mt-4">
                        {{ $orders->links() }}
                    </div>
                @else
                    <!-- Product List -->
                    <div class="flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Product</th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Category</th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Price</th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                    <span class="sr-only">Actions</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            @forelse($products as $product)
                                            <tr>
                                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                                    <div class="flex items-center">
                                                        <div class="h-10 w-10 flex-shrink-0">
                                                            @if($product->primaryImage)
                                                                <img class="h-10 w-10 rounded-md object-cover" src="{{ $product->primaryImage->url }}" alt="">
                                                            @else
                                                                <div class="h-10 w-10 rounded-md bg-gray-200"></div>
                                                            @endif
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="font-medium text-gray-900">{{ $product->title }}</div>
                                                            <div class="text-gray-500">{{ $product->views_count }} views</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ $product->category ? $product->category->name : '-' }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    <span class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">
                                                        {{ ucfirst($product->status) }}
                                                    </span>
                                                </td>
                                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                    @if($product->status === 'sold')
                                                        @php
                                                            $completedOrder = $product->orders->where('status', 'completed')->first();
                                                        @endphp
                                                        @if($completedOrder)
                                                            <a href="{{ route('orders.show', $completedOrder->id) }}" class="text-primary-600 hover:text-primary-900 font-medium mr-4">View Order</a>
                                                        @endif
                                                    @elseif($product->status === 'draft')
                                                        <button wire:click="publishListing({{ $product->id }})" class="text-green-600 hover:text-green-900 mr-4">Publish</button>
                                                    @endif
                                                    
                                                    @if($product->status !== 'sold')
                                                        <a href="#" class="text-primary-600 hover:text-primary-900 mr-4">Edit</a>
                                                        <button wire:click="deleteListing({{ $product->id }})" wire:confirm="Are you sure you want to delete this listing?" class="text-red-600 hover:text-red-900">Delete</button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="px-3 py-12 text-center text-sm text-gray-500">
                                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                                    </svg>
                                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No {{ $statusFilter }} listings</h3>
                                                    <p class="mt-1 text-sm text-gray-500">Get started by creating a new product listing.</p>
                                                    @if($statusFilter === 'active' || $statusFilter === 'draft')
                                                        <div class="mt-6">
                                                            <a href="{{ route('seller.products.create') }}" class="inline-flex items-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700">
                                                                + New Listing
                                                            </a>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
