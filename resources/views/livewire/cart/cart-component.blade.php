<div class="bg-white min-h-screen">


    <div class="max-w-7xl mx-auto pt-8 pb-12 px-4 sm:px-6 lg:px-8">
        <form class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start">
            <section aria-labelledby="cart-heading" class="lg:col-span-7 space-y-4">
                <h2 id="cart-heading" class="sr-only">Items in your shopping cart</h2>

                @forelse($cartItems as $item)
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 sm:p-6 transition-all duration-200 hover:shadow-md">
                        <div class="flex gap-4 sm:gap-6">
                            <!-- Product Image -->
                            <div class="flex-shrink-0">
                                @if($item->product->primaryImage)
                                    <img src="{{ $item->product->primaryImage->url }}" alt="{{ $item->product->title }}" class="w-24 h-24 rounded-xl object-center object-cover sm:w-32 sm:h-32">
                                @else
                                    <div class="w-24 h-24 rounded-xl bg-gray-100 sm:w-32 sm:h-32 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Product Details -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-900">
                                            <a href="{{ route('products.show', $item->product->slug) }}" class="hover:text-primary-600 transition-colors duration-200">
                                                {{ $item->product->title }}
                                            </a>
                                        </h3>
                                        <div class="mt-1.5 flex items-center gap-2 text-xs text-gray-500">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-gray-50 text-gray-600 border border-gray-100">{{ ucwords(str_replace('_', ' ', $item->product->condition)) }}</span>
                                            @if($item->product->size)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-gray-50 text-gray-600 border border-gray-100">{{ $item->product->size }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Remove Button -->
                                    <button type="button" wire:click="remove({{ $item->id }})" class="p-1.5 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 transition-all duration-200">
                                        <span class="sr-only">Remove</span>
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="mt-3 flex items-center justify-between">
                                    <p class="text-sm font-bold text-gray-900">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                    <span class="text-xs text-gray-500 bg-gray-50 px-2.5 py-1 rounded-lg border border-gray-100">Qty: {{ $item->quantity }}</span>
                                </div>

                                <div class="mt-2.5 flex items-center gap-1.5 text-xs text-green-600">
                                    <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                    <span>In stock</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Empty Cart State -->
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm py-16 px-6 text-center">
                        <div class="mx-auto w-16 h-16 rounded-2xl bg-gray-50 flex items-center justify-center mb-4">
                            <svg class="h-8 w-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-gray-900">Your cart is empty</h3>
                        <p class="mt-1 text-sm text-gray-500">Looks like you haven't added anything yet.</p>
                        <div class="mt-6">
                            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-600 text-white text-sm font-medium rounded-xl hover:bg-primary-700 transition-all duration-200 shadow-sm">
                                Continue Shopping
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforelse
            </section>

            <!-- Order Summary -->
            <section aria-labelledby="summary-heading" class="mt-10 lg:mt-0 lg:col-span-5">
                <div class="bg-gray-50/50 rounded-2xl border border-gray-100 shadow-sm px-5 py-6 sm:p-6">
                    <h2 id="summary-heading" class="text-base font-bold text-gray-900">Order Summary</h2>

                    <dl class="mt-5 space-y-4">
                        <div class="flex items-center justify-between">
                            <dt class="text-sm text-gray-500">Subtotal</dt>
                            <dd class="text-sm font-semibold text-gray-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</dd>
                        </div>
                        <div class="border-t border-gray-100 pt-4 flex items-center justify-between">
                            <dt class="text-sm text-gray-500">Shipping estimate</dt>
                            <dd class="text-sm text-gray-500">Calculated at checkout</dd>
                        </div>
                        <div class="border-t border-gray-100 pt-4 flex items-center justify-between">
                            <dt class="text-base font-bold text-gray-900">Order total</dt>
                            <dd class="text-base font-bold text-gray-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</dd>
                        </div>
                    </dl>

                    <div class="mt-6">
                        <a href="{{ route('checkout.index') }}" class="w-full flex justify-center items-center px-5 py-3 rounded-xl shadow-sm text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200 {{ $cartItems->isEmpty() ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}">
                            Proceed to Checkout
                            <svg class="ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </section>
        </form>
    </div>
</div>
