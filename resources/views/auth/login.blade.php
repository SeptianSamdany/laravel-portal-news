<x-guest-layout>
<!-- Header -->
<div class="text-center mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Selamat Datang</h1>
    <p class="text-gray-500 mt-2">Silakan masuk ke akun Anda</p>
</div>

<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<form method="POST" action="{{ route('login') }}">
    @csrf
    
    <!-- Email Address -->
    <div>
        <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
        <x-text-input id="email" 
            class="block mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50 auth-input" 
            type="email" 
            name="email" 
            :value="old('email')" 
            required 
            autofocus 
            autocomplete="username" 
            placeholder="name@example.com" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-5">
        <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
        <x-text-input id="password" 
            class="block mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50 auth-input"
            type="password"
            name="password"
            required 
            autocomplete="current-password"
            placeholder="••••••••" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Remember Me and Forgot Password -->
    <div class="flex items-center justify-between mt-5">
        <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500" name="remember">
            <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
        </label>
        
        @if (Route::has('password.request'))
            <a class="text-sm text-red-600 hover:text-red-800 transition duration-150" href="{{ route('password.request') }}">
                {{ __('Lupa password?') }}
            </a>
        @endif
    </div>

    <!-- Login Button -->
    <div class="mt-6">
        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-white bg-gradient-to-r from-red-600 to-red-600 hover:from-red-700 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 font-medium text-sm auth-button">
            {{ __('Masuk') }}
        </button>
    </div>
    
    <!-- Register Link -->
    <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-medium text-red-600 hover:text-red-800 transition duration-150">
                Daftar sekarang
            </a>
        </p>
    </div>
    
    <!-- Social Login Options -->
    <div class="mt-8">
        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-200"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">Atau masuk dengan</span>
            </div>
        </div>
        
        <div class="mt-6">
            <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                Google
            </a>
        </div>
    </div>
</form>
</x-guest-layout>