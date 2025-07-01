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
</form>
</x-guest-layout>