@extends('layouts.standard')

@section('title', $author->name . ' - Author Profile')
@section('meta_description', 'Read articles by ' . $author->name . ' and discover their latest insights and expertise.')

@section('content')
<div class="min-h-screen bg-white">
    <!-- Author Header -->
    <div class="bg-gray-50 border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
                <!-- Author Avatar -->
                <div class="flex-shrink-0">
                    <div class="w-32 h-32 bg-gray-200 rounded-full flex items-center justify-center">
                        @if($author->avatar)
                        <img src="{{ asset('storage/avatars/' . $author->avatar) }}" alt="{{ $author->name }}" class="w-32 h-32 rounded-full object-cover">
                        @else
                        <span class="text-4xl font-bold text-gray-600">
                            {{ substr($author->name, 0, 1) }}
                        </span>
                        @endif
                    </div>
                </div>
                
                <!-- Author Info -->
                <div class="flex-1 text-center md:text-left">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                        {{ $author->name }}
                    </h1>
                    
                    @if($author->title)
                    <p class="text-lg text-gray-600 mb-4">{{ $author->title }}</p>
                    @endif
                    
                    @if($author->bio)
                    <p class="text-gray-700 max-w-3xl leading-relaxed mb-6">
                        {{ $author->bio }}
                    </p>
                    @endif
                    
                    <!-- Author Stats -->
                    <div class="flex flex-wrap justify-center md:justify-start gap-6 text-sm">
                        <div class="flex items-center space-x-2 text-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>{{ $articles->total() }} Articles</span>
                        </div>
                        <div class="flex items-center space-x-2 text-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <span>{{ number_format($author->articles()->where('status', 'published')->sum('views_count')) }} Total Views</span>
                        </div>
                        <div class="flex items-center space-x-2 text-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0V6a2 2 0 012-2h4a2 2 0 012 2v1m-6 0a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V9a2 2 0 00-2-2H8z"/>
                            </svg>
                            <span>Joined {{ $author->created_at->format('M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Articles Section -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if($articles->isNotEmpty())
        
        <!-- Filters and Sorting -->
        <div class="mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <!-- Results Count -->
                <div class="text-gray-600">
                    Showing {{ $articles->firstItem() }}-{{ $articles->lastItem() }} of {{ $articles->total() }} articles
                </div>
                
                <!-- Filters -->
                <div class="flex flex-wrap items-center gap-4">
                    <!-- Category Filter -->
                    <div class="relative">
                        <select id="categoryFilter" class="appearance-none bg-white border border-gray-300 rounded px-4 py-2 pr-8 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Sort Filter -->
                    <div class="relative">
                        <select id="sortFilter" class="appearance-none bg-white border border-gray-300 rounded px-4 py-2 pr-8 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <option value="newest" {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>Newest First</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Active Filters -->
            @if(request('category') || request('tag'))
            <div class="mt-4 flex flex-wrap items-center gap-2">
                <span class="text-sm text-gray-600">Active filters:</span>
                
                @if(request('category'))
                @php
                $categoryName = $categories->where('slug', request('category'))->first()->name ?? request('category');
                @endphp
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                    {{ $categoryName }}
                    <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" class="ml-2 text-red-600 hover:text-red-800">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </a>
                </span>
                @endif
                
                @if(request('tag'))
                @php
                $tagName = $tags->where('slug', request('tag'))->first()->name ?? request('tag');
                @endphp
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    {{ $tagName }}
                    <a href="{{ request()->fullUrlWithQuery(['tag' => null]) }}" class="ml-2 text-blue-600 hover:text-blue-800">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </a>
                </span>
                @endif
                
                <a href="{{ route('authors.show', $author->id) }}" class="text-sm text-red-600 hover:text-red-800">
                    Clear all
                </a>
            </div>
            @endif
        </div>
        
        <!-- Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($articles as $article)
            <article class="group">
                <a href="{{ route('articles.show', $article->slug) }}" class="block">
                    <div class="bg-white border border-gray-200 hover:border-gray-300 transition-colors h-full">
                        <!-- Article Image -->
                        @if($article->featured_image)
                        <div class="aspect-w-16 aspect-h-9 overflow-hidden">
                            <img src="{{ asset('storage/articles/' . $article->featured_image) }}" 
                                alt="{{ $article->title }}" 
                                class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        @endif
                        
                        <div class="p-6">
                            <!-- Category & Date -->
                            <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                                @if($article->category)
                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded uppercase tracking-wide font-medium">
                                    {{ $article->category->name }}
                                </span>
                                @endif
                                <span>{{ $article->published_at->format('M d, Y') }}</span>
                            </div>
                            
                            <!-- Title -->
                            <h2 class="text-lg font-semibold text-gray-900 group-hover:text-red-600 transition-colors mb-3 line-clamp-2">
                                {{ $article->title }}
                            </h2>
                            
                            <!-- Excerpt -->
                            @if($article->excerpt)
                            <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                                {{ $article->excerpt }}
                            </p>
                            @endif
                            
                            <!-- Article Stats -->
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <span>{{ number_format($article->views_count) }}</span>
                                    </div>
                                    @if($article->comments_count > 0)
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                        </svg>
                                        <span>{{ $article->comments_count }}</span>
                                    </div>
                                    @endif
                                </div>
                                
                                <!-- Read More -->
                                <span class="text-red-600 font-medium group-hover:text-red-700">
                                    Read more →
                                </span>
                            </div>
                            
                            <!-- Tags -->
                            @if($article->tags->isNotEmpty())
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <div class="flex flex-wrap gap-1">
                                    @foreach($article->tags->take(3) as $tag)
                                    <span class="inline-block text-xs text-gray-500 hover:text-red-600 cursor-pointer">
                                        #{{ $tag->name }}
                                    </span>
                                    @endforeach
                                    @if($article->tags->count() > 3)
                                    <span class="text-xs text-gray-400">+{{ $article->tags->count() - 3 }}</span>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </a>
            </article>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $articles->links() }}
        </div>
        
        @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="max-w-md mx-auto">
                <svg class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="text-xl font-medium text-gray-900 mb-2">No Articles Found</h3>
                <p class="text-gray-600 mb-6">
                    @if(request('category') || request('tag'))
                        No articles match your current filters. Try adjusting your search criteria.
                    @else
                        {{ $author->name }} hasn't published any articles yet.
                    @endif
                </p>
                
                @if(request('category') || request('tag'))
                <a href="{{ route('authors.show', $author->id) }}" 
                   class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-medium hover:bg-red-700 transition-colors rounded">
                    View All Articles
                </a>
                @else
                <a href="{{ route('articles.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-medium hover:bg-red-700 transition-colors rounded">
                    Browse All Articles
                </a>
                @endif
            </div>
        </div>
        @endif
        
        <!-- Back to Authors -->
        <div class="mt-16 pt-8 border-t border-gray-200 text-center">
            <a href="{{ route('authors.index') }}" 
               class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition-colors rounded">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to All Authors
            </a>
        </div>
    </div>
</div>

<!-- JavaScript for Filters -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const categoryFilter = document.getElementById('categoryFilter');
    const sortFilter = document.getElementById('sortFilter');
    
    function updateFilters() {
        const url = new URL(window.location);
        const params = new URLSearchParams(url.search);
        
        // Update category parameter
        if (categoryFilter.value) {
            params.set('category', categoryFilter.value);
        } else {
            params.delete('category');
        }
        
        // Update sort parameter
        if (sortFilter.value && sortFilter.value !== 'newest') {
            params.set('sort', sortFilter.value);
        } else {
            params.delete('sort');
        }
        
        // Remove page parameter when filters change
        params.delete('page');
        
        // Navigate to updated URL
        window.location.href = url.pathname + '?' + params.toString();
    }
    
    categoryFilter.addEventListener('change', updateFilters);
    sortFilter.addEventListener('change', updateFilters);
});
</script>

<!-- CSS for line clamping -->
<style>
.line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.aspect-w-16 {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
}

.aspect-w-16 > * {
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}
</style>
@endsection