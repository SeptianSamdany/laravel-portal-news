@extends('layouts.standard')

@section('title', $query ? 'Search Results for "' . $query . '"' : 'Search Articles')
@section('meta_description', $query ? 'Search results for "' . $query . '" - Find articles, insights and stories from our collection.' : 'Search through our collection of articles and find the content you\'re looking for.')

@section('content')
<!-- Hero Search Section -->
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
        <!-- Search Icon -->
        <div class="inline-flex items-center justify-center w-16 h-16 bg-red-600 rounded-full mb-6">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
        
        @if($query)
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Search <span class="text-red-600">Results</span>
            </h1>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                Found {{ $articles->total() }} {{ Str::plural('result', $articles->total()) }} for 
                <span class="font-semibold text-gray-900">"{{ $query }}"</span>
            </p>
        @else
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                <span class="text-red-600">Search</span> Articles
            </h1>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                Discover articles, insights and stories from our collection
            </p>
        @endif
        
        <!-- Search Form -->
        <div class="max-w-xl mx-auto mb-8">
            <form action="{{ route('search.index') }}" method="GET" class="relative">
                <input type="text" 
                       name="q" 
                       value="{{ $query }}" 
                       placeholder="Search articles..." 
                       class="w-full px-6 py-4 pr-16 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none text-lg shadow-sm">
                <button type="submit" 
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 p-3 text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </form>
        </div>
        
        @if($query && $articles->isNotEmpty())
        <!-- Results Summary -->
        <div class="inline-flex items-center space-x-6 text-sm text-gray-500 bg-white/60 backdrop-blur-sm px-6 py-3 rounded-full border border-gray-200">
            <div class="flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span>{{ $articles->total() }} {{ Str::plural('Article', $articles->total()) }}</span>
            </div>
            <div class="flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Page {{ $articles->currentPage() }} of {{ $articles->lastPage() }}</span>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Main Content -->
<div class="py-16 bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($articles->isNotEmpty() && $query)
            <!-- Articles Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
                @foreach($articles as $article)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300 group">
                    <a href="{{ route('articles.show', $article->slug) }}" class="block">
                        <!-- Article Thumbnail -->
                        <div class="aspect-video bg-gray-200 overflow-hidden">
                            @if($article->thumbnail)
                                <img src="{{ Storage::url($article->thumbnail) }}" 
                                     alt="{{ $article->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Article Content -->
                        <div class="p-6">
                            <!-- Category & Meta -->
                            <div class="flex items-center justify-between mb-4">
                                @if($article->category)
                                <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-xs font-semibold uppercase tracking-wide">
                                    {{ $article->category->name }}
                                </span>
                                @endif
                                
                                <div class="flex items-center space-x-2 text-sm text-gray-500">
                                    <span>{{ $article->published_at->format('M d, Y') }}</span>
                                    @if($article->reading_time)
                                    <span>•</span>
                                    <span>{{ $article->reading_time }} min read</span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Title -->
                            <h2 class="text-xl font-bold text-gray-900 group-hover:text-red-600 transition-colors mb-3 line-clamp-2">
                                {{ $article->title }}
                            </h2>
                            
                            <!-- Excerpt -->
                            @if($article->excerpt)
                            <p class="text-gray-600 line-clamp-3 mb-4">
                                {{ $article->excerpt }}
                            </p>
                            @endif
                            
                            <!-- Author & Stats -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <!-- Author -->
                                @if($article->author)
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center overflow-hidden">
                                        @if($article->author->avatar)
                                            <img src="{{ asset('storage/avatars/' . $article->author->avatar) }}" 
                                                 alt="{{ $article->author->name }}" 
                                                 class="w-8 h-8 object-cover">
                                        @else
                                            <span class="text-sm font-medium text-gray-600">
                                                {{ substr($article->author->name, 0, 1) }}
                                            </span>
                                        @endif
                                    </div>
                                    <span class="text-sm font-medium text-gray-700">{{ $article->author->name }}</span>
                                </div>
                                @endif
                                
                                <!-- Stats -->
                                <div class="flex items-center space-x-4 text-sm text-gray-500">
                                    @if($article->views_count)
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <span>{{ number_format($article->views_count) }}</span>
                                    </div>
                                    @endif
                                    
                                    @if($article->comments_count)
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                        </svg>
                                        <span>{{ $article->comments_count }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="flex justify-center">
                {{ $articles->links() }}
            </div>
            
        @elseif($query)
            <!-- No Results Found -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-3">No Results Found</h3>
                    <p class="text-gray-600 mb-6">
                        We couldn't find any articles matching <span class="font-semibold">"{{ $query }}"</span>
                    </p>
                    
                    <!-- Search Suggestions -->
                    <div class="bg-gray-50 rounded-xl p-4 mb-6">
                        <p class="text-sm font-semibold text-gray-700 mb-2">Try:</p>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Using different keywords</li>
                            <li>• Checking your spelling</li>
                            <li>• Using more general terms</li>
                        </ul>
                    </div>
                    
                    <!-- Popular Categories -->
                    @php
                    $popularCategories = App\Models\Category::withCount(['articles' => function($query) {
                        $query->where('status', 'published');
                    }])->having('articles_count', '>', 0)->orderBy('articles_count', 'desc')->take(5)->get();
                    @endphp
                    
                    @if($popularCategories->isNotEmpty())
                    <div>
                        <p class="text-sm font-semibold text-gray-700 mb-3">Browse by category:</p>
                        <div class="flex flex-wrap justify-center gap-2">
                            @foreach($popularCategories as $category)
                            <a href="{{ route('categories.show', $category->slug) }}" 
                               class="px-3 py-1 bg-red-100 text-red-600 text-sm rounded-full hover:bg-red-200 transition-colors">
                                {{ $category->name }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
        @else
            <!-- Search Landing Page -->
            <div class="text-center py-16">
                <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Start Your Search</h3>
                    <p class="text-gray-600 mb-8">Enter keywords to find articles, insights and stories from our collection.</p>
                    
                    <!-- Popular Topics -->
                    @php
                    $popularTags = ['Technology', 'Business', 'Health', 'Travel', 'Food', 'Science', 'Education', 'Lifestyle'];
                    @endphp
                    
                    <div>
                        <h4 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-4">Popular Topics</h4>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            @foreach($popularTags as $tag)
                            <a href="{{ route('search.index', ['q' => $tag]) }}" 
                               class="px-4 py-3 bg-gray-50 text-gray-700 text-sm rounded-xl hover:bg-red-50 hover:text-red-600 transition-colors border border-gray-200 hover:border-red-200">
                                {{ $tag }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
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