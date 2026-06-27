<nav x-data="{ open: false }" class="bg-white/95 backdrop-blur-md border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <span class="text-xl font-extrabold tracking-tight text-gray-900">Thrift<span class="text-primary-600">In</span></span>
                    </a>
                </div>

                <div class="hidden gap-10 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')" class="text-gray-600 font-medium">
                        {{ __('Shop') }}
                    </x-nav-link>
                    <x-nav-link :href="route('blog.index')" :active="request()->routeIs('blog.*')" class="text-gray-600 font-medium">
                        {{ __('Blog') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Search Bar (Livewire component placeholder) -->
            <div class="hidden sm:flex flex-1 items-center justify-center px-8">
                <div class="w-full max-w-lg">
                    @livewire('search-bar')
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-6">
                @auth
                    <!-- Sell Link -->
                    <a href="{{ route('seller.dashboard') }}" class="text-sm font-medium text-gray-600 hover:text-primary-600 transition-colors py-2">
                        Sell
                    </a>

                    <div class="h-5 w-px bg-gray-200"></div>
                    
                    <div class="flex items-center gap-5">
                        <!-- Wishlist Icon -->
                        <a href="{{ route('wishlist.index') }}" class="text-gray-500 hover:text-primary-600 relative transition-colors flex items-center justify-center">
                            <span class="sr-only">View wishlist</span>
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </a>
                        
                        <!-- Notification Bell -->
                        <div class="flex items-center justify-center">
                            @livewire('notification.notification-bell')
                        </div>

                        <!-- Cart Icon -->
                        <div class="flex items-center justify-center">
                            @livewire('cart.cart-button')
                        </div>
                    </div>

                    <div class="h-5 w-px bg-gray-200"></div>

                    <!-- Settings Dropdown -->
                    <div class="flex items-center justify-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center text-gray-500 hover:text-primary-600 focus:outline-none transition ease-in-out duration-150 py-1">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                @if(Auth::user()->is_admin)
                                    <x-dropdown-link :href="route('admin.dashboard')">
                                        {{ __('Admin Panel') }}
                                    </x-dropdown-link>
                                    <div class="border-t border-gray-100"></div>
                                @endif

                                <x-dropdown-link :href="route('orders.index')">
                                    {{ __('My Orders') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors py-2">Log in</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-lg border border-transparent bg-primary-600 px-5 py-2 text-sm font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all duration-150">Register</a>
                    </div>
                @endauth
            </div>

            <!-- Mobile Right Actions and Hamburger -->
            <div class="flex items-center gap-3 sm:hidden">
                @auth
                    <!-- Wishlist Icon -->
                    <a href="{{ route('wishlist.index') }}" class="text-gray-500 hover:text-primary-600 relative transition-colors flex items-center justify-center">
                        <span class="sr-only">View wishlist</span>
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </a>
                    
                    <!-- Notification Bell -->
                    <div class="flex items-center justify-center">
                        @livewire('notification.notification-bell')
                    </div>

                    <!-- Cart Icon -->
                    <div class="flex items-center justify-center">
                        @livewire('cart.cart-button')
                    </div>
                @endauth

                <!-- Hamburger -->
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 focus:text-gray-600 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div x-cloak :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden absolute top-full left-0 w-full border-t border-gray-100 bg-white shadow-2xl pb-2 z-40 max-h-[calc(100vh-4rem)] overflow-y-auto">
        <div class="pt-2 pb-2">
            
            <div class="px-4 py-2 text-xs font-bold text-gray-400 uppercase tracking-wider">{{ __('Menu') }}</div>
            <x-responsive-nav-link :href="route('blog.index')" :active="request()->routeIs('blog.*')">
                <span class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    {{ __('Blog') }}
                </span>
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                <span class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    {{ __('Buy') }}
                </span>
            </x-responsive-nav-link>

            @auth
                <div class="px-4 py-2 mt-4 text-xs font-bold text-gray-400 uppercase tracking-wider">{{ __('Akun') }}</div>
                @if(Auth::user()->is_admin)
                    <x-responsive-nav-link :href="route('admin.dashboard')">
                        <span class="flex items-center gap-3 text-primary-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ __('Admin Panel') }}
                        </span>
                    </x-responsive-nav-link>
                @endif

                <x-responsive-nav-link :href="route('seller.dashboard')" :active="request()->routeIs('seller.dashboard')">
                    <span class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        {{ __('Sell') }}
                    </span>
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('orders.index')">
                    <span class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        {{ __('My Purchase') }}
                    </span>
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('profile.edit')">
                    <span class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        {{ __('Profile') }}
                    </span>
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <span class="flex items-center gap-3 text-red-600">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            {{ __('Log Out') }}
                        </span>
                    </x-responsive-nav-link>
                </form>
            @endauth
        </div>

        @guest
        <div class="pt-4 pb-3 border-t border-gray-100">
            <div class="px-4 space-y-2">
                <a href="{{ route('login') }}" class="block w-full text-center rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">Log in</a>
                <a href="{{ route('register') }}" class="block w-full text-center rounded-lg border border-transparent bg-primary-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-primary-700 transition-colors">Register</a>
            </div>
        </div>
        @endguest
    </div>
</nav>
