{{-- resources/views/pages/subscription-success.blade.php --}}
@extends('layouts.standard')

@section('title', 'Subscription Success')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-white to-red-50 py-16 px-4">
    <div class="bg-white rounded-2xl shadow-xl p-10 max-w-lg w-full text-center border border-red-100">
        <div class="flex justify-center mb-6">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </div>
        <h1 class="text-2xl font-bold text-gray-900 mb-4">Subscription Request Submitted!</h1>
        <p class="text-gray-700 mb-6">
            Thank you for subscribing to our newsletter.<br>
            We have received your request and will review it soon.<br>
            You will be notified once your subscription is approved.
        </p>
        <a href="{{ url('/') }}" class="inline-block bg-red-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-red-700 transition">
            Back to Home
        </a>
    </div>
</div>
@endsection