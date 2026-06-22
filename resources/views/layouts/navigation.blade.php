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

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
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
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-100">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                {{ __('Shop') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('blog.index')" :active="request()->routeIs('blog.*')">
                {{ __('Blog') }}
            </x-responsive-nav-link>
            @auth
                <x-responsive-nav-link :href="route('seller.dashboard')" :active="request()->routeIs('seller.dashboard')">
                    {{ __('My Listings') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('seller.orders.index')" :active="request()->routeIs('seller.orders.index')">
                    {{ __('Incoming Orders') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        @auth
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-100">
            <div class="px-4 flex items-center">
                @if(Auth::user()->avatar)
                    <img class="h-10 w-10 rounded-full object-cover mr-3 ring-2 ring-gray-100" src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" />
                @else
                    <div class="h-10 w-10 rounded-full bg-primary-50 text-primary-600 flex items-center justify-center font-semibold mr-3">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                @endif
                <div>
                    <div class="font-medium text-base text-gray-900">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                @if(Auth::user()->is_admin)
                    <x-responsive-nav-link :href="route('admin.dashboard')">
                        {{ __('Admin Panel') }}
                    </x-responsive-nav-link>
                @endif

                <x-responsive-nav-link :href="route('orders.index')">
                    {{ __('My Orders') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @else
        <div class="pt-4 pb-3 border-t border-gray-100">
            <div class="px-4 space-y-2">
                <a href="{{ route('login') }}" class="block w-full text-center rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">Log in</a>
                <a href="{{ route('register') }}" class="block w-full text-center rounded-lg border border-transparent bg-primary-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-primary-700 transition-colors">Register</a>
            </div>
        </div>
        @endauth
    </div>
</nav>
