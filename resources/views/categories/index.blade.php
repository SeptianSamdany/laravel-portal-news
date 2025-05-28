{{-- categories/index.blade.php --}}
{{-- This view displays a list of categories with their respective articles. --}}
@extends('layouts.standard')

@section('title', 'Browse Categories')
@section('meta_description', 'Explore articles by category and discover content that interests you most.')

@section('content')
<div class="min-h-screen bg-white">
   <!-- Page Header -->
    <div class="bg-gray-50 border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Browse Categories
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Explore our collection of articles organized by topics that matter to you.
                </p>
            </div>
        </div>
    </div>
    
    <!-- Categories Grid -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if($categories->isNotEmpty())
        
        <!-- Categories Statistics -->
        <div class="mb-12 text-center">
            <div class="inline-flex items-center space-x-8 text-sm text-gray-500">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    <span>{{ $categories->count() }} Categories</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>{{ $categories->sum(function($cat) { return $cat->articles()->where('status', 'published')->count(); }) }} Total Articles</span>
                </div>
            </div>
        </div>
        
        <!-- Categories Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($categories as $category)
            @php
            $articleCount = $category->articles()->where('status', 'published')->count();
            $latestArticles = $category->articles()->with('author')->where('status', 'published')->latest('published_at')->take(3)->get();
            @endphp
            
            <div class="group">
                <a href="{{ route('categories.show', $category->slug) }}" class="block">
                    <!-- Category Card -->
                    <div class="bg-white border border-gray-200 hover:border-gray-300 transition-colors p-6 h-full">
                        <!-- Category Header -->
                        <div class="mb-6">
                            <div class="flex items-center justify-between mb-3">
                                <h2 class="text-xl font-semibold text-gray-900 group-hover:text-red-600 transition-colors">
                                    {{ $category->name }}
                                </h2>
                                <div class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                                    {{ $articleCount }}
                                </div>
                            </div>
                            
                            @if($category->description)
                            <p class="text-gray-600 text-sm line-clamp-2 leading-relaxed">
                                {{ $category->description }}
                            </p>
                            @endif
                        </div>
                        
                        <!-- Latest Articles Preview -->
                        @if($latestArticles->isNotEmpty())
                        <div class="space-y-3">
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">
                                Latest Articles
                            </h3>
                            
                            @foreach($latestArticles as $article)
                            <div class="flex items-start space-x-3 py-2 border-b border-gray-100 last:border-b-0">
                                <div class="w-2 h-2 bg-red-600 rounded-full mt-2 flex-shrink-0"></div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-medium text-gray-900 line-clamp-1 group-hover:text-gray-700">
                                        {{ $article->title }}
                                    </h4>
                                    <p class="text-xs text-gray-500 mt-1">
                                        by {{ $article->author->name }} • {{ $article->published_at->format('M d') }}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <!-- Empty State for Category -->
                        <div class="text-center py-8">
                            <svg class="w-8 h-8 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="text-sm text-gray-500">No articles yet</p>
                        </div>
                        @endif
                        
                        <!-- View All Link -->
                        <div class="mt-6 pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-red-600 font-medium group-hover:text-red-700">
                                    View all articles
                                </span>
                                <svg class="w-4 h-4 text-red-600 group-hover:text-red-700 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        
        <!-- Popular Tags Section -->
        @if($tags->isNotEmpty())
        <div class="mt-20 pt-12 border-t border-gray-200">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Popular Tags</h2>
                <p class="text-gray-600">Discover content by exploring popular tags</p>
            </div>
            
            <div class="flex flex-wrap justify-center gap-3">
                @foreach($tags->take(20) as $tag)
                @php
                $tagArticleCount = $tag->articles()->where('status', 'published')->count();
                @endphp
                
                @if($tagArticleCount > 0)
                <a href="{{ route('tags.show', $tag->slug) }}" 
                   class="inline-flex items-center space-x-2 px-4 py-2 bg-gray-100 hover:bg-red-600 text-gray-700 hover:text-white transition-colors text-sm">
                    <span>{{ $tag->name }}</span>
                    <span class="text-xs opacity-70">({{ $tagArticleCount }})</span>
                </a>
                @endif
                @endforeach
            </div>
            
            @if($tags->count() > 20)
            <div class="text-center mt-6">
                <a href="{{ route('tags.index') }}" class="text-red-600 hover:text-red-700 font-medium text-sm">
                    View all tags →
                </a>
            </div>
            @endif
        </div>
        @endif
        
        @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="max-w-md mx-auto">
                <svg class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                <h3 class="text-xl font-medium text-gray-900 mb-2">No Categories Available</h3>
                <p class="text-gray-600">Categories will appear here once they are created and activated.</p>
            </div>
        </div>
        @endif
        
        <!-- Call to Action -->
        <div class="mt-20 text-center">
            <div class="bg-gray-50 py-12 px-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">
                    Can't find what you're looking for?
                </h2>
                <p class="text-gray-600 mb-6 max-w-md mx-auto">
                    Browse all our articles or use the search function to find specific topics.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('articles.index') }}" 
                       class="px-6 py-3 bg-red-600 text-white font-medium hover:bg-red-700 transition-colors">
                        Browse All Articles
                    </a>
                    <a href="{{ route('search.index') }}" 
                       class="px-6 py-3 border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition-colors">
                        Search Articles
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
</style>
@endsection