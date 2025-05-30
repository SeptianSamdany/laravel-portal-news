{{-- filepath: c:\Laravel\laravel-portal-news\resources\views\articles\trending.blade.php --}}
@extends('layouts.standard')

@section('title', 'Trending Articles - ' . config('app.name'))
@section('meta_description', 'Discover the most popular and trending articles that everyone is reading right now.')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section - 5 Trending Articles -->
    @if($trendingArticles->count() > 0)
        @php
            $topTrending = $trendingArticles->take(5);
            $mainArticle = $topTrending->first();
            $sideArticles = $topTrending->skip(1);
        @endphp
        
        <div class="bg-white">
            <div class="container mx-auto px-4 py-16">
                <div class="max-w-6xl mx-auto">
                    <!-- Simple Trending Header -->
                    <div class="mb-8">
                        <div class="flex items-center space-x-3 mb-2">
                            <div class="w-1 h-8 bg-red-600"></div>
                            <h2 class="text-2xl md:text-3xl font-bold text-black">Trending Articles</h2>
                        </div>
                    </div>
                    
                    <div class="grid lg:grid-cols-2 gap-12">
                        <!-- Main Article -->
                        <div class="space-y-6">
                            <!-- Trending Badge -->
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                </svg>
                                <span class="text-sm font-medium text-red-600">#1 TRENDING</span>
                            </div>
                            
                            <!-- Category -->
                            @if($mainArticle->category)
                                <div>
                                    <a href="{{ route('articles.index', ['category' => $mainArticle->category->slug]) }}" 
                                    class="text-sm text-gray-600 hover:text-red-600 font-medium uppercase tracking-wide transition-colors">
                                        {{ $mainArticle->category->name }}
                                    </a>
                                </div>
                            @endif
                            
                            <!-- Main Image -->
                            <div class="relative">
                                <img src="{{ Storage::url($mainArticle->thumbnail) }}" 
                                    alt="{{ $mainArticle->title }}" 
                                    class="w-full h-64 md:h-80 object-cover">
                                <div class="absolute top-4 right-4 bg-white p-2 shadow-md">
                                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Title -->
                            <h1 class="text-2xl md:text-3xl font-bold text-black leading-tight hover:text-red-600 transition-colors cursor-pointer">
                                {{ $mainArticle->title }}
                            </h1>
                            
                            <!-- Excerpt -->
                            <p class="text-gray-700 leading-relaxed">
                                {{ Str::limit($mainArticle->excerpt, 140) }}
                            </p>
                            
                            <!-- Meta Info -->
                            <div class="flex items-center space-x-6 text-sm text-gray-500 pt-4 border-t border-gray-100">
                                <span class="font-medium text-black">{{ $mainArticle->author->name }}</span>
                                <span>{{ $mainArticle->published_at->format('M d, Y') }}</span>
                                <span>{{ number_format($mainArticle->views_count) }} views</span>
                            </div>
                            
                            <!-- CTA Button -->
                            <div class="pt-2">
                                <a href="{{ route('articles.show', $mainArticle->slug) }}" 
                                class="inline-flex items-center px-6 py-3 bg-red-600 text-white font-medium hover:bg-white hover:text-red-600 hover:border border-red-600 transition-colors duration-300">
                                    Read Article
                                    <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Side Articles -->
                        <div class="space-y-8">
                            @foreach($sideArticles as $index => $article)
                                <div class="flex gap-4 pb-8 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                                    <!-- Trending Icon -->
                                    <div class="flex-shrink-0 pt-1">
                                        <div class="w-8 h-8 bg-red-600 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                            </svg>
                                        </div>
                                    </div>
                                    
                                    <!-- Article Image -->
                                    <div class="flex-shrink-0">
                                        <img src="{{ Storage::url($article->thumbnail) }}" 
                                            alt="{{ $article->title }}" 
                                            class="w-20 h-20 md:w-24 md:h-24 object-cover">
                                    </div>
                                    
                                    <!-- Article Content -->
                                    <div class="flex-1 min-w-0">
                                        <!-- Category -->
                                        @if($article->category)
                                            <div class="mb-2">
                                                <a href="{{ route('articles.index', ['category' => $article->category->slug]) }}" 
                                                class="text-xs text-gray-600 hover:text-red-600 font-medium uppercase tracking-wide transition-colors">
                                                    {{ $article->category->name }}
                                                </a>
                                            </div>
                                        @endif
                                        
                                        <!-- Title -->
                                        <h3 class="font-bold text-black mb-2 leading-tight hover:text-red-600 transition-colors">
                                            <a href="{{ route('articles.show', $article->slug) }}">
                                                {{ Str::limit($article->title, 80) }}
                                            </a>
                                        </h3>
                                        
                                        <!-- Meta -->
                                        <div class="flex items-center space-x-4 text-xs text-gray-500">
                                            <span class="font-medium text-black">{{ $article->author->name }}</span>
                                            <span>{{ $article->published_at->format('M d') }}</span>
                                            <span>{{ number_format($article->views_count) }} views</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                            <!-- View More Link -->
                            <div class="pt-4">
                                <a href="{{ route('articles.trending') }}" 
                                class="flex items-center text-sm font-medium text-gray-600 hover:text-red-600 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                    </svg>
                                    View all trending articles
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container mx-auto px-4 pb-16">
    <!-- Section Header -->
    <div class="mb-12">
        <div class="flex items-center space-x-3 mb-2">
            <div class="w-1 h-8 bg-red-600"></div>
            <h2 class="text-2xl md:text-3xl font-bold text-black">More Trending Stories</h2>
        </div>
    </div>
    
    @if($trendingArticles->count() > 1)
    @php
        $remainingTrending = $trendingArticles->skip(1);
        $topThree = $remainingTrending->take(3);
        $otherTrending = $remainingTrending->skip(3);
    @endphp
    
    <!-- Top 3 Trending Articles -->
    @if($topThree->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
        @foreach($topThree as $index => $article)
        <article class="bg-white border border-gray-100 overflow-hidden hover:shadow-md transition-all duration-300">
            <a href="{{ route('articles.show', $article->slug) }}" class="block">
                <!-- Image -->
                <div class="relative">
                    <img src="{{ Storage::url($article->thumbnail) }}" 
                         alt="{{ $article->title }}" 
                         class="w-full h-48 object-cover">
                    
                    <!-- Trending Icon -->
                    <div class="absolute top-4 left-4">
                        <div class="w-8 h-8 bg-red-600 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                    </div>
                    
                    {{-- <!-- Category Badge -->
                    @if($article->category)
                    <div class="absolute bottom-4 left-4">
                        <span class="px-3 py-1 rounded-lg bg-red-600 text-white text-xs font-medium">
                            {{ $article->category->name }}
                        </span>
                    </div>
                    @endif --}}
                </div>
                
                <!-- Content -->
                <div class="p-6">
                    <!-- Category -->
                    @if($article->category)
                    <span class="text-xs text-red-600 hover:text-red-400 font-medium mb-4 block uppercase tracking-wide transition-colors">
                        {{ $article->category->name }}
                    </span>
                    @endif

                    <h3 class="text-lg font-bold text-black mb-3 leading-tight hover:text-red-600 transition-colors">
                        {{ $article->title }}
                    </h3>
                    
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                        {{ $article->excerpt }}
                    </p>
                    
                    <!-- Meta -->
                    <div class="flex items-center justify-between text-sm pt-4 border-t border-gray-100">
                        <div class="flex items-center space-x-2 text-gray-500">
                            <span class="font-medium text-black">{{ $article->author->name }}</span>
                            <span>•</span>
                            <span>{{ $article->published_at->format('M d') }}</span>
                        </div>
                        <span class="text-gray-500">{{ number_format($article->views_count) }} views</span>
                    </div>
                </div>
            </a>
        </article>
        @endforeach
    </div>
    @endif
    
    <!-- Other Trending Articles -->
    @if($otherTrending->count() > 0)
    <div class="bg-white border border-gray-100 p-8">
        <div class="flex items-center space-x-3 mb-8">
            <div class="w-1 h-6 bg-red-600"></div>
            <h3 class="text-xl font-bold text-black">All Trending Stories</h3>
        </div>
        
        <div class="space-y-8">
            @foreach($otherTrending as $index => $article)
            <article class="border-b border-gray-100 pb-8 last:border-b-0">
                <a href="{{ route('articles.show', $article->slug) }}" class="block hover:bg-gray-50 rounded p-4 -m-4 transition-colors">
                    <div class="flex items-start space-x-6">
                        <!-- Trending Icon -->
                        <div class="flex-shrink-0 pt-1">
                            <div class="w-8 h-8 bg-red-600 flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Thumbnail -->
                        <div class="flex-shrink-0">
                            <img src="{{ Storage::url($article->thumbnail) }}" 
                                 alt="{{ $article->title }}" 
                                 class="w-20 h-16 object-cover">
                        </div>
                        
                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <!-- Category -->
                            @if($article->category)
                            <span class="text-xs text-red-600 hover:text-red-400 font-medium mb-2 block uppercase tracking-wide transition-colors">
                                {{ $article->category->name }}
                            </span>
                            @endif
                            
                            <!-- Title -->
                            <h4 class="text-base font-bold text-black mb-3 line-clamp-2 hover:text-red-600 transition-colors">
                                {{ $article->title }}
                            </h4>
                            
                            <!-- Meta -->
                            <div class="flex items-center justify-between text-sm">
                                <div class="flex items-center space-x-4 text-gray-500">
                                    <span class="font-medium text-black">{{ $article->author->name }}</span>
                                    <span>{{ $article->published_at->format('M d, Y') }}</span>
                                </div>
                                <span class="text-gray-500">{{ number_format($article->views_count) }} views</span>
                            </div>
                        </div>
                    </div>
                </a>
            </article>
            @endforeach
        </div>
        
        <!-- View More Button -->
        <div class="pt-4 mt-4 border-t border-gray-100 flex justify-end">
            <a href="{{ route('articles.trending') }}" 
            class="inline-flex items-center text-red-600 hover:text-red-400 transition-colors duration-300">
                View All Trending Articles
                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </div>
    @endif
    
    @else
    <!-- Empty State -->
    <div class="py-16 text-center">
        <div class="max-w-sm mx-auto">
            <div class="w-16 h-16 bg-gray-100 flex items-center justify-center mx-auto mb-6">
                <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-black mb-2">No Trending Articles Yet</h3>
            <p class="text-gray-600">Check back later to see what's trending.</p>
        </div>
    </div>
    @endif
    
    <!-- Pagination -->
    @if($trendingArticles->hasPages())
    <div class="mt-12 flex justify-center">
        <div class="pagination-wrapper">
            {{ $trendingArticles->links() }}
        </div>
    </div>
    @endif
</div>
</div>
<style>
.pagination-wrapper .pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 8px;
}

.pagination-wrapper .pagination li {
    display: flex;
}

.pagination-wrapper .pagination a,
.pagination-wrapper .pagination span {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    height: 40px;
    padding: 0 12px;
    border: 1px solid #e5e7eb;
    background: white;
    color: #374151;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
}

.pagination-wrapper .pagination a:hover {
    background: #ef4444;
    color: white;
    border-color: #ef4444;
}

.pagination-wrapper .pagination .active span {
    background: #000;
    color: white;
    border-color: #000;
}
</style>
@endsection