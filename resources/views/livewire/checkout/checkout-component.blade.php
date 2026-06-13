<div class="bg-gray-50">
    <div class="max-w-2xl mx-auto pt-16 pb-24 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
        <h2 class="sr-only">Checkout</h2>

        <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
            <!-- Left side: Shipping details -->
            <div>
                @if (session()->has('error'))
                    <div class="rounded-md bg-red-50 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">{{ session('error') }}</h3>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="mb-10">
                    <h2 class="text-lg font-medium text-gray-900">Shipping Information</h2>

                    @if($addresses->count() > 0)
                        <div class="mt-4 space-y-4">
                            @foreach($addresses as $address)
                                <div class="border {{ $selectedAddressId == $address->id ? 'border-primary-500 bg-primary-50' : 'border-gray-200 bg-white' }} rounded-lg p-4 cursor-pointer relative" wire:click="$set('selectedAddressId', {{ $address->id }})">
                                    <div class="flex items-center">
                                        <input type="radio" name="address" wire:model="selectedAddressId" value="{{ $address->id }}" class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300">
                                        <div class="ml-3 flex flex-col">
                                            <span class="block text-sm font-medium text-gray-900">{{ $address->label }} - {{ $address->recipient_name }}</span>
                                            <span class="block text-sm text-gray-500">{{ $address->phone }}</span>
                                            <span class="block text-sm text-gray-500">{{ $address->detail }}, {{ $address->district ? $address->district . ', ' : '' }}{{ $address->city }}, {{ $address->province }} {{ $address->postal_code }}</span>
                                        </div>
                                    </div>
                                    @if($address->is_default)
                                        <span class="absolute top-4 right-4 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Default
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            <button type="button" wire:click="toggleNewAddressForm" class="text-sm font-medium text-primary-600 hover:text-primary-500">
                                {{ $showNewAddressForm ? '- Cancel new address' : '+ Add new address' }}
                            </button>
                        </div>
                    @else
                        <p class="mt-4 text-sm text-gray-500">You don't have any shipping addresses saved. Please add one below.</p>
                        @php $showNewAddressForm = true; @endphp
                    @endif

                    @if($showNewAddressForm)
                        <div class="mt-6 bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                            <h3 class="text-md font-medium text-gray-900 mb-4">Add New Address</h3>
                            <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Address Label (e.g., Home, Office)</label>
                                    <input type="text" wire:model="label" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm px-3 py-2">
                                    @error('label') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Recipient Name</label>
                                    <input type="text" wire:model="recipient_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm px-3 py-2">
                                    @error('recipient_name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                                    <input type="text" wire:model="phone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm px-3 py-2">
                                    @error('phone') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Province</label>
                                    <input type="text" wire:model="province" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm px-3 py-2" placeholder="e.g. Jawa Barat">
                                    @error('province') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">City / Kabupaten</label>
                                    <input type="text" wire:model="city" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm px-3 py-2" placeholder="e.g. Bandung">
                                    @error('city') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Full Address Details</label>
                                    <textarea wire:model="detail" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm px-3 py-2" placeholder="Street name, building, house number..."></textarea>
                                    @error('detail') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Postal Code</label>
                                    <input type="text" wire:model="postal_code" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm px-3 py-2">
                                    @error('postal_code') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="mt-6 flex justify-end">
                                <button type="button" wire:click="saveAddress" class="bg-gray-800 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900">
                                    Save Address
                                </button>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Delivery Method -->
                <div class="mt-10 border-t border-gray-200 pt-10">
                    <h2 class="text-lg font-medium text-gray-900">Delivery Method</h2>

                    <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                        <label class="relative bg-white border rounded-lg shadow-sm p-4 flex cursor-pointer focus:outline-none border-primary-500 ring-1 ring-primary-500">
                            <input type="radio" name="delivery_method" value="JNE Reguler" class="sr-only" checked>
                            <span class="flex-1 flex">
                                <span class="flex flex-col">
                                    <span id="delivery-method-0-label" class="block text-sm font-medium text-gray-900">JNE Reguler</span>
                                    <span id="delivery-method-0-description-0" class="mt-1 flex items-center text-sm text-gray-500">2–4 business days</span>
                                    <span id="delivery-method-0-description-1" class="mt-6 text-sm font-medium text-gray-900">Rp 15.000 / item</span>
                                </span>
                            </span>
                            <svg class="h-5 w-5 text-primary-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Right side: Order summary -->
            <div class="mt-10 lg:mt-0">
                <h2 class="text-lg font-medium text-gray-900">Order summary</h2>

                <div class="mt-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                    <h3 class="sr-only">Items in your cart</h3>
                    <ul role="list" class="divide-y divide-gray-200">
                        @foreach($cartItems as $item)
                        <li class="flex py-6 px-4 sm:px-6">
                            <div class="flex-shrink-0">
                                @if($item->product->primaryImage)
                                    <img src="{{ $item->product->primaryImage->url }}" alt="" class="w-20 h-20 rounded-md object-center object-cover">
                                @else
                                    <div class="w-20 h-20 rounded-md bg-gray-200"></div>
                                @endif
                            </div>

                            <div class="ml-6 flex-1 flex flex-col">
                                <div class="flex">
                                    <div class="min-w-0 flex-1">
                                        <h4 class="text-sm">
                                            <a href="#" class="font-medium text-gray-700 hover:text-gray-800">
                                                {{ $item->product->title }}
                                            </a>
                                        </h4>
                                        <p class="mt-1 text-sm text-gray-500">{{ $item->product->condition }}</p>
                                    </div>
                                </div>
                                <div class="flex-1 pt-2 flex items-end justify-between">
                                    <p class="mt-1 text-sm font-medium text-gray-900">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                    <p class="mt-1 text-sm text-gray-500">Qty {{ $item->quantity }}</p>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>

                    <dl class="border-t border-gray-200 py-6 px-4 space-y-6 sm:px-6">
                        <div class="flex items-center justify-between">
                            <dt class="text-sm text-gray-600">Subtotal</dt>
                            <dd class="text-sm font-medium text-gray-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</dd>
                        </div>
                        <div class="flex items-center justify-between">
                            <dt class="text-sm text-gray-600">Shipping ({{ $cartItems->count() }} items)</dt>
                            <dd class="text-sm font-medium text-gray-900">Rp {{ number_format($totalShipping, 0, ',', '.') }}</dd>
                        </div>
                        <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                            <dt class="text-base font-medium text-gray-900">Total</dt>
                            <dd class="text-base font-medium text-gray-900">Rp {{ number_format($total, 0, ',', '.') }}</dd>
                        </div>
                    </dl>

                    <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
                        <button type="button" wire:click="processCheckout" class="w-full bg-primary-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-primary-500" {{ !$selectedAddressId || $cartItems->isEmpty() ? 'disabled' : '' }}>
                            Pay Now
                        </button>
                        @if(!$selectedAddressId)
                            <p class="text-xs text-red-500 text-center mt-2">Please select or add a shipping address before paying.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
