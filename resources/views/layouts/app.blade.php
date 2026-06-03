<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ThriftIn') }} - Better Finds, Better Prices</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased h-full flex flex-col text-gray-900 bg-gray-50 selection:bg-primary-500 selection:text-white">
        
        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow-sm border-b border-gray-100">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 mt-auto">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-1">
                        <span class="text-2xl font-bold text-primary-600 tracking-tight">Thrift<span class="text-gray-900">In</span></span>
                        <p class="mt-4 text-sm text-gray-500">
                            Better Finds, Better Prices. Your trusted marketplace for quality preloved clothing.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase">Shop</h3>
                        <ul class="mt-4 space-y-2 text-sm text-gray-500">
                            <li><a href="#" class="hover:text-primary-600">All Products</a></li>
                            <li><a href="#" class="hover:text-primary-600">Trending</a></li>
                            <li><a href="#" class="hover:text-primary-600">Top Sellers</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase">Support</h3>
                        <ul class="mt-4 space-y-2 text-sm text-gray-500">
                            <li><a href="#" class="hover:text-primary-600">How it Works</a></li>
                            <li><a href="#" class="hover:text-primary-600">FAQ</a></li>
                            <li><a href="#" class="hover:text-primary-600">Contact Us</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase">Legal</h3>
                        <ul class="mt-4 space-y-2 text-sm text-gray-500">
                            <li><a href="#" class="hover:text-primary-600">Privacy Policy</a></li>
                            <li><a href="#" class="hover:text-primary-600">Terms of Service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-8 border-t border-gray-200 pt-8 flex items-center justify-between">
                    <p class="text-sm text-gray-400">
                        &copy; {{ date('Y') }} ThriftIn. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>

        @livewireScripts
    </body>
</html>
