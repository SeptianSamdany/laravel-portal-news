@extends('layouts.standard')

@section('title', 'Our Authors')
@section('meta_description', 'Meet our talented writers and discover their latest articles and insights.')

@section('content')
<div class="min-h-screen bg-white">
    <!-- Page Header -->
    <div class="bg-gray-50 border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Our Authors
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Meet the talented writers behind our content. Discover their expertise and explore their latest articles.
                </p>
            </div>
        </div>
    </div>
    
    <!-- Authors Section -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if($authors->isNotEmpty())
        
        <!-- Authors Statistics -->
        <div class="mb-12 text-center">
            <div class="inline-flex items-center space-x-8 text-sm text-gray-500">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span>{{ $authors->total() }} Authors</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>{{ App\Models\Article::where('status', 'published')
                               ->where('published_at', '>=', now()->subMonth())->count() }} Total Articles</span>
                </div>
            </div>
        </div>
        
        <!-- Authors Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($authors as $author)
            @php
            $authorArticles = $author->articles()->where('status', 'published')
                               ->where('published_at', '>=', now()->subMonth())->count();
            $totalViews = $author->articles()->where('status', 'published')
                               ->where('published_at', '>=', now()->subMonth())->sum('views_count');
            $latestArticles = $author->articles()->with(['category'])->where('status', 'published')
                               ->where('published_at', '>=', now()->subMonth())->latest('published_at')->take(3)->get();
            $joinedDate = $author->created_at;
            @endphp
            
            <div class="group">
                <a href="{{ route('authors.show', $author->id) }}" class="block">
                    <!-- Author Card -->
                    <div class="bg-white border border-gray-200 hover:border-gray-300 transition-colors p-6 h-full">
                        <!-- Author Header -->
                        <div class="text-center mb-6">
                            <!-- Avatar -->
                            <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                @if($author->avatar)
                                <img src="{{ asset('storage/avatars/' . $author->avatar) }}" alt="{{ $author->name }}" class="w-20 h-20 rounded-full object-cover">
                                @else
                                <span class="text-2xl font-bold text-gray-600">
                                    {{ substr($author->name, 0, 1) }}
                                </span>
                                @endif
                            </div>
                            
                            <!-- Name & Title -->
                            <h2 class="text-xl font-semibold text-gray-900 group-hover:text-red-600 transition-colors mb-1">
                                {{ $author->name }}
                            </h2>
                            
                            @if($author->title)
                            <p class="text-sm text-gray-500 mb-3">{{ $author->title }}</p>
                            @endif
                            
                            {{-- @if($author->bio)
                            <p class="text-gray-600 text-sm line-clamp-2 leading-relaxed">
                                {{ $author->bio }}
                            </p>
                            @endif --}}
                        </div>
                        
                        <!-- Author Stats -->
                        <div class="grid grid-cols-3 gap-4 mb-6 py-4 border-t border-b border-gray-100 text-center">
                            <div>
                                <div class="text-lg font-semibold text-gray-900">{{ $authorArticles }}</div>
                                <div class="text-xs text-gray-500 uppercase tracking-wide">Articles</div>
                            </div>
                            <div>
                                <div class="text-lg font-semibold text-gray-900">{{ number_format($totalViews) }}</div>
                                <div class="text-xs text-gray-500 uppercase tracking-wide">Views</div>
                            </div>
                            <div>
                                <div class="text-lg font-semibold text-gray-900">{{ $joinedDate->format('Y') }}</div>
                                <div class="text-xs text-gray-500 uppercase tracking-wide">Joined</div>
                            </div>
                        </div>
                        
                        <!-- Latest Articles -->
                        @if($latestArticles->isNotEmpty())
                        <div class="space-y-3">
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">
                                Recent Articles
                            </h3>
                            
                            @foreach($latestArticles as $article)
                            <div class="flex items-start space-x-3 py-2 border-b border-gray-100 last:border-b-0">
                                <div class="w-2 h-2 bg-red-600 rounded-full mt-2 flex-shrink-0"></div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-medium text-gray-900 line-clamp-1 group-hover:text-gray-700">
                                        {{ $article->title }}
                                    </h4>
                                    <div class="flex items-center text-xs text-gray-500 mt-1 space-x-2">
                                        @if($article->category)
                                        <span>{{ $article->category->name }}</span>
                                        <span>•</span>
                                        @endif
                                        <span>{{ $article->published_at->format('M d') }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <!-- Empty State for Author -->
                        <div class="text-center py-6">
                            <svg class="w-8 h-8 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="text-sm text-gray-500">No articles yet</p>
                        </div>
                        @endif
                        
                        <!-- View Profile Link -->
                        <div class="mt-6 pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-red-600 font-medium group-hover:text-red-700">
                                    View profile
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
        
        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $authors->links() }}
        </div>
        
        @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="max-w-md mx-auto">
                <svg class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <h3 class="text-xl font-medium text-gray-900 mb-2">No Authors Available</h3>
                <p class="text-gray-600">Authors will appear here once they are activated and have content.</p>
            </div>
        </div>
        @endif
        
        <!-- Top Authors Section -->
        @if($authors->isNotEmpty())
        @php
        $topAuthors = App\Models\User::where('is_active', true)
                     ->withCount(['articles' => function($query) {
                         $query->where('status', 'published')
                               ->where('published_at', '>=', now()->subMonth());
                     }])
                     ->with(['articles' => function($query) {
                            $query->where('status', 'published')
                            ->where('published_at', '>=', now()->subMonth())
                            ->select('id', 'author_id', 'views_count');
                    }])
                     ->having('articles_count', '>', 0)
                     ->get()
                     ->sortByDesc(function($author) {
                         return $author->articles->sum('views_count');
                     })
                     ->take(3);
        @endphp
        
        @if($topAuthors->isNotEmpty())
        <div class="mt-20 pt-12 border-t border-gray-200">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Top Authors</h2>
                <p class="text-gray-600">Our most popular writers this month</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($topAuthors as $index => $topAuthor)
                <div class="text-center">
                    <a href="{{ route('authors.show', $topAuthor->id) }}" class="block group">
                        <!-- Ranking Badge -->
                        <div class="relative inline-block mb-4">
                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto">
                                @if($topAuthor->avatar)
                                <img src="{{ asset('storage/avatars/' . $topAuthor->avatar) }}" alt="{{ $topAuthor->name }}" class="w-20 h-20 rounded-full object-cover">
                                @else
                                <span class="text-xl font-bold text-gray-600">
                                    {{ substr($topAuthor->name, 0, 1) }}
                                </span>
                                @endif
                            </div>
                            
                            <!-- Ranking Number -->
                            <div class="absolute -top-1 -right-1 w-6 h-6 bg-red-600 text-white text-xs font-bold rounded-full flex items-center justify-center">
                                {{ $index + 1 }}
                            </div>
                        </div>
                        
                        <h3 class="font-semibold text-gray-900 group-hover:text-red-600 transition-colors mb-1">
                            {{ $topAuthor->name }}
                        </h3>
                        
                        <div class="text-sm text-gray-500 space-x-3">
                            <span>{{ $topAuthor->articles_count }} articles</span>
                            <span>•</span>
                            <span>{{ number_format($topAuthor->articles->sum('views_count')) }} views</span>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        @endif
        
        <!-- Call to Action -->
        <div class="mt-20 text-center">
            <div class="bg-gray-50 py-12 px-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">
                    Want to become an author?
                </h2>
                <p class="text-gray-600 mb-6 max-w-md mx-auto">
                    Join our community of writers and share your expertise with our audience.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('authors.apply') }}"
                    class="px-6 py-3 bg-red-600 text-white font-medium hover:bg-red-700 transition-colors rounded">
                        Apply as Author
                    </a>
                    <a href="{{ route('articles.index') }}" 
                    class="px-6 py-3 border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition-colors rounded">
                        Browse Articles
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