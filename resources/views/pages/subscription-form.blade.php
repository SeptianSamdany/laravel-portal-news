{{-- resources/views/pages/subscription-form.blade.php --}}
@extends('layouts.standard')

@section('title', 'Newsletter Subscription')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-red-50">
    <!-- Hero Header -->
    <div class="relative bg-gradient-to-r from-black via-red-900 to-black overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-red-600/20 via-transparent to-red-600/20"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-red-600 rounded-full mb-6">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                    </svg>
                </div>
                <h1 class="text-4xl md:text-6xl font-black text-white mb-4 tracking-tight">
                    Join Our <span class="text-red-400">Newsletter</span>
                </h1>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed">
                    Stay ahead with exclusive content, industry insights, and personalized updates delivered straight to your inbox.
                </p>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-red-600 via-red-500 to-red-600"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Current Subscription Status (if exists) -->
        @if($userSubscription)
            <div class="mb-8 relative overflow-hidden rounded-xl shadow-lg border-2
                {{ $userSubscription->status === 'active' ? 'border-red-500 bg-gradient-to-r from-red-50 to-white' : 
                   ($userSubscription->status === 'pending' ? 'border-yellow-500 bg-gradient-to-r from-yellow-50 to-white' : 'border-gray-500 bg-gradient-to-r from-gray-50 to-white') }}">
                <div class="absolute top-0 left-0 right-0 h-1 
                    {{ $userSubscription->status === 'active' ? 'bg-gradient-to-r from-red-600 to-red-400' : 
                       ($userSubscription->status === 'pending' ? 'bg-gradient-to-r from-yellow-600 to-yellow-400' : 'bg-gradient-to-r from-gray-600 to-gray-400') }}">
                </div>
                <div class="p-6 flex items-center">
                    <div class="flex-shrink-0">
                        @if($userSubscription->status === 'active')
                            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                                <svg class="h-6 w-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        @elseif($userSubscription->status === 'pending')
                            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                                <svg class="h-6 w-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        @else
                            <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="h-6 w-6 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-gray-900">
                            Status: {{ ucfirst($userSubscription->status) }}
                        </h3>
                        <div class="mt-1 text-gray-600">
                            @if($userSubscription->status === 'active')
                                Your subscription is active and you're receiving newsletters {{ $userSubscription->frequency }}.
                            @elseif($userSubscription->status === 'pending')
                                Your subscription is pending approval. We'll notify you once it's approved.
                            @else
                                Your previous subscription is {{ $userSubscription->status }}. You can submit a new request below.
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Content: Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-black to-red-900 p-6">
                        <h2 class="text-2xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-3 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                            Complete Your Subscription
                        </h2>
                        <p class="text-red-200 mt-2">Fill out the form below to customize your newsletter experience</p>
                    </div>
                    
                    <form action="{{ route('subscription.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                        @csrf

                        <!-- Personal Information -->
                        <div class="mb-10">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900">
                                    Personal Information
                                </h3>
                            </div>
                            
                            <div class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="group">
                                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                            Full Name *
                                        </label>
                                        <div class="relative">
                                            <input 
                                                type="text" 
                                                id="name" 
                                                name="name" 
                                                value="{{ old('name', Auth::user()->name ?? '') }}"
                                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 group-hover:border-red-300"
                                                required
                                            >
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        </div>
                                        @error('name')
                                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="group">
                                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                            Email Address *
                                        </label>
                                        <div class="relative">
                                            <input 
                                                type="email" 
                                                id="email" 
                                                name="email" 
                                                value="{{ old('email', Auth::user()->email ?? '') }}"
                                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 group-hover:border-red-300"
                                                required
                                            >
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                                </svg>
                                            </div>
                                        </div>
                                        @error('email')
                                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="group">
                                    <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Phone Number (Optional)
                                    </label>
                                    <div class="relative">
                                        <input 
                                            type="tel" 
                                            id="phone" 
                                            name="phone" 
                                            value="{{ old('phone') }}"
                                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 group-hover:border-red-300"
                                            placeholder="+62 123 456 7890"
                                        >
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    @error('phone')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Subscription Preferences -->
                        <div class="mb-10">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900">
                                    Subscription Preferences
                                </h3>
                            </div>
                            
                            <!-- Interests -->
                            <div class="mb-8">
                                <label class="block text-sm font-semibold text-gray-700 mb-4">
                                    Select Your Interests * (Choose at least one)
                                </label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    @foreach($interestOptions as $value => $label)
                                        <label class="group relative flex items-center p-4 border-2 border-gray-200 rounded-xl hover:border-red-300 hover:bg-red-50 cursor-pointer transition-all duration-200">
                                            <input 
                                                type="checkbox" 
                                                name="interests[]" 
                                                value="{{ $value }}"
                                                {{ in_array($value, old('interests', [])) ? 'checked' : '' }}
                                                class="h-5 w-5 text-red-600 focus:ring-red-500 border-gray-300 rounded transition-all duration-200"
                                            >
                                            <span class="ml-3 font-medium text-gray-700 group-hover:text-red-700">{{ $label }}</span>
                                            <div class="absolute top-2 right-2 w-2 h-2 bg-red-600 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                                        </label>
                                    @endforeach
                                </div>
                                @error('interests')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Frequency -->
                            <div class="mb-8">
                                <label class="block text-sm font-semibold text-gray-700 mb-4">
                                    Newsletter Frequency *
                                </label>
                                <div class="space-y-3">
                                    @foreach($frequencyOptions as $value => $label)
                                        <label class="group relative flex items-center p-4 border-2 border-gray-200 rounded-xl hover:border-red-300 hover:bg-red-50 cursor-pointer transition-all duration-200">
                                            <input 
                                                type="radio" 
                                                name="frequency" 
                                                value="{{ $value }}"
                                                {{ old('frequency', 'weekly') === $value ? 'checked' : '' }}
                                                class="h-5 w-5 text-red-600 focus:ring-red-500 border-gray-300 transition-all duration-200"
                                                required
                                            >
                                            <span class="ml-3 font-medium text-gray-700 group-hover:text-red-700">{{ $label }}</span>
                                            <div class="absolute top-2 right-2 w-2 h-2 bg-red-600 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                                        </label>
                                    @endforeach
                                </div>
                                @error('frequency')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Payment Information -->
                        <div class="mb-10">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                        <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900">
                                    Payment Information
                                </h3>
                            </div>
                            
                            <div class="space-y-6">
                                <div class="group">
                                    <label for="amount" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Subscription Amount (IDR) *
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 text-lg font-medium">Rp</span>
                                        </div>
                                        <input 
                                            type="number" 
                                            id="amount" 
                                            name="amount" 
                                            value="{{ old('amount') }}"
                                            min="0"
                                            step="1000"
                                            class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 group-hover:border-red-300"
                                            placeholder="50,000"
                                            required
                                        >
                                    </div>
                                    @error('amount')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="group">
                                    <label for="payment_proof" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Payment Proof (Optional)
                                    </label>
                                    <div class="relative">
                                        <input 
                                            type="file" 
                                            id="payment_proof" 
                                            name="payment_proof" 
                                            accept="image/*"
                                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 group-hover:border-red-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100"
                                        >
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                        </svg>
                                        Upload screenshot or photo of your payment (JPG, PNG, GIF, max 2MB)
                                    </p>
                                    @error('payment_proof')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Terms and Submit -->
                        <div class="border-t-2 border-gray-100 pt-8">
                            <div class="flex items-start mb-8">
                                <input 
                                    type="checkbox" 
                                    id="terms" 
                                    name="terms"
                                    class="h-5 w-5 text-red-600 focus:ring-red-500 border-gray-300 rounded mt-1"
                                    required
                                >
                                <label for="terms" class="ml-3 text-sm text-gray-700 leading-relaxed">
                                    I agree to the <a href="#" class="text-red-600 hover:text-red-500 font-semibold underline decoration-2 underline-offset-2">Terms of Service</a> 
                                    and <a href="#" class="text-red-600 hover:text-red-500 font-semibold underline decoration-2 underline-offset-2">Privacy Policy</a> *
                                </label>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-4">
                                <button 
                                    type="submit"
                                    class="flex-1 bg-gradient-to-r from-red-600 to-red-700 text-white py-4 px-6 rounded-xl font-bold hover:from-red-700 hover:to-red-800 focus:outline-none focus:ring-4 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl"
                                >
                                    <span class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        Submit Subscription Request
                                    </span>
                                </button>
                                <a 
                                    href="{{ url()->previous() }}" 
                                    class="flex-1 sm:flex-none bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 py-4 px-6 rounded-xl font-bold hover:from-gray-200 hover:to-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200 text-center border-2 border-gray-300 hover:border-gray-400"
                                >
                                    <span class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                        Cancel
                                    </span>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Column: Payment Details -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 sticky top-4 overflow-hidden">
                    <div class="bg-gradient-to-r from-black to-red-900 p-6">
                        <h3 class="text-xl font-bold text-white flex items-center">
                            <svg class="h-6 w-6 mr-3 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                            </svg>
                            Payment Details
                        </h3>
                        <p class="text-red-200 mt-2">Choose your preferred payment method</p>
                    </div>
                    
                    <div class="p-6">
                        <!-- Bank Transfer -->
                        <div class="mb-8">
                            <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="h-4 w-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                        <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                Bank Transfer
                            </h4>
                            <div class="space-y-4">
                                <div class="bg-gradient-to-r from-gray-50 to-white p-4 rounded-xl border-2 border-gray-100 hover:border-red-200 transition-all duration-200">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="font-bold text-gray-900">Bank BCA</div>
                                        <div class="w-8 h-5 bg-blue-600 rounded text-xs text-white font-bold flex items-center justify-center">BCA</div>
                                    </div>
                                    <div class="text-gray-600 font-mono text-sm">123-456-7890</div>
                                    <div class="text-gray-600 text-sm">PT. Newsletter Company</div>
                                </div>
                                <div class="bg-gradient-to-r from-gray-50 to-white p-4 rounded-xl border-2 border-gray-100 hover:border-red-200 transition-all duration-200">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="font-bold text-gray-900">Bank Mandiri</div>
                                        <div class="w-8 h-5 bg-yellow-500 rounded text-xs text-white font-bold flex items-center justify-center">MDR</div>
                                    </div>
                                    <div class="text-gray-600 font-mono text-sm">987-654-3210</div>
                                    <div class="text-gray-600 text-sm">PT. Newsletter Company</div>
                                </div>
                            </div>
                        </div>

                        <!-- E-Wallet -->
                        <div class="mb-8">
                            <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="h-4 w-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                    </svg>
                                </div>
                                E-Wallet
                            </h4>
                            <div class="space-y-4">
                                <div class="bg-gradient-to-r from-green-50 to-white p-4 rounded-xl border-2 border-gray-100 hover:border-green-200 transition-all duration-200">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="font-bold text-gray-900">GoPay</div>
                                        <div class="w-8 h-5 bg-green-600 rounded text-xs text-white font-bold flex items-center justify-center">GO</div>
                                    </div>
                                    <div class="text-gray-600 font-mono text-sm">081234567890</div>
                                </div>
                                <div class="bg-gradient-to-r from-blue-50 to-white p-4 rounded-xl border-2 border-gray-100 hover:border-blue-200 transition-all duration-200">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="font-bold text-gray-900">Dana</div>
                                        <div class="w-8 h-5 bg-blue-600 rounded text-xs text-white font-bold flex items-center justify-center">DN</div>
                                    </div>
                                    <div class="text-gray-600 font-mono text-sm">081234567890</div>
                                </div>
                                <div class="bg-gradient-to-r from-purple-50 to-white p-4 rounded-xl border-2 border-gray-100 hover:border-purple-200 transition-all duration-200">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="font-bold text-gray-900">OVO</div>
                                        <div class="w-8 h-5 bg-purple-600 rounded text-xs text-white font-bold flex items-center justify-center">OVO</div>
                                    </div>
                                    <div class="text-gray-600 font-mono text-sm">081234567890</div>
                                </div>
                            </div>
                        </div>

                        <!-- Important Notes -->
                        <div class="bg-gradient-to-r from-red-50 to-red-100 border-2 border-red-200 rounded-xl p-4">
                            <h4 class="text-lg font-bold text-red-800 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                Important Notes
                            </h4>
                            <ul class="text-sm text-red-700 space-y-2">
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Please include your name in the transfer description
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Upload payment proof for faster processing
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Processing time: 1-2 business days
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Help Section -->
                <div class="mt-6 bg-gradient-to-br from-black via-gray-900 to-red-900 rounded-2xl text-white p-6 shadow-2xl">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a1 1 0 011 1v3a1 1 0 11-2 0V6a1 1 0 011-1zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold">Need Help?</h4>
                    </div>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        If you have any questions about our subscription service, our support team is here to help you 24/7.
                    </p>
                    <div class="space-y-3">
                        <a href="mailto:support@example.com" class="flex items-center text-white hover:text-red-300 transition-all duration-200 p-3 rounded-lg hover:bg-white/10">
                            <div class="w-8 h-8 bg-red-600/20 rounded-lg flex items-center justify-center mr-3">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold">Email Support</div>
                                <div class="text-sm text-gray-300">support@example.com</div>
                            </div>
                        </a>
                        <a href="tel:+621234567890" class="flex items-center text-white hover:text-red-300 transition-all duration-200 p-3 rounded-lg hover:bg-white/10">
                            <div class="w-8 h-8 bg-red-600/20 rounded-lg flex items-center justify-center mr-3">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold">Phone Support</div>
                                <div class="text-sm text-gray-300">+62 123 456 7890</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto-format phone number
    document.getElementById('phone').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.startsWith('62')) {
            value = '+' + value;
        } else if (value.startsWith('0')) {
            value = '+62' + value.substring(1);
        }
        e.target.value = value;
    });

    // Format amount with thousand separators
    document.getElementById('amount').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        e.target.value = value;
    });

    // Add smooth scroll animation for form sections
    document.querySelectorAll('input, select, textarea').forEach(element => {
        element.addEventListener('focus', function() {
            this.parentElement.classList.add('scale-105');
            this.parentElement.style.transition = 'transform 0.2s ease-in-out';
        });
        
        element.addEventListener('blur', function() {
            this.parentElement.classList.remove('scale-105');
        });
    });

    // Add loading state to submit button
    const form = document.querySelector('form');
    const submitBtn = form.querySelector('button[type="submit"]');
    
    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <span class="flex items-center justify-center">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Processing...
            </span>
        `;
    });
</script>
@endpush
@endsection