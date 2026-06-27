<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ThriftIn') }} - Better Finds, Better Prices</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased min-h-screen flex flex-col text-gray-900 bg-white">
        
        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Mobile Search Bar (Outside Navbar) - Only on relevant pages -->
        @if(request()->routeIs('home') || request()->routeIs('products.index') || request()->routeIs('blog.index'))
        <div class="sm:hidden px-4 py-3 bg-white border-b border-gray-100">
            @livewire('search-bar')
        </div>
        @endif



        <!-- Page Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-100">
            <div class="max-w-7xl mx-auto py-8 md:py-20 px-4 sm:px-6 lg:px-8">
                <!-- Desktop Footer Content -->
                <div class="hidden md:grid md:grid-cols-4 gap-10">
                    <div class="col-span-1">
                        <a href="{{ route('home') }}" class="inline-block">
                            <span class="text-2xl font-extrabold tracking-tight text-gray-900">Thrift<span class="text-primary-600">In</span></span>
                        </a>
                        <p class="mt-4 text-sm text-gray-500 leading-relaxed">
                            Better Finds, Better Prices. Your trusted marketplace for quality preloved clothing.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-xs font-semibold text-gray-400 tracking-widest uppercase">Shop</h3>
                        <ul class="mt-4 space-y-3 text-sm text-gray-600">
                            <li><a href="{{ route('products.index') }}" class="hover:text-primary-600 transition-colors">All Products</a></li>
                            <li><a href="{{ route('products.index') }}" class="hover:text-primary-600 transition-colors">Trending</a></li>
                            <li><a href="{{ route('products.index') }}" class="hover:text-primary-600 transition-colors">Top Sellers</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xs font-semibold text-gray-400 tracking-widest uppercase">Support</h3>
                        <ul class="mt-4 space-y-3 text-sm text-gray-600">
                            <li><a href="#" class="hover:text-primary-600 transition-colors">How it Works</a></li>
                            <li><a href="#" class="hover:text-primary-600 transition-colors">FAQ</a></li>
                            <li><a href="#" class="hover:text-primary-600 transition-colors">Contact Us</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xs font-semibold text-gray-400 tracking-widest uppercase">Legal</h3>
                        <ul class="mt-4 space-y-3 text-sm text-gray-600">
                            <li><a href="#" class="hover:text-primary-600 transition-colors">Privacy Policy</a></li>
                            <li><a href="#" class="hover:text-primary-600 transition-colors">Terms of Service</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Mobile Footer Content -->
                <div class="md:hidden flex flex-col items-center justify-center space-y-4">
                    <a href="{{ route('home') }}" class="inline-block">
                        <span class="text-2xl font-extrabold tracking-tight text-gray-900">Thrift<span class="text-primary-600">In</span></span>
                    </a>
                </div>

                <div class="mt-6 md:mt-10 border-t border-gray-100 pt-6 md:pt-8 flex items-center justify-center md:justify-between">
                    <p class="text-sm text-gray-400 text-center">
                        &copy; {{ date('Y') }} ThriftIn. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>

        @livewireScripts
        @stack('scripts')
    </body>
</html>
