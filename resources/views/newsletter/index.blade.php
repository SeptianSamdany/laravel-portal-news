{{-- filepath: resources/views/newsletter/index.blade.php --}}
@extends('layouts.standard')

@section('title', 'Newsletter Subscription - ' . config('app.name'))

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-lg mx-auto bg-white rounded shadow p-8">
        <h1 class="text-2xl font-bold mb-4 text-center">Subscribe to Our Newsletter</h1>
        <p class="mb-6 text-gray-600 text-center">
            Get the latest news and articles delivered straight to your inbox.
        </p>

        @if(session('newsletter_status'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('newsletter_status') }}
            </div>
        @endif

        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-4">
            @csrf
            <input
                type="email"
                name="email"
                value="{{ old('email', auth()->user()->email ?? '') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded"
                placeholder="Your email address"
                required
                @auth readonly @endauth
            >
            @error('email')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror

            @auth
                <button type="submit" class="w-full py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Subscribe
                </button>
            @else
                <div class="flex flex-col md:flex-row items-center justify-center gap-4">
                    <a href="{{ route('login') }}" class="w-full md:w-auto px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        Login
                    </a>
                    <span class="text-gray-600">or</span>
                    <a href="{{ route('register') }}" class="w-full md:w-auto px-6 py-2 bg-gray-200 text-blue-700 rounded hover:bg-gray-300 transition">
                        Register
                    </a>
                </div>
                <p class="mt-3 text-gray-500 text-center">Login or register to subscribe to our newsletter.</p>
            @endauth
        </form>
    </div>
</div>
@endsection