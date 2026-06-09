<x-app-layout>
    <div class="bg-gray-50 py-16">
        <div class="max-w-max mx-auto">
            <main class="sm:flex">
                <div class="flex-shrink-0 flex justify-center">
                    <svg class="h-16 w-16 text-green-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="sm:ml-6 text-center sm:text-left mt-4 sm:mt-0">
                    <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight sm:text-5xl">Payment Successful!</h1>
                    <p class="mt-2 text-base text-gray-500">Your order #{{ $midtransOrderId }} has been placed successfully.</p>
                    <p class="mt-2 text-base text-gray-500">The seller has been notified and will process your order soon.</p>
                    <div class="mt-6 flex space-x-3 sm:border-transparent sm:pl-0 justify-center sm:justify-start">
                        <a href="{{ route('orders.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700">
                            View My Orders
                        </a>
                        <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-primary-700 bg-primary-100 hover:bg-primary-200">
                            Back to Home
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
