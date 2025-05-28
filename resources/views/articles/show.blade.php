{{-- resources/views/articles/show.blade.php --}}
@extends('layouts.standard')

@section('title', $article->title)
@section('meta_description', $article->excerpt)

@section('meta_keywords', $article->tags->pluck('name')->implode(', '))
@section('meta_image', $article->thumbnail ? Storage::url($article->thumbnail) : asset('default-image.jpg'))

@section('content')
<div class="min-h-screen bg-white">
    <!-- Article Header -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
        
        <!-- Breadcrumb -->
        <nav class="mb-8" aria-label="Breadcrumb">
            <ol class="flex flex-wrap items-center space-x-2 text-sm text-gray-500">
                <!-- Home -->
                <li>
                    <a href="{{ route('articles.index') }}" class="hover:text-red-600 transition-colors font-medium">
                        Home
                    </a>
                </li>
                <li>
                    <span class="text-gray-400">›</span>
                </li>

                <!-- Category -->
                @if($article->category)
                    <li>
                        <a href="{{ route('categories.show', $article->category->slug) }}"
                        class="hover:text-red-600 transition-colors font-medium">
                            {{ $article->category->name }}
                        </a>
                    </li>
                    <li>
                        <span class="text-gray-400">›</span>
                    </li>
                @endif

                <!-- Current Article -->
                <li class="text-red-600 font-semibold truncate max-w-[200px] sm:max-w-xs md:max-w-sm">
                    {{ Str::limit($article->title, 70) }}
                </li>
            </ol>
        </nav>
        
        <!-- Article Meta -->
        <div class="mb-6">
            @if($article->category)
            <div class="mb-3">
                <a href="{{ route('categories.show', $article->category->slug) }}" 
                   class="inline-block text-red-600 text-sm font-medium uppercase tracking-wide hover:text-red-700 transition-colors">
                    {{ $article->category->name }}
                </a>
            </div>
            @endif
            
            <!-- Title -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 leading-tight mb-6">
                {{ $article->title }}
            </h1>
            
            <!-- Excerpt -->
            @if($article->excerpt)
            <p class="text-xl text-gray-600 leading-relaxed mb-8">
                {{ $article->excerpt }}
            </p>
            @endif
            
            <!-- Social Media Share Section -->
            <div class="flex items-center justify-center mb-8 p-4 rounded-lg bg-gray-50 border border-gray-200 shadow-sm">
                <div class="text-center">
                    <p class="text-sm font-medium text-gray-700 mb-3">Share this article</p>
                    <div class="flex items-center justify-center space-x-4">
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                           target="_blank" rel="noopener noreferrer"
                           class="group flex items-center justify-center w-10 h-10 rounded-full bg-blue-600 hover:bg-blue-700 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        
                        <!-- Twitter/X -->
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($article->title) }}" 
                           target="_blank" rel="noopener noreferrer"
                           class="group flex items-center justify-center w-10 h-10 rounded-full bg-black hover:bg-gray-800 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </a>
                        
                        <!-- WhatsApp -->
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($article->title . ' - ' . request()->fullUrl()) }}" 
                           target="_blank" rel="noopener noreferrer"
                           class="group flex items-center justify-center w-10 h-10 rounded-full bg-green-500 hover:bg-green-600 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.531 3.512z"/>
                            </svg>
                        </a>
                        
                        <!-- LinkedIn -->
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" 
                           target="_blank" rel="noopener noreferrer"
                           class="group flex items-center justify-center w-10 h-10 rounded-full bg-blue-700 hover:bg-blue-800 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                        
                        <!-- Telegram -->
                        <a href="https://t.me/share/url?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($article->title) }}" 
                           target="_blank" rel="noopener noreferrer"
                           class="group flex items-center justify-center w-10 h-10 rounded-full bg-blue-500 hover:bg-blue-600 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                            </svg>
                        </a>
                        
                        <!-- Copy Link -->
                        <button onclick="copyToClipboard('{{ request()->fullUrl() }}')" 
                                class="group flex items-center justify-center w-10 h-10 rounded-full bg-gray-600 hover:bg-gray-700 shadow-lg hover:shadow-xl"
                                title="Copy link">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Author & Meta Info -->
            <div class="py-8 border-t border-b border-gray-300 bg-gray-50">
                <div class="flex flex-wrap items-center justify-between">
                    <!-- Author Section -->
                    <div class="flex items-center space-x-4 group">
                        <a href="{{ route('authors.show', $article->author->slug ?? $article->author->id) }}"
                        class="flex items-center space-x-3 rounded-lg p-2 -ml-2">
                            <div class="relative">
                                <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center shadow-sm">
                                    <span class="text-base font-semibold text-white">
                                        {{ substr($article->author->name, 0, 1) }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <p class="text-base font-semibold text-gray-900 group-hover:text-red-700 transition-colors duration-200">
                                    {{ $article->author->name }}
                                </p>
                                <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">
                                    Author
                                </p>
                            </div>
                        </a>
                    </div>

                    <!-- Meta Information -->
                    <div class="flex items-center space-x-6 text-sm text-gray-700 mt-4 md:mt-0">
                        <!-- Date -->
                        <div class="flex items-center space-x-2">
                            <div class="p-1.5 bg-gray-200 rounded-full">
                                <svg class="w-4 h-4 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-800">
                                {{ $article->published_at->format('l, M d, Y') }}
                            </span>
                        </div>

                        <!-- Views -->
                        <div class="flex items-center space-x-2">
                            <div class="p-1.5 bg-gray-200 rounded-full">
                                <svg class="w-4 h-4 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0 8.268-2.943-9.542-7z"/>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-800">
                                {{ number_format($article->views_count) }}
                            </span>
                            <span class="text-gray-500 ml-1">views</span>
                        </div>

                        <!-- Read Time -->
                        <div class="flex items-center space-x-2">
                            <div class="p-1.5 bg-gray-200 rounded-full">
                                <svg class="w-4 h-4 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-800">
                                {{ ceil(str_word_count(strip_tags($article->content)) / 200) }}
                            </span>
                            <span class="text-gray-500 ml-1">min read</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Featured Image -->
        @if($article->thumbnail)
        <div class="mb-12">
            <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}" 
                 class="w-full h-[400px] md:h-[500px] object-cover">
        </div>
        @endif
        
        <!-- Article Content -->
        <div class="prose prose-lg max-w-none">
            <div class="text-gray-800 leading-relaxed">
                {!! $article->content !!}
            </div>
        </div>

        <!-- Advertisement Section -->
        @include('components.advertisement')

        <!-- Bottom Social Share Section -->
        <div class="my-12 py-8 bg-white rounded-2xl border border-gray-100">
            <div class="text-center">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Enjoyed this article?</h3>
                    <p class="text-gray-600">Share it with your friends and followers!</p>
                </div>
                
                <!-- Share Buttons Grid -->
                <div class="flex flex-wrap justify-center gap-4 max-w-md mx-auto">
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                       target="_blank" rel="noopener noreferrer"
                       class="group flex items-center space-x-2 px-4 py-2 bg-white rounded-full border border-gray-100">
                        <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center group-hover:bg-blue-700 transition-colors">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-blue-700">Facebook</span>
                    </a>
                    
                    <!-- Twitter/X -->
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($article->title) }}" 
                       target="_blank" rel="noopener noreferrer"
                       class="group flex items-center space-x-2 px-4 py-2 bg-white rounded-full border border-gray-100">
                        <div class="w-8 h-8 bg-black rounded-full flex items-center justify-center group-hover:bg-gray-800 transition-colors">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-gray-900">Twitter</span>
                    </a>
                    
                    <!-- WhatsApp -->
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($article->title . ' - ' . request()->fullUrl()) }}" 
                       target="_blank" rel="noopener noreferrer"
                       class="group flex items-center space-x-2 px-4 py-2 bg-white rounded-full border border-gray-100">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center group-hover:bg-green-600 transition-colors">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.531 3.512z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-green-700">WhatsApp</span>
                    </a>
                    
                    <!-- LinkedIn -->
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" 
                       target="_blank" rel="noopener noreferrer"
                       class="group flex items-center space-x-2 px-4 py-2 bg-white rounded-full border border-gray-100">
                        <div class="w-8 h-8 bg-blue-700 rounded-full flex items-center justify-center group-hover:bg-blue-800 transition-colors">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-blue-700">LinkedIn</span>
                    </a>
                    
                    <!-- Telegram -->
                    <a href="https://t.me/share/url?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($article->title) }}" 
                       target="_blank" rel="noopener noreferrer"
                       class="group flex items-center space-x-2 px-4 py-2 bg-white rounded-full border border-gray-100">
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center group-hover:bg-blue-600 transition-colors">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-blue-700">Telegram</span>
                    </a>
                    
                    <!-- Copy Link -->
                    <button onclick="copyToClipboard('{{ request()->fullUrl() }}')" 
                            class="group flex items-center space-x-2 px-4 py-2 bg-white rounded-full border border-gray-100"
                            title="Copy link">
                        <div class="w-8 h-8 bg-gray-600 rounded-full flex items-center justify-center group-hover:bg-gray-700 transition-colors">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-gray-900">Copy Link</span>
                    </button>
                </div>
                
                <!-- Quick Stats -->
                <div class="mt-6 flex items-center justify-center space-x-8 text-sm text-gray-500">
                    <div class="flex items-center space-x-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <span>Share the love</span>
                    </div>
                    <div class="flex items-center space-x-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <span>{{ number_format($article->views_count) }} readers</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tags -->
        @if($article->tags->isNotEmpty())
        <div class="mt-12 pt-8 border-t border-gray-200">
            <div class="flex flex-wrap items-center gap-2">
                <span class="text-sm font-medium text-gray-500 mr-2">Tags:</span>
                @foreach($article->tags as $tag)
                <a href="#" class="inline-block px-3 py-1 bg-gray-100 text-gray-700 text-sm hover:bg-gray-200 transition-colors rounded-full">
                    {{ $tag->name }}
                </a>
                @endforeach
            </div>
        </div>
        @endif
        
    </div>
    
    <!-- Floating Share Button (Mobile) -->
    <div class="fixed bottom-6 right-6 md:hidden">
        <button onclick="toggleMobileShare()" class="w-14 h-14 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-full shadow-lg hover:shadow-xl transform hover:scale-110 transition-all duration-300 flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
            </svg>
        </button>
    </div>
    
    <!-- Mobile Share Modal -->
    <div id="mobileShareModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="absolute bottom-0 left-0 right-0 bg-white rounded-t-3xl p-6">
            <div class="w-12 h-1 bg-gray-300 rounded-full mx-auto mb-6"></div>
            <h3 class="text-lg font-semibold text-center mb-6">Share this article</h3>
            
            <div class="grid grid-cols-3 gap-4 mb-6">
                <!-- Mobile Share Buttons -->
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                   target="_blank" rel="noopener noreferrer"
                   class="flex flex-col items-center p-4 rounded-xl hover:bg-gray-50 transition-colors">
                    <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mb-2">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium">Facebook</span>
                </a>
                
                <a href="https://api.whatsapp.com/send?text={{ urlencode($article->title . ' - ' . request()->fullUrl()) }}" 
                   target="_blank" rel="noopener noreferrer"
                   class="flex flex-col items-center p-4 rounded-xl hover:bg-gray-50 transition-colors">
                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mb-2">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.531 3.512z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium">WhatsApp</span>
                </a>
                
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($article->title) }}" 
                   target="_blank" rel="noopener noreferrer"
                   class="flex flex-col items-center p-4 rounded-xl hover:bg-gray-50 transition-colors">
                    <div class="w-12 h-12 bg-black rounded-full flex items-center justify-center mb-2">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium">Twitter</span>
                </a>
                
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" 
                   target="_blank" rel="noopener noreferrer"
                   class="flex flex-col items-center p-4 rounded-xl hover:bg-gray-50 transition-colors">
                    <div class="w-12 h-12 bg-blue-700 rounded-full flex items-center justify-center mb-2">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium">LinkedIn</span>
                </a>
                
                <a href="https://t.me/share/url?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($article->title) }}" 
                   target="_blank" rel="noopener noreferrer"
                   class="flex flex-col items-center p-4 rounded-xl hover:bg-gray-50 transition-colors">
                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mb-2">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium">Telegram</span>
                </a>
                
                <button onclick="copyToClipboard('{{ request()->fullUrl() }}')" 
                        class="flex flex-col items-center p-4 rounded-xl hover:bg-gray-50 transition-colors">
                    <div class="w-12 h-12 bg-gray-600 rounded-full flex items-center justify-center mb-2">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium">Copy Link</span>
                </button>
            </div>
            
            <button onclick="toggleMobileShare()" class="w-full py-3 bg-gray-100 text-gray-700 rounded-xl font-medium hover:bg-gray-200 transition-colors">
                Cancel
            </button>
        </div>
    </div>
</div>
    
    <!-- Related Articles -->
    @if($relatedArticles->isNotEmpty())
    <div class="bg-gray-50 py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Related Articles</h2>
                <p class="text-gray-600">You might also be interested in these stories</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($relatedArticles as $related)
                <article class="group bg-white shadow hover:shadow-lg transition-all duration-300 ease-in-out rounded-lg overflow-hidden hover:-translate-y-1">
                    <a href="{{ route('articles.show', $related->slug) }}" class="block">
                        <div class="relative overflow-hidden">
                            <img src="{{ Storage::url($related->thumbnail) }}" alt="{{ $related->title }}" 
                                class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300 ease-in-out">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-300"></div>
                        </div>
                        
                        <div class="p-6">
                            @if($related->category)
                            <div class="mb-2">
                                <span class="text-red-600 group-hover:text-red-700 text-xs font-medium uppercase tracking-wide transition-colors duration-200">
                                    {{ $related->category->name }}
                                </span>
                            </div>
                            @endif
                            
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-gray-700 transition-colors duration-200">
                                {{ $related->title }}
                            </h3>
                            
                            <p class="text-gray-600 group-hover:text-gray-700 text-sm mb-4 line-clamp-2 transition-colors duration-200">
                                {{ $related->excerpt }}
                            </p>
                            
                            <div class="flex items-center text-xs text-gray-500 group-hover:text-gray-600 space-x-3 transition-colors duration-200">
                                <span>{{ $related->author->name }}</span>
                                <span>{{ $related->published_at->format('M d, Y') }}</span>
                                <span>{{ number_format($related->views_count) }} views</span>
                            </div>
                        </div>
                    </a>
                </article>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    
    <!-- Comments Section -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="border-t border-gray-200 pt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">
                Comments ({{ $article->comments->count() }})
            </h2>
            
            <!-- Comment Form -->
            @auth
            <div class="mb-12">
                <form action="{{ route('comments.store', $article) }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <div>
                        <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">
                            Add a comment
                        </label>
                        <textarea name="content" id="comment" rows="4" 
                                  class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                  placeholder="Share your thoughts..."></textarea>
                    </div>
                    <div>
                        <button type="submit" 
                                class="px-6 py-2 bg-red-600 text-white font-medium hover:bg-red-700 transition-colors">
                            Post Comment
                        </button>
                    </div>
                </form>
            </div>
            @else
            <div class="mb-12 p-4 bg-gray-50 text-center">
                <p class="text-gray-600 mb-2">Please log in to leave a comment</p>
                <a href="{{ route('login') }}" class="text-red-600 hover:text-red-700 font-medium">
                    Login here
                </a>
            </div>
            @endauth
            
            <!-- Comments List -->
            <div class="space-y-8">
                @forelse($article->comments->where('parent_id', null) as $comment)
                <div class="border-b border-gray-100 pb-8 last:border-b-0">
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-sm font-medium text-gray-600">
                                {{ substr($comment->user->name, 0, 1) }}
                            </span>
                        </div>
                        
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <h4 class="font-medium text-gray-900">{{ $comment->user->name }}</h4>
                                <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            
                            <p class="text-gray-700 leading-relaxed mb-3">{{ $comment->content }}</p>
                            
                            @auth
                            <button onclick="toggleReplyForm({{ $comment->id }})" 
                                    class="text-sm text-gray-500 hover:text-gray-700">
                                Reply
                            </button>
                            @endauth
                            
                            <!-- Reply Form -->
                            @auth
                            <div id="reply-form-{{ $comment->id }}" class="hidden mt-4">
                                <form action="{{ route('comments.store', $article) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">ho
                                    <div class="space-y-3">
                                        <textarea name="content" rows="3" 
                                                  class="w-full px-3 py-2 border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                                  placeholder="Write a reply..."></textarea>
                                        <div class="flex space-x-2">
                                            <button type="submit" 
                                                    class="px-4 py-1 bg-red-600 text-white text-sm hover:bg-red-700 transition-colors">
                                                Reply
                                            </button>
                                            <button type="button" onclick="toggleReplyForm({{ $comment->id }})"
                                                    class="px-4 py-1 bg-gray-200 text-gray-700 text-sm hover:bg-gray-300 transition-colors">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @endauth
                            
                            <!-- Replies -->
                            @if($comment->replies->isNotEmpty())
                            <div class="mt-6 space-y-4">
                                @foreach($comment->replies as $reply)
                                <div class="flex items-start space-x-4 bg-gray-50 p-4">
                                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center flex-shrink-0">
                                        <span class="text-xs font-medium text-gray-600">
                                            {{ substr($reply->user->name, 0, 1) }}
                                        </span>
                                    </div>
                                    
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-2 mb-1">
                                            <h5 class="font-medium text-gray-900 text-sm">{{ $reply->user->name }}</h5>
                                            <span class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-gray-700 text-sm">{{ $reply->content }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <p class="text-gray-500">No comments yet. Be the first to share your thoughts!</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- CSS for line clamping and prose styling -->
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.prose {
    color: #374151;
    line-height: 1.75;
}

.prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
    color: #111827;
    font-weight: 600;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.prose h1 { font-size: 2.25rem; }
.prose h2 { font-size: 1.875rem; }
.prose h3 { font-size: 1.5rem; }

.prose p {
    margin-bottom: 1.5rem;
}

.prose a {
    color: #dc2626;
    text-decoration: underline;
}

.prose a:hover {
    color: #b91c1c;
}

.prose blockquote {
    border-left: 4px solid #dc2626;
    padding-left: 1rem;
    margin: 2rem 0;
    font-style: italic;
    color: #6b7280;
}

.prose img {
    margin: 2rem 0;
    border-radius: 0.5rem;
}

.prose ul, .prose ol {
    margin: 1.5rem 0;
    padding-left: 2rem;
}

.prose li {
    margin-bottom: 0.5rem;
}
</style>

<script>
function toggleReplyForm(commentId) {
    const form = document.getElementById(`reply-form-${commentId}`);
    form.classList.toggle('hidden');
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success message
        const toast = document.createElement('div');
        toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50 transform translate-x-full opacity-0 transition-all duration-300';
        toast.textContent = 'Link copied to clipboard!';
        document.body.appendChild(toast);
        
        // Animate in
        setTimeout(() => {
            toast.classList.remove('translate-x-full', 'opacity-0');
        }, 100);
        
        // Remove after 3 seconds
        setTimeout(() => {
            toast.classList.add('translate-x-full', 'opacity-0');
            setTimeout(() => document.body.removeChild(toast), 300);
        }, 3000);
    }).catch(function(err) {
        console.error('Could not copy text: ', err);
        alert('Failed to copy link. Please try again.');
    });
}

// Mobile share modal functions
function toggleMobileShare() {
    const modal = document.getElementById('mobileShareModal');
    modal.classList.toggle('hidden');
}

// Close modal when clicking outside
document.getElementById('mobileShareModal').addEventListener('click', function(e) {
    if (e.target === this) {
        toggleMobileShare();
    }
});
</script>
@endsection