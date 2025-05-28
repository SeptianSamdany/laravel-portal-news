{{-- tags/index.blade.php --}}
{{-- This view displays a list of tags with their respective articles. --}}
@extends('layouts.standard')

@section('title', 'Browse Tags')
@section('meta_description', 'Explore articles by tags and discover content through popular topics and keywords.')

@section('content')
<div class="min-h-screen bg-white">
    <!-- Page Header -->
    <div class="bg-gray-50 border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Browse Tags
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Discover articles through popular tags and topics that connect our content.
                </p>
            </div>
        </div>
    </div>
    
    <!-- Tags Content -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if($tags->where('articles_count', '>', 0)->isNotEmpty())
        
        <!-- Tags Statistics -->
        <div class="mb-12 text-center">
            <div class="inline-flex items-center space-x-8 text-sm text-gray-500">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    <span>{{ $tags->where('articles_count', '>', 0)->count() }} Active Tags</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>{{ $tags->sum('articles_count') }} Total Articles</span>
                </div>
            </div>
        </div>
        
        <!-- Sort Options -->
        <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600">Sort by:</span>
                <div class="flex space-x-2">
                    <a href="{{ route('tags.index', ['sort' => 'popular']) }}" 
                       class="px-3 py-1 text-sm {{ $sort === 'popular' ? 'bg-red-600 text-white' : 'text-gray-600 hover:bg-gray-100' }} rounded-full transition-colors">
                        Popular
                    </a>
                    <a href="{{ route('tags.index', ['sort' => 'alphabetical']) }}" 
                       class="px-3 py-1 text-sm {{ $sort === 'alphabetical' ? 'bg-red-600 text-white' : 'text-gray-600 hover:bg-gray-100' }} rounded-full transition-colors">
                        Alphabetical
                    </a>
                    <a href="{{ route('tags.index', ['sort' => 'recent']) }}" 
                       class="px-3 py-1 text-sm {{ $sort === 'recent' ? 'bg-red-600 text-white' : 'text-gray-600 hover:bg-gray-100' }} rounded-full transition-colors">
                        Recent
                    </a>
                </div>
            </div>
            
            <div class="text-sm text-gray-500">
                Showing {{ $tags->where('articles_count', '>', 0)->count() }} tags with articles
            </div>
        </div>
        
        <!-- Tags Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($tags->where('articles_count', '>', 0) as $tag)
            <div class="group">
                <a href="{{ route('tags.show', $tag->slug) }}" class="block">
                    <!-- Tag Card -->
                    <div class="bg-white border border-gray-200 hover:border-gray-300 hover:shadow-md transition-all duration-200 p-6 h-full rounded-lg">
                        <!-- Tag Header -->
                        <div class="mb-6">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-red-600 rounded-full"></div>
                                    <h2 class="text-xl font-semibold text-gray-900 group-hover:text-red-600 transition-colors">
                                        {{ $tag->name }}
                                    </h2>
                                </div>
                                <div class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full font-medium">
                                    {{ $tag->articles_count }}
                                </div>
                            </div>
                            
                            @if($tag->description)
                            <p class="text-gray-600 text-sm line-clamp-2 leading-relaxed">
                                {{ $tag->description }}
                            </p>
                            @endif
                        </div>
                        
                        <!-- Latest Articles Preview -->
                        @if($tag->articles->isNotEmpty())
                        <div class="space-y-3">
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">
                                Latest Articles
                            </h3>
                            
                            @foreach($tag->articles as $article)
                            <div class="flex items-start space-x-3 py-2 border-b border-gray-100 last:border-b-0">
                                <div class="w-2 h-2 bg-red-600 rounded-full mt-2 flex-shrink-0"></div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-medium text-gray-900 line-clamp-1 group-hover:text-gray-700">
                                        {{ $article->title }}
                                    </h4>
                                    <p class="text-xs text-gray-500 mt-1">
                                        by {{ $article->author->name }} • {{ $article->published_at->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>
                            @endforeach
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
        
        <!-- Popular Categories Section -->
        @if($popularCategories->isNotEmpty())
        <div class="mt-20 pt-12 border-t border-gray-200">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Popular Categories</h2>
                <p class="text-gray-600">Explore content organized by categories</p>
            </div>
            
            <div class="flex flex-wrap justify-center gap-3">
                @foreach($popularCategories as $category)
                <a href="{{ route('categories.show', $category->slug) }}" 
                   class="inline-flex items-center space-x-2 px-4 py-2 bg-gray-100 hover:bg-red-600 text-gray-700 hover:text-white transition-colors text-sm rounded-full">
                    <span>{{ $category->name }}</span>
                    <span class="text-xs opacity-70">({{ $category->articles_count }})</span>
                </a>
                @endforeach
            </div>
            
            <div class="text-center mt-6">
                <a href="{{ route('categories.index') }}" class="text-red-600 hover:text-red-700 font-medium text-sm">
                    View all categories →
                </a>
            </div>
        </div>
        @endif
        
        <!-- Tag Cloud Section -->
        @if($tags->where('articles_count', '>', 0)->count() > 12)
        <div class="mt-20 pt-12 border-t border-gray-200">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Tag Cloud</h2>
                <p class="text-gray-600">Quick access to all available tags</p>
            </div>
            
            <div class="flex flex-wrap justify-center gap-2">
                @foreach($tags->where('articles_count', '>', 0)->sortBy('name') as $tag)
                @php
                $maxCount = $tags->max('articles_count');
                $minCount = $tags->min('articles_count');
                $ratio = $maxCount > $minCount ? ($tag->articles_count - $minCount) / ($maxCount - $minCount) : 0;
                $fontSize = 14 + ($ratio * 10); // Font size between 14px and 24px
                @endphp
                
                <a href="{{ route('tags.show', $tag->slug) }}" 
                   class="inline-block px-2 py-1 text-gray-600 hover:text-red-600 transition-colors rounded"
                   style="font-size: {{ $fontSize }}px;">
                    #{{ $tag->name }}
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                <h3 class="text-xl font-medium text-gray-900 mb-2">No Tags Available</h3>
                <p class="text-gray-600">Tags will appear here once articles are published with tags.</p>
            </div>
        </div>
        @endif
        
        <!-- Call to Action -->
        <div class="mt-20 text-center">
            <div class="bg-gray-50 py-12 px-6 rounded-lg">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">
                    Looking for specific content?
                </h2>
                <p class="text-gray-600 mb-6 max-w-md mx-auto">
                    Browse all our articles by categories or use the search function to find what you need.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('articles.index') }}" 
                       class="px-6 py-3 bg-red-600 text-white font-medium hover:bg-red-700 transition-colors rounded-lg">
                        Browse All Articles
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
</style>
@endsection