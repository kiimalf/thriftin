<x-auth-split-layout>
    <div class="min-h-screen flex">
        <!-- Left Side: Form -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-16 lg:px-24 bg-white py-12">
            <div class="max-w-md w-full mx-auto">
                <a href="{{ route('home') }}" class="block mb-10">
                    <span class="text-2xl font-black text-primary-600 tracking-tighter uppercase">THRIFTIN</span>
                </a>
                
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome Back</h2>
                <p class="text-gray-600 mb-8">Sign in to continue shopping preloved fashion</p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email Address')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="you@example.com" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4 relative">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" placeholder="Enter your password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm font-medium text-primary-600 hover:text-primary-500 hover:underline" href="{{ route('password.request') }}">
                                {{ __('Forgot Password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                            Sign In
                        </button>
                    </div>
                </form>

                <div class="mt-8">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">or continue with</span>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            <!-- Google Icon SVG -->
                            <svg class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                            Google
                        </a>
                        <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            <!-- Facebook Icon SVG -->
                            <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
                            Facebook
                        </a>
                    </div>
                </div>

                <p class="mt-8 text-center text-sm text-gray-600">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="font-semibold text-primary-600 hover:text-primary-500 hover:underline">Create one now</a>
                </p>
            </div>
        </div>

        <!-- Right Side: Marketing/Stats -->
        <div class="hidden lg:flex w-1/2 bg-gray-50 flex-col justify-center items-center p-12 border-l border-gray-200 relative overflow-hidden">
            <!-- Decorative Squares -->
            <div class="absolute top-0 right-0 w-80 h-80 border-l border-b border-gray-200 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-white border-t border-r border-gray-200 pointer-events-none"></div>

            <div class="max-w-md text-center relative z-10">
                <div class="mb-8 inline-flex items-center justify-center w-24 h-24 bg-gray-900 text-white text-4xl rounded-xl shadow-lg">
                    👕
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Discover Unique<br>Preloved Fashion</h2>
                <p class="text-gray-600 mb-12">Join thousands of fashion lovers buying and selling quality clothing. Sustainable style starts here.</p>
                
                <div class="grid grid-cols-3 gap-8 border-t border-gray-200 pt-8">
                    <div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">10K+</div>
                        <div class="text-sm text-gray-500">Items Listed</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">5K+</div>
                        <div class="text-sm text-gray-500">Happy Users</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">98%</div>
                        <div class="text-sm text-gray-500">Satisfaction</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-auth-split-layout>
