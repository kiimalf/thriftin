<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('seller.dashboard') }}" class="text-sm font-medium text-primary-600 hover:text-primary-500">
            &larr; Back to My Listings
        </a>
        <a href="{{ route('products.show', $product->slug) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
            View Public Page
        </a>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
        <div class="px-4 py-5 sm:px-6 flex items-center">
            @if($product->primaryImage)
                <img src="{{ $product->primaryImage->url }}" alt="{{ $product->title }}" class="w-16 h-16 rounded object-cover mr-4">
            @else
                <div class="w-16 h-16 bg-gray-200 rounded mr-4"></div>
            @endif
            <div>
                <h3 class="text-xl leading-6 font-bold text-gray-900">
                    {{ $product->title }}
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Listed on {{ $product->created_at->format('M d, Y') }} &middot; Status: <span class="font-medium {{ $product->status === 'active' ? 'text-green-600' : 'text-gray-500' }}">{{ ucfirst($product->status) }}</span>
                </p>
            </div>
        </div>
    </div>

    <h2 class="text-lg font-medium text-gray-900 mb-4">Listing Analytics</h2>
    
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-3 mb-8">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <dt class="text-sm font-medium text-gray-500 truncate">Total Views</dt>
                <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ number_format($product->views_count) }}</dd>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <dt class="text-sm font-medium text-gray-500 truncate">Total Saves (Wishlist)</dt>
                <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ number_format($savesCount) }}</dd>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <dt class="text-sm font-medium text-gray-500 truncate">Conversion Rate</dt>
                <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $conversionRate }}%</dd>
            </div>
        </div>
    </div>

    <h2 class="text-lg font-medium text-gray-900 mb-4">Order History</h2>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        @if($orders->count() > 0)
            <ul role="list" class="divide-y divide-gray-200">
                @foreach($orders as $order)
                    <li>
                        <a href="{{ route('seller.orders.index') }}" class="block hover:bg-gray-50">
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-medium text-primary-600 truncate">Order #{{ $order->midtrans_order_id }}</p>
                                    <div class="ml-2 flex-shrink-0 flex">
                                        <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($order->status === 'completed') bg-green-100 text-green-800 
                                            @elseif($order->status === 'cancelled') bg-red-100 text-red-800 
                                            @else bg-blue-100 text-blue-800 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-2 sm:flex sm:justify-between">
                                    <div class="sm:flex items-center">
                                        <p class="flex items-center text-sm text-gray-500">
                                            Buyer: {{ $order->buyer->name }}
                                        </p>
                                    </div>
                                    <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                        <p>Placed on {{ $order->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="px-4 py-12 text-center sm:px-6">
                <p class="text-sm text-gray-500">No orders for this item yet.</p>
            </div>
        @endif
    </div>
</div>
