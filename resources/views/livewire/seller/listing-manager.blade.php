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
                <dl class="mt-5 grid grid-cols-2 gap-3 lg:grid-cols-5 mb-8">
                    <div class="overflow-hidden rounded-lg bg-gray-50 px-3 py-3 md:px-4 md:py-5 shadow-sm border border-gray-100">
                        <dt class="truncate text-xs md:text-sm font-medium text-gray-500">Active Listings</dt>
                        <dd class="mt-1 text-xl md:text-3xl font-semibold tracking-tight text-gray-900">{{ $activeCount }}</dd>
                    </div>
                    <div class="overflow-hidden rounded-lg bg-gray-50 px-3 py-3 md:px-4 md:py-5 shadow-sm border border-gray-100">
                        <dt class="truncate text-xs md:text-sm font-medium text-gray-500">To Process</dt>
                        <dd class="mt-1 text-xl md:text-3xl font-semibold tracking-tight text-gray-900">{{ $processCount }}</dd>
                    </div>
                    <div class="overflow-hidden rounded-lg bg-gray-50 px-3 py-3 md:px-4 md:py-5 shadow-sm border border-gray-100">
                        <dt class="truncate text-xs md:text-sm font-medium text-gray-500">Shipped Items</dt>
                        <dd class="mt-1 text-xl md:text-3xl font-semibold tracking-tight text-gray-900">{{ $shippingCount }}</dd>
                    </div>
                    <div class="overflow-hidden rounded-lg bg-gray-50 px-3 py-3 md:px-4 md:py-5 shadow-sm border border-gray-100">
                        <dt class="truncate text-xs md:text-sm font-medium text-gray-500">Total Sold</dt>
                        <dd class="mt-1 text-xl md:text-3xl font-semibold tracking-tight text-gray-900">{{ $soldCount }}</dd>
                    </div>
                    <div class="col-span-2 lg:col-span-1 overflow-hidden rounded-lg bg-gray-50 px-3 py-3 md:px-4 md:py-5 shadow-sm border border-gray-100">
                        <dt class="truncate text-xs md:text-sm font-medium text-gray-500">Revenue</dt>
                        <dd class="mt-1 text-xl md:text-3xl font-semibold tracking-tight text-gray-900">Rp {{ number_format(auth()->user()->sellerOrders()->where('status', 'completed')->sum('total_price') ?? 0, 0, ',', '.') }}</dd>
                    </div>
                </dl>

                <!-- Tabs -->
                <div class="border-b border-gray-200 mb-6 w-full overflow-x-auto" style="scrollbar-width: none;">
                    <nav class="-mb-px flex" aria-label="Tabs" style="min-width: max-content;">
                        <button wire:click="setStatusFilter('active')" class="{{ $statusFilter === 'active' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-3 md:py-4 px-5 md:px-8 border-b-2 font-medium text-sm md:text-base transition-colors duration-200">
                            Active
                        </button>
                        <button wire:click="setStatusFilter('processing')" class="{{ $statusFilter === 'processing' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-3 md:py-4 px-5 md:px-8 border-b-2 font-medium text-sm md:text-base transition-colors duration-200">
                            Incoming Orders
                        </button>
                        <button wire:click="setStatusFilter('shipped')" class="{{ $statusFilter === 'shipped' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-3 md:py-4 px-5 md:px-8 border-b-2 font-medium text-sm md:text-base transition-colors duration-200">
                            Shipped
                        </button>
                        <button wire:click="setStatusFilter('sold')" class="{{ $statusFilter === 'sold' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-3 md:py-4 px-5 md:px-8 border-b-2 font-medium text-sm md:text-base transition-colors duration-200">
                            Sold
                        </button>
                        <button wire:click="setStatusFilter('draft')" class="{{ $statusFilter === 'draft' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-3 md:py-4 px-5 md:px-8 border-b-2 font-medium text-sm md:text-base transition-colors duration-200">
                            Drafts
                        </button>
                    </nav>
                </div>

                @if($isOrderTab)
                    <!-- Order List - Grid Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse($orders as $order)
                            <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm flex flex-col">
                                <div class="flex justify-between items-start mb-3 border-b border-gray-100 pb-3">
                                    <div>
                                        <div class="font-medium text-gray-900 text-sm">#{{ substr($order->midtrans_order_id, 0, 15) }}...</div>
                                        <div class="text-xs text-gray-500">{{ $order->created_at->format('M j, Y H:i') }}</div>
                                    </div>
                                    <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-semibold leading-5 flex-shrink-0
                                        {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                           ($order->status === 'processing' ? 'bg-blue-100 text-blue-800' : 
                                           ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                                
                                <div class="flex items-center mb-3">
                                    <div class="h-14 w-14 flex-shrink-0">
                                        @if($order->product->primaryImage)
                                            <img class="h-14 w-14 rounded-md object-cover" src="{{ $order->product->primaryImage->url }}" alt="">
                                        @else
                                            <div class="h-14 w-14 rounded-md bg-gray-200"></div>
                                        @endif
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900 line-clamp-1">{{ $order->product->title }}</div>
                                        <div class="font-bold text-gray-900 text-sm mt-1">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                                    </div>
                                </div>

                                <div class="bg-gray-50 rounded-md p-3 mb-3 text-xs border border-gray-100">
                                    <div class="font-medium text-gray-900 mb-1 flex items-center gap-1">
                                        <svg class="w-3 h-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                        {{ $order->buyer->name }}
                                    </div>
                                    @if($order->shippingAddress)
                                        <div class="text-gray-500 truncate" title="{{ $order->shippingAddress->detail }}, {{ $order->shippingAddress->city }}">{{ $order->shippingAddress->city }}, {{ $order->shippingAddress->province }}</div>
                                        <div class="font-semibold text-primary-600 mt-1">{{ $order->shipping_provider }}</div>
                                    @endif
                                </div>

                                <div class="flex flex-col gap-2 pt-2 border-t border-gray-100 mt-auto">
                                    @if($order->status === 'processing')
                                        <input type="text" wire:model.defer="trackingNumbers.{{ $order->id }}" placeholder="Input Resi (JNE...)" class="w-full text-xs border-gray-300 rounded-md py-1.5 px-2">
                                        @error('trackingNumbers.'.$order->id) <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                                        <div class="flex space-x-2 mt-1">
                                            <button wire:click="shipOrder({{ $order->id }})" class="flex-1 py-1.5 text-xs font-medium rounded text-white bg-primary-600 hover:bg-primary-700">Ship</button>
                                            <button wire:click="cancelOrder({{ $order->id }})" wire:confirm="Cancel order?" class="flex-1 py-1.5 text-xs font-medium rounded text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">Cancel</button>
                                        </div>
                                    @elseif($order->status === 'shipped' || $order->status === 'completed')
                                        <div class="text-xs text-gray-500">Resi: <span class="font-bold text-gray-900">{{ $order->tracking_number }}</span></div>
                                    @endif
                                    
                                    <a href="{{ route('orders.show', $order->id) }}" class="text-center text-primary-600 font-medium text-xs py-1 mt-1">View Detail</a>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-10 text-center bg-white rounded-lg border border-gray-200">
                                <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No {{ $statusFilter }} orders</h3>
                            </div>
                        @endforelse
                    </div>
                    <div class="mt-4">
                        {{ $orders->links() }}
                    </div>
                @else
                    <!-- Product List - Grid Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        @forelse($products as $product)
                            <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm flex flex-col">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex items-center flex-1 min-w-0 pr-3">
                                        <div class="h-14 w-14 flex-shrink-0">
                                            @if($product->primaryImage)
                                                <img class="h-14 w-14 rounded-md object-cover" src="{{ $product->primaryImage->url }}" alt="">
                                            @else
                                                <div class="h-14 w-14 rounded-md bg-gray-200"></div>
                                            @endif
                                        </div>
                                        <div class="ml-3 min-w-0">
                                            <div class="font-medium text-gray-900 text-sm line-clamp-1">{{ $product->title }}</div>
                                            <div class="text-xs text-gray-500 mt-0.5">{{ $product->category ? $product->category->name : '-' }}</div>
                                            <div class="font-bold text-gray-900 text-sm mt-1">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                    <span class="inline-flex rounded-full bg-green-100 px-2 py-0.5 text-xs font-semibold text-green-800 flex-shrink-0">
                                        {{ ucfirst($product->status) }}
                                    </span>
                                </div>
                                <div class="flex items-center justify-between pt-3 border-t border-gray-100 mt-auto">
                                    <span class="text-xs text-gray-500 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        {{ $product->views_count }} views
                                    </span>
                                    <div class="flex space-x-3 text-xs font-medium">
                                        @if($product->status === 'sold')
                                             @php $completedOrder = $product->orders->where('status', 'completed')->first(); @endphp
                                             @if($completedOrder)
                                                 <a href="{{ route('orders.show', $completedOrder->id) }}" class="text-primary-600 hover:text-primary-700">View Order</a>
                                             @endif
                                        @elseif($product->status === 'draft')
                                             <button wire:click="publishListing({{ $product->id }})" class="text-green-600 hover:text-green-700">Publish</button>
                                        @endif
                                        
                                        @if($product->status !== 'sold')
                                             <a href="#" class="text-primary-600 hover:text-primary-700">Edit</a>
                                             <button wire:click="deleteListing({{ $product->id }})" wire:confirm="Are you sure?" class="text-red-600 hover:text-red-700">Delete</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-10 text-center bg-white rounded-lg border border-gray-200">
                                <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No {{ $statusFilter }} listings</h3>
                                @if($statusFilter === 'active' || $statusFilter === 'draft')
                                    <div class="mt-3">
                                        <a href="{{ route('seller.products.create') }}" class="inline-flex items-center rounded-md bg-primary-600 px-3 py-1.5 text-xs font-medium text-white shadow-sm hover:bg-primary-700">
                                            + New
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endforelse
                    </div>
                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
