<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Seller Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h3 class="text-lg font-medium leading-6 text-gray-900">My Listings</h3>
                            <p class="mt-1 text-sm text-gray-500">Manage your preloved items for sale.</p>
                        </div>
                        <div>
                            <button type="button" class="inline-flex items-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                                + Add New Listing
                            </button>
                        </div>
                    </div>
                    
                    <!-- Placeholder stats -->
                    <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3 mb-8">
                        <div class="overflow-hidden rounded-lg bg-gray-50 px-4 py-5 shadow-sm sm:p-6 border border-gray-100">
                            <dt class="truncate text-sm font-medium text-gray-500">Active Listings</dt>
                            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">0</dd>
                        </div>
                        <div class="overflow-hidden rounded-lg bg-gray-50 px-4 py-5 shadow-sm sm:p-6 border border-gray-100">
                            <dt class="truncate text-sm font-medium text-gray-500">Total Sold</dt>
                            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">0</dd>
                        </div>
                        <div class="overflow-hidden rounded-lg bg-gray-50 px-4 py-5 shadow-sm sm:p-6 border border-gray-100">
                            <dt class="truncate text-sm font-medium text-gray-500">Revenue</dt>
                            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">Rp 0</dd>
                        </div>
                    </dl>

                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No listings yet</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by creating a new product listing.</p>
                        <div class="mt-6">
                            <button type="button" class="inline-flex items-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                New Listing
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
