<div>
    @section('title', 'Product Moderation')

    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div class="relative w-full sm:w-96">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input wire:model.live.debounce.300ms="search" type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 sm:text-sm" placeholder="Search product title...">
        </div>

        <div class="flex border border-gray-300 rounded-md overflow-hidden bg-white">
            <select wire:model.live="status" class="block w-full pl-3 pr-10 py-2 text-base border-transparent focus:outline-none focus:ring-0 focus:border-transparent sm:text-sm text-gray-700">
                <option value="all">All Status</option>
                <option value="active">Active</option>
                <option value="sold">Sold</option>
                <option value="draft">Draft</option>
                <option value="taken_down">Taken Down</option>
            </select>
        </div>
    </div>

    <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-500 bg-gray-50/50 uppercase">
                    <tr>
                        <th class="px-6 py-4 font-medium">Product</th>
                        <th class="px-6 py-4 font-medium">Seller</th>
                        <th class="px-6 py-4 font-medium">Category</th>
                        <th class="px-6 py-4 font-medium">Price</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($product->primaryImage)
                                    <img class="h-12 w-12 rounded object-cover mr-3 border border-gray-200" src="{{ $product->primaryImage->url }}" alt="{{ $product->title }}">
                                @else
                                    <div class="h-12 w-12 rounded bg-gray-100 border border-gray-200 flex items-center justify-center mr-3">
                                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                <div>
                                    <div class="font-medium text-gray-900 line-clamp-1" title="{{ $product->title }}">{{ $product->title }}</div>
                                    <div class="text-xs text-gray-500 mt-0.5">{{ ucfirst($product->condition) }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-gray-900">{{ $product->seller->name }}</div>
                            <div class="text-xs text-gray-500">{{ $product->seller->email }}</div>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $product->category->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-gray-900 font-medium">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            @if($product->status == 'active')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Active</span>
                            @elseif($product->status == 'sold')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Sold</span>
                            @elseif($product->status == 'taken_down')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Taken Down</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">{{ ucfirst($product->status) }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="text-sm font-medium text-primary-600 hover:text-primary-900">View</a>
                            
                            @if($product->status !== 'taken_down')
                                <button wire:click="takeDown({{ $product->id }})" wire:confirm="Are you sure you want to take down this product?" class="text-sm font-medium text-red-600 hover:text-red-900 ml-2">
                                    Take Down
                                </button>
                            @else
                                <button wire:click="restore({{ $product->id }})" wire:confirm="Are you sure you want to restore this product?" class="text-sm font-medium text-green-600 hover:text-green-900 ml-2">
                                    Restore
                                </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No products found</h3>
                            <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter criteria.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($products->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
