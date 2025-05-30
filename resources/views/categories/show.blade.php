@extends('layouts.standard')

@section('title', $category->name . ' Articles')
@section('meta_description', $category->description ?? 'Browse all articles in the ' . $category->name . ' category.')

@section('content')
<div class="min-h-screen bg-white">
    <!-- Category Header -->
    <div class="bg-gray-50 border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <!-- Breadcrumb -->
            <nav class="mb-6 bg-white py-2 px-4 rounded-md shadow-sm" aria-label="Breadcrumb">
                <ol class="flex items-center text-sm font-medium text-gray-700 space-x-2">
                    <!-- Home -->
                    <li>
                        <a href="{{ route('home') }}" class="text-black hover:text-red-600 transition-colors">Home</a>
                    </li>

                    <!-- Arrow -->
                    <li>
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </li>

                    <!-- Categories -->
                    <li>
                        <a href="{{ route('categories.index') }}" class="text-black hover:text-red-600 transition-colors">Categories</a>
                    </li>

                    <!-- Arrow -->
                    <li>
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </li>

                    <!-- Current Category -->
                    <li class="text-red-700 truncate">
                        {{ $category->name }}
                    </li>
                </ol>
            </nav>

           <!-- Category Info -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between bg-white p-6 rounded-lg shadow-sm mb-6">
                <!-- Title & Description -->
                <div class="mb-4 md:mb-0">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-black mb-2 inline-block border-l-4 border-red-600 pl-4">
                        {{ $category->name }}
                    </h1>
                    @if($category->description)
                        <p class="text-base text-gray-600 leading-relaxed max-w-2xl mt-2">
                            {{ $category->description }}
                        </p>
                    @endif
                </div>

                <!-- Metadata -->
                <div class="flex items-center space-x-6 text-sm text-gray-600">
                    <!-- Articles Count -->
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span class="text-black font-medium">{{ $articles->total() }} Articles</span>
                    </div>

                    <!-- Total Views -->
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <span class="text-black font-medium">{{ number_format($articles->sum('views_count')) }} Total Views</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Articles Section -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if($articles->isNotEmpty())
        
        <!-- Sorting & Filter Options -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 pb-4 border-b border-gray-200">
            <div class="mb-4 md:mb-0">
                <h2 class="text-xl font-semibold text-gray-900 border-l-4 border-red-600 pl-4">All Articles</h2>
            </div>
            
            <div class="flex items-center space-x-4">
                <!-- Sort Dropdown -->
                <div class="relative">
                    <select onchange="sortArticles(this.value)" 
                            class="appearance-none bg-white border border-gray-300 px-4 py-2 pr-8 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                        <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Title A-Z</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Featured Article (First Article) -->
        @if($articles->count() > 0)
        @php $featuredArticle = $articles->first(); @endphp
        <div class="mb-12 pb-8 border-b border-gray-200">
            <article class="group">
                <a href="{{ route('articles.show', $featuredArticle->slug) }}" class="block">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                        <!-- Image -->
                        <div class="relative overflow-hidden">
                            <img src="{{ Storage::url($featuredArticle->thumbnail) }}" alt="{{ $featuredArticle->title }}" 
                                 class="w-full h-[300px] lg:h-[350px] object-cover group-hover:scale-105 transition-transform duration-700">
                            <div class="absolute inset-0 bg-black/10 group-hover:bg-black/20 transition-colors"></div>
                        </div>
                        
                        <!-- Content -->
                        <div>
                            <div class="mb-3">
                                <span class="text-red-600 text-sm font-medium uppercase tracking-wide">
                                    Featured Article
                                </span>
                            </div>
                            
                            <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4 leading-tight group-hover:text-gray-700 transition-colors">
                                {{ $featuredArticle->title }}
                            </h2>
                            
                            <p class="text-gray-600 text-lg mb-6 leading-relaxed line-clamp-3">
                                {{ $featuredArticle->excerpt }}
                            </p>
                            
                            <div class="flex items-center text-gray-500 text-sm space-x-4">
                                <span class="font-medium">{{ $featuredArticle->author->name }}</span>
                                <span>•</span>
                                <span>{{ $featuredArticle->published_at->format('M d, Y') }}</span>
                                <span>•</span>
                                <span>{{ number_format($featuredArticle->views_count) }} views</span>
                            </div>
                        </div>
                    </div>
                </a>
            </article>
        </div>
        @endif
        
        <!-- Articles List -->
        <div class="space-y-8">
            @foreach($articles->skip(1) as $article)
            <article class="group">
                <a href="{{ route('articles.show', $article->slug) }}" class="block">
                    <div class="flex gap-6 py-6 border-b border-gray-100 hover:bg-gray-50/50 transition-colors">
                        <!-- Image -->
                        <div class="w-32 h-24 md:w-40 md:h-28 flex-shrink-0 overflow-hidden">
                            <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        
                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg md:text-xl font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-gray-700 transition-colors leading-tight">
                                {{ $article->title }}
                            </h3>
                            
                            <p class="text-gray-600 text-sm md:text-base mb-4 line-clamp-2 leading-relaxed">
                                {{ $article->excerpt }}
                            </p>
                            
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between text-xs md:text-sm text-gray-500">
                                <div class="flex items-center space-x-3 mb-2 md:mb-0">
                                    <span class="font-medium">{{ $article->author->name }}</span>
                                    <span>{{ $article->published_at->format('M d, Y') }}</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span>{{ number_format($article->views_count) }} views</span>
                                    <span>{{ ceil(str_word_count(strip_tags($article->content)) / 200) }} min read</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </article>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $articles->appends(request()->query())->links() }}
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
                <p class="text-gray-600 mb-6">There are no published articles in this category yet.</p>
                <a href="{{ route('categories.index') }}" 
                   class="inline-block px-6 py-3 bg-red-600 text-white font-medium hover:bg-red-700 transition-colors">
                    Browse Other Categories
                </a>
            </div>
        </div>
        @endif
    </div>

    @include('components.advertisement')
    
    <!-- Related Categories -->
    @php
    $relatedCategories = App\Models\Category::where('id', '!=', $category->id)
                        ->where('is_active', true)
                        ->withCount(['articles' => function($query) {
                            $query->where('status', 'published');
                        }])
                        ->having('articles_count', '>', 0)
                        ->orderBy('articles_count', 'desc')
                        ->take(4)
                        ->get();
    @endphp
    
    @if($relatedCategories->isNotEmpty())
    <div class="bg-gray-50 py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Explore Other Categories</h2>
                <p class="text-gray-600">Discover more content that might interest you</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedCategories as $relatedCategory)
                <div class="bg-white border border-gray-200 hover:border-gray-300 transition-colors p-6">
                    <a href="{{ route('categories.show', $relatedCategory->slug) }}" class="block group">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="font-semibold text-gray-900 group-hover:text-red-600 transition-colors">
                                {{ $relatedCategory->name }}
                            </h3>
                            <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                                {{ $relatedCategory->articles_count }}
                            </span>
                        </div>
                        
                        @if($relatedCategory->description)
                        <p class="text-sm text-gray-600 line-clamp-2 mb-3">
                            {{ $relatedCategory->description }}
                        </p>
                        @endif
                        
                        <div class="flex items-center text-sm text-red-600 group-hover:text-red-700">
                            <span class="font-medium">Explore</span>
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>

<!-- CSS for line clamping -->
<style>
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

<!-- JavaScript for sorting -->
<script>
function sortArticles(sortBy) {
    const url = new URL(window.location);
    url.searchParams.set('sort', sortBy);
    url.searchParams.delete('page'); // Reset pagination when sorting
    window.location.href = url.toString();
}
</script>
@endsection