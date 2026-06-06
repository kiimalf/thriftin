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

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900">My Listings</h3>
                        <p class="mt-1 text-sm text-gray-500">Manage your preloved items for sale.</p>
                    </div>
                    <div>
                        <a href="{{ route('seller.products.create') }}" class="inline-flex items-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                            + Add New Listing
                        </a>
                    </div>
                </div>
                
                <!-- Stats -->
                <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3 mb-8">
                    <div class="overflow-hidden rounded-lg bg-gray-50 px-4 py-5 shadow-sm sm:p-6 border border-gray-100">
                        <dt class="truncate text-sm font-medium text-gray-500">Active Listings</dt>
                        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $activeCount }}</dd>
                    </div>
                    <div class="overflow-hidden rounded-lg bg-gray-50 px-4 py-5 shadow-sm sm:p-6 border border-gray-100">
                        <dt class="truncate text-sm font-medium text-gray-500">Total Sold</dt>
                        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $soldCount }}</dd>
                    </div>
                    <div class="overflow-hidden rounded-lg bg-gray-50 px-4 py-5 shadow-sm sm:p-6 border border-gray-100">
                        <dt class="truncate text-sm font-medium text-gray-500">Revenue</dt>
                        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">Rp {{ number_format(auth()->user()->orders()->where('status', 'completed')->sum('total_price') ?? 0, 0, ',', '.') }}</dd>
                    </div>
                </dl>

                <!-- Tabs -->
                <div class="border-b border-gray-200 mb-6">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <button wire:click="setStatusFilter('active')" class="{{ $statusFilter === 'active' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Active
                        </button>
                        <button wire:click="setStatusFilter('sold')" class="{{ $statusFilter === 'sold' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Sold
                        </button>
                        <button wire:click="setStatusFilter('draft')" class="{{ $statusFilter === 'draft' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Drafts
                        </button>
                    </nav>
                </div>

                <!-- Product List -->
                @if($products->count() > 0)
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
                                            @foreach($products as $product)
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
                                                    <a href="#" class="text-primary-600 hover:text-primary-900">Edit</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No {{ $statusFilter }} listings</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by creating a new product listing.</p>
                        <div class="mt-6">
                            <a href="{{ route('seller.products.create') }}" class="inline-flex items-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                New Listing
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
