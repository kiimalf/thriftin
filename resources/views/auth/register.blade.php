<x-auth-split-layout>
    <div class="min-h-screen flex flex-col-reverse lg:flex-row">
        <!-- Left Side: Marketing/Stats -->
        <div class="hidden lg:flex w-1/2 bg-gray-50 flex-col justify-center items-center p-12 border-r border-gray-200 relative overflow-hidden">
            <!-- Decorative Squares -->
            <div class="absolute top-0 left-0 w-80 h-80 border-r border-b border-gray-200 pointer-events-none"></div>
            <div class="absolute bottom-0 right-0 w-80 h-80 bg-white border-t border-l border-gray-200 pointer-events-none"></div>

            <div class="max-w-md w-full relative z-10">
                <div class="mb-8 inline-flex items-center justify-center w-24 h-24 bg-gray-900 text-white text-4xl rounded-xl shadow-lg">
                    👗
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Start Your Sustainable<br>Fashion Journey</h2>
                <p class="text-gray-600 mb-12">Create your account and join a community passionate about quality preloved clothing.</p>
                
                <div class="space-y-8">
                    <div class="flex">
                        <div class="flex-shrink-0 mt-1">
                            <div class="flex items-center justify-center h-6 w-6 rounded bg-gray-900 text-white">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Buy & Sell Easily</h3>
                            <p class="mt-1 text-sm text-gray-500">List your items in minutes and discover unique pieces daily</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 mt-1">
                            <div class="flex items-center justify-center h-6 w-6 rounded bg-gray-900 text-white">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Secure Transactions</h3>
                            <p class="mt-1 text-sm text-gray-500">Shop with confidence using our buyer protection</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-shrink-0 mt-1">
                            <div class="flex items-center justify-center h-6 w-6 rounded bg-gray-900 text-white">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Eco-Conscious Community</h3>
                            <p class="mt-1 text-sm text-gray-500">Reduce waste and give clothing a second life</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-16 lg:px-24 bg-white py-12">
            <div class="max-w-md w-full mx-auto">
                <a href="{{ route('home') }}" class="block mb-10">
                    <span class="text-2xl font-black text-primary-600 tracking-tighter uppercase">THRIFTIN</span>
                </a>
                
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Create Account</h2>
                <p class="text-gray-600 mb-8">Join the preloved fashion revolution</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Full Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="John Doe" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email Address')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="you@example.com" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4 relative">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" placeholder="Create a strong password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4 relative">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" placeholder="Re-enter your password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    
                    <!-- Terms -->
                    <div class="mt-6 flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" type="checkbox" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500" name="terms" required>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="font-medium text-gray-700">I agree to the <a href="#" class="text-primary-600 hover:underline">Terms of Service</a> and <a href="#" class="text-primary-600 hover:underline">Privacy Policy</a></label>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                            Create Account
                        </button>
                    </div>
                </form>

                <div class="mt-8">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">or sign up with</span>
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
                    Already have an account? 
                    <a href="{{ route('login') }}" class="font-semibold text-primary-600 hover:text-primary-500 hover:underline">Sign in here</a>
                </p>
            </div>
        </div>
    </div>
</x-auth-split-layout>
