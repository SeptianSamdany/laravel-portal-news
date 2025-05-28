@extends('layouts.standard')

@section('title', $query ? 'Search Results for "' . $query . '"' : 'Search Articles')
@section('meta_description', $query ? 'Search results for "' . $query . '" - Find articles, insights and stories from our collection.' : 'Search through our collection of articles and find the content you\'re looking for.')

@section('content')
<div class="min-h-screen bg-white">
    <!-- Page Header -->
    <div class="bg-gray-50 border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                @if($query)
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Search Results
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-6">
                    Found {{ $articles->total() }} {{ Str::plural('result', $articles->total()) }} for 
                    <span class="font-semibold text-gray-900">"{{ $query }}"</span>
                </p>
                @else
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Search Articles
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-6">
                    Find articles, insights and stories from our collection
                </p>
                @endif
                
                <!-- Search Form -->
                <div class="max-w-xl mx-auto">
                    <form action="{{ route('search.index') }}" method="GET" class="relative">
                        <input type="text" 
                               name="q" 
                               value="{{ $query }}" 
                               placeholder="Search articles..." 
                               class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none">
                        <button type="submit" 
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 p-2 text-gray-400 hover:text-red-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Search Results -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if($articles->isNotEmpty() && $query)
        
        <!-- Results Statistics -->
        <div class="mb-12 text-center">
            <div class="inline-flex items-center space-x-8 text-sm text-gray-500">
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
                    <span>{{ $articles->currentPage() }} of {{ $articles->lastPage() }} {{ Str::plural('page', $articles->lastPage()) }}</span>
                </div>
            </div>
        </div>
        
        <!-- Articles Grid -->
        <div class="space-y-8">
            @foreach($articles as $article)
            <div class="group">
                <a href="{{ route('articles.show', $article->slug) }}" class="block">
                    <!-- Article Card -->
                    <div class="bg-white border border-gray-200 hover:border-gray-300 hover:shadow-sm transition-all p-6 md:p-8">
                        <div class="flex flex-col lg:flex-row lg:space-x-8">
                            <!-- Article Image -->
                            @if($article->featured_image)
                            <div class="lg:w-1/3 mb-6 lg:mb-0">
                                <div class="aspect-video bg-gray-200 rounded-lg overflow-hidden">
                                    <img src="{{ asset('storage/articles/' . $article->featured_image) }}" 
                                         alt="{{ $article->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                            </div>
                            @endif
                            
                            <!-- Article Content -->
                            <div class="flex-1">
                                <!-- Article Meta -->
                                <div class="flex items-center space-x-4 text-sm text-gray-500 mb-4">
                                    @if($article->category)
                                    <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-xs font-medium uppercase tracking-wide">
                                        {{ $article->category->name }}
                                    </span>
                                    @endif
                                    
                                    <div class="flex items-center space-x-4">
                                        @if($article->author)
                                        <div class="flex items-center space-x-2">
                                            <div class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center">
                                                @if($article->author->avatar)
                                                <img src="{{ asset('storage/avatars/' . $article->author->avatar) }}" 
                                                     alt="{{ $article->author->name }}" 
                                                     class="w-6 h-6 rounded-full object-cover">
                                                @else
                                                <span class="text-xs font-medium text-gray-600">
                                                    {{ substr($article->author->name, 0, 1) }}
                                                </span>
                                                @endif
                                            </div>
                                            <span>{{ $article->author->name }}</span>
                                        </div>
                                        @endif
                                        
                                        <span>•</span>
                                        <span>{{ $article->published_at->format('M d, Y') }}</span>
                                        
                                        @if($article->reading_time)
                                        <span>•</span>
                                        <span>{{ $article->reading_time }} min read</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Article Title -->
                                <h2 class="text-xl md:text-2xl font-bold text-gray-900 group-hover:text-red-600 transition-colors mb-3 line-clamp-2">
                                    {{ $article->title }}
                                </h2>
                                
                                <!-- Article Excerpt -->
                                @if($article->excerpt)
                                <p class="text-gray-600 text-base leading-relaxed line-clamp-3 mb-4">
                                    {{ $article->excerpt }}
                                </p>
                                @endif
                                
                                <!-- Article Stats -->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-6 text-sm text-gray-500">
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
                                    
                                    <!-- Read More Link -->
                                    <div class="flex items-center text-sm">
                                        <span class="text-red-600 font-medium group-hover:text-red-700">
                                            Read more
                                        </span>
                                        <svg class="w-4 h-4 text-red-600 group-hover:text-red-700 group-hover:translate-x-1 transition-all ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $articles->links() }}
        </div>
        
        @elseif($query)
        <!-- No Results Found -->
        <div class="text-center py-16">
            <div class="max-w-md mx-auto">
                <svg class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <h3 class="text-xl font-medium text-gray-900 mb-2">No Results Found</h3>
                <p class="text-gray-600 mb-6">We couldn't find any articles matching <span class="font-semibold">"{{ $query }}"</span></p>
                
                <!-- Search Suggestions -->
                <div class="space-y-2 text-sm text-gray-500">
                    <p>Try:</p>
                    <ul class="space-y-1">
                        <li>• Using different keywords</li>
                        <li>• Checking your spelling</li>
                        <li>• Using more general terms</li>
                        <li>• Searching for related topics</li>
                    </ul>
                </div>
                
                <!-- Popular Categories -->
                @php
                $popularCategories = App\Models\Category::withCount(['articles' => function($query) {
                    $query->where('status', 'published');
                }])->having('articles_count', '>', 0)->orderBy('articles_count', 'desc')->take(5)->get();
                @endphp
                
                @if($popularCategories->isNotEmpty())
                <div class="mt-8">
                    <p class="text-sm text-gray-500 mb-4">Or browse by category:</p>
                    <div class="flex flex-wrap justify-center gap-2">
                        @foreach($popularCategories as $category)
                        <a href="{{ route('categories.show', $category->slug) }}" 
                           class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full hover:bg-red-100 hover:text-red-600 transition-colors">
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
            <div class="max-w-md mx-auto">
                <svg class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <h3 class="text-xl font-medium text-gray-900 mb-2">Start Your Search</h3>
                <p class="text-gray-600 mb-8">Enter keywords to find articles, insights and stories from our collection.</p>
            </div>
            
            <!-- Popular Searches -->
            @php
            $popularTags = ['Technology', 'Business', 'Health', 'Travel', 'Food', 'Science', 'Education', 'Lifestyle'];
            @endphp
            
            <div class="max-w-2xl mx-auto">
                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-4">Popular Topics</h4>
                <div class="flex flex-wrap justify-center gap-2">
                    @foreach($popularTags as $tag)
                    <a href="{{ route('search.index', ['q' => $tag]) }}" 
                       class="px-4 py-2 bg-gray-100 text-gray-700 text-sm rounded-full hover:bg-red-100 hover:text-red-600 transition-colors">
                        {{ $tag }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        
        <!-- Search Tips -->
        @if($query && $articles->isNotEmpty())
        <div class="mt-20 pt-12 border-t border-gray-200">
            <div class="bg-gray-50 py-8 px-6 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 text-center">Search Tips</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-sm text-gray-600">
                    <div class="text-center">
                        <svg class="w-8 h-8 text-red-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="font-medium mb-1">Use specific keywords</p>
                        <p>Be specific to get more relevant results</p>
                    </div>
                    <div class="text-center">
                        <svg class="w-8 h-8 text-red-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <p class="font-medium mb-1">Browse categories</p>
                        <p>Explore articles by topic or category</p>
                    </div>
                    <div class="text-center">
                        <svg class="w-8 h-8 text-red-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <p class="font-medium mb-1">Follow authors</p>
                        <p>Find articles from your favorite writers</p>
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