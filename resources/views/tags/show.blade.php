{{-- tags/show.blade.php --}}
{{-- This view displays articles for a specific tag. --}}
@extends('layouts.standard')

@section('title', 'Articles tagged with "' . $tag->name . '"')
@section('meta_description', 'Browse all articles tagged with ' . $tag->name . '. Discover related content and topics.')

@section('content')
<div class="min-h-screen bg-white">
    <!-- Page Header -->
    <div class="bg-gray-50 border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-6">
                <a href="{{ route('home') }}" class="hover:text-red-600 transition-colors">Home</a>
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <a href="{{ route('tags.index') }}" class="hover:text-red-600 transition-colors">Tags</a>
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-900">{{ $tag->name }}</span>
            </nav>
            
            <div class="text-center">
                <div class="flex items-center justify-center space-x-3 mb-4">
                    <div class="w-4 h-4 bg-red-600 rounded-full"></div>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900">
                        {{ $tag->name }}
                    </h1>
                </div>
                
                @if($tag->description)
                <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-4">
                    {{ $tag->description }}
                </p>
                @endif
                
                <div class="inline-flex items-center space-x-2 text-sm text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>{{ $articles->total() }} {{ Str::plural('article', $articles->total()) }}</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Articles Content -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if($articles->isNotEmpty())
        
        <!-- Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($articles as $article)
            <article class="group">
                <a href="{{ route('articles.show', $article->slug) }}" class="block">
                    <!-- Article Card -->
                    <div class="bg-white border border-gray-200 hover:border-gray-300 hover:shadow-md transition-all duration-200 p-6 h-full rounded-lg">
                        <!-- Article Meta -->
                        <div class="flex items-center space-x-2 mb-3">
                            @if($article->category)
                            <a href="{{ route('categories.show', $article->category->slug) }}" 
                               class="inline-block px-2 py-1 bg-red-100 text-red-600 text-xs font-medium rounded-full hover:bg-red-200 transition-colors">
                                {{ $article->category->name }}
                            </a>
                            @endif
                            <span class="text-xs text-gray-500">
                                {{ $article->published_at->format('M d, Y') }}
                            </span>
                        </div>
                        
                        <!-- Article Title -->
                        <h2 class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-red-600 transition-colors line-clamp-2">
                            {{ $article->title }}
                        </h2>
                        
                        <!-- Article Excerpt -->
                        @if($article->excerpt)
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3 leading-relaxed">
                            {{ $article->excerpt }}
                        </p>
                        @endif
                        
                        <!-- Article Tags -->
                        @if($article->tags->isNotEmpty())
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach($article->tags->take(3) as $articleTag)
                            <span class="inline-block px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-full
                                       {{ $articleTag->id === $tag->id ? 'bg-red-100 text-red-600' : '' }}">
                                #{{ $articleTag->name }}
                            </span>
                            @endforeach
                            @if($article->tags->count() > 3)
                            <span class="inline-block px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">
                                +{{ $article->tags->count() - 3 }} more
                            </span>
                            @endif
                        </div>
                        @endif
                        
                        <!-- Article Author and Read More -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center space-x-2">
                                <div class="w-6 h-6 bg-gray-300 rounded-full flex-shrink-0"></div>
                                <span class="text-sm text-gray-600">{{ $article->author->name }}</span>
                            </div>
                            <div class="flex items-center text-sm text-red-600 group-hover:text-red-700">
                                <span class="font-medium">Read more</span>
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            </article>
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($articles->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $articles->links() }}
        </div>
        @endif
        
        <!-- Related Tags Section -->
        @if($relatedTags->isNotEmpty())
        <div class="mt-20 pt-12 border-t border-gray-200">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Related Tags</h2>
                <p class="text-gray-600">Explore similar topics and discover more content</p>
            </div>
            
            <div class="flex flex-wrap justify-center gap-3">
                @foreach($relatedTags as $relatedTag)
                <a href="{{ route('tags.show', $relatedTag->slug) }}" 
                   class="inline-flex items-center space-x-2 px-4 py-2 bg-gray-100 hover:bg-red-600 text-gray-700 hover:text-white transition-colors text-sm rounded-full">
                    <span>#{{ $relatedTag->name }}</span>
                    <span class="text-xs opacity-70">({{ $relatedTag->articles_count }})</span>
                </a>
                @endforeach
            </div>
        </div>
        @endif
        
        @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="max-w-md mx-auto">
                <svg class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="text-xl font-medium text-gray-900 mb-2">No Articles Found</h3>
                <p class="text-gray-600 mb-6">
                    There are no published articles with the tag "{{ $tag->name }}" yet.
                </p>
                <a href="{{ route('tags.index') }}" 
                   class="inline-block px-6 py-3 bg-red-600 text-white font-medium hover:bg-red-700 transition-colors rounded-lg">
                    Browse All Tags
                </a>
            </div>
        </div>
        @endif
        
        <!-- Call to Action -->
        <div class="mt-20 text-center">
            <div class="bg-gray-50 py-12 px-6 rounded-lg">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">
                    Discover More Content
                </h2>
                <p class="text-gray-600 mb-6 max-w-md mx-auto">
                    Explore other tags and categories to find more interesting articles.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('tags.index') }}" 
                       class="px-6 py-3 bg-red-600 text-white font-medium hover:bg-red-700 transition-colors rounded-lg">
                        Browse All Tags
                    </a>
                    <a href="{{ route('categories.index') }}" 
                       class="px-6 py-3 border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition-colors rounded-lg">
                        View Categories
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

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
</style>
@endsection