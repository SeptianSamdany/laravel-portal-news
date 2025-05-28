{{-- filepath: resources/views/authors/apply.blade.php --}}
@extends('layouts.standard')

@section('title', 'Apply as Author - Join Our Writing Community')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-red-50 via-white to-red-50 py-16 overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <svg class="w-full h-full" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                    <path d="M 10 0 L 0 0 0 10" fill="none" stroke="currentColor" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid)" />
        </svg>
    </div>
    
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <!-- Icon -->
        <div class="inline-flex items-center justify-center w-16 h-16 bg-red-600 rounded-full mb-6">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
        </div>
        
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
            Join Our <span class="text-red-600">Writing Community</span>
        </h1>
        <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
            Share your expertise, inspire readers, and become part of NewsHub's growing community of talented writers and thought leaders.
        </p>
        
        <!-- Benefits Preview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
            <div class="bg-white/60 backdrop-blur-sm p-6 rounded-xl border border-gray-200">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Global Audience</h3>
                <p class="text-sm text-gray-600">Reach thousands of engaged readers worldwide</p>
            </div>
            
            <div class="bg-white/60 backdrop-blur-sm p-6 rounded-xl border border-gray-200">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Creative Freedom</h3>
                <p class="text-sm text-gray-600">Write about topics you're passionate about</p>
            </div>
            
            <div class="bg-white/60 backdrop-blur-sm p-6 rounded-xl border border-gray-200">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Editorial Support</h3>
                <p class="text-sm text-gray-600">Professional editing and publishing assistance</p>
            </div>
        </div>
    </div>
</div>

<!-- Application Form Section -->
<div class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Left Column - Info -->
            <div class="lg:col-span-4">
                <div class="sticky top-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Ready to Get Started?</h2>
                    <p class="text-gray-600 mb-8">Fill out the application form and we'll review your submission within 2-3 business days.</p>
                    
                    <!-- What We're Looking For -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 mb-6">
                        <h3 class="font-semibold text-gray-900 mb-4">What We're Looking For:</h3>
                        <ul class="space-y-3 text-sm text-gray-600">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Original, engaging content
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Strong writing skills
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Subject matter expertise
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Consistent publishing schedule
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Contact Info -->
                    <div class="text-sm text-gray-500">
                        <p class="mb-2">Have questions?</p>
                        <a href="mailto:authors@newshub.com" class="text-red-600 hover:text-red-700 font-medium">authors@newshub.com</a>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Form -->
            <div class="lg:col-span-8">
                @if(session('success'))
                    <div class="mb-8 p-4 bg-green-50 border border-green-200 rounded-xl">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-green-700 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif
                
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8">
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Author Application</h3>
                        <p class="text-gray-600">Tell us about yourself and your writing experience.</p>
                    </div>
                    
                    <form action="{{ route('authors.apply.submit') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Name Field -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required 
                                   placeholder="Enter your full name"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition-colors @error('name') border-red-500 @enderror" />
                            @error('name') 
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        
                        <!-- Email Field -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   placeholder="your.email@example.com"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition-colors @error('email') border-red-500 @enderror" />
                            @error('email') 
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        
                        <!-- Bio Field -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                Professional Bio
                            </label>
                            <p class="text-sm text-gray-500 mb-3">Tell us about your background, expertise, and writing experience. What makes you a great fit for our platform?</p>
                            <textarea name="bio" 
                                      rows="5" 
                                      placeholder="I'm a passionate writer with expertise in... I've been writing about... My goal is to..."
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition-colors resize-none @error('bio') border-red-500 @enderror">{{ old('bio') }}</textarea>
                            @error('bio') 
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        
                        <!-- Portfolio Field -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                Portfolio / Website
                                <span class="text-sm font-normal text-gray-500">(Optional)</span>
                            </label>
                            <p class="text-sm text-gray-500 mb-3">Share a link to your portfolio, personal website, or published work examples.</p>
                            <input type="url" 
                                   name="portfolio" 
                                   value="{{ old('portfolio') }}" 
                                   placeholder="https://yourportfolio.com"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition-colors @error('portfolio') border-red-500 @enderror" />
                            @error('portfolio') 
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        
                        <!-- Terms Agreement -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="flex items-start cursor-pointer">
                                <input type="checkbox" 
                                       required 
                                       class="mt-1 w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                <span class="ml-3 text-sm text-gray-700">
                                    I agree to NewsHub's <a href="#" class="text-red-600 hover:text-red-700 underline">Author Guidelines</a> and <a href="#" class="text-red-600 hover:text-red-700 underline">Terms of Service</a>. I understand that my application will be reviewed and I'll be contacted within 2-3 business days.
                                </span>
                            </label>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold py-4 px-6 rounded-lg hover:from-red-700 hover:to-red-800 focus:ring-4 focus:ring-red-500/25 transform transition-all duration-200 hover:scale-[1.02] focus:scale-[1.02] shadow-lg">
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    Submit My Application
                                </span>
                            </button>
                        </div>
                        
                        <!-- Help Text -->
                        <div class="text-center pt-4">
                            <p class="text-sm text-gray-500">
                                This usually takes less than 5 minutes to complete
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FAQ Section -->
<div class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h2>
            <p class="text-lg text-gray-600">Get answers to common questions about becoming a NewsHub author.</p>
        </div>
        
        <div class="space-y-6">
            <div class="bg-gray-50 rounded-xl p-6">
                <h3 class="font-semibold text-gray-900 mb-2">How long does the application process take?</h3>
                <p class="text-gray-600">We typically review applications within 2-3 business days. You'll receive an email with our decision and next steps.</p>
            </div>
            
            <div class="bg-gray-50 rounded-xl p-6">
                <h3 class="font-semibold text-gray-900 mb-2">What topics can I write about?</h3>
                <p class="text-gray-600">We welcome diverse perspectives across technology, business, lifestyle, culture, and more. We're looking for authentic voices with unique insights.</p>
            </div>
            
            <div class="bg-gray-50 rounded-xl p-6">
                <h3 class="font-semibold text-gray-900 mb-2">Do I need prior publishing experience?</h3>
                <p class="text-gray-600">While publishing experience is helpful, we value great writing and unique perspectives above all. We're happy to work with passionate new writers.</p>
            </div>
            
            <div class="bg-gray-50 rounded-xl p-6">
                <h3 class="font-semibold text-gray-900 mb-2">How often do I need to publish?</h3>
                <p class="text-gray-600">We're flexible with publishing schedules. Many authors publish 1-2 articles per week, but we can work with your availability and preferred frequency.</p>
            </div>
        </div>
    </div>
</div>
@endsection