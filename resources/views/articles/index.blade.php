@extends('layouts.standard')

@section('title', 'Articles - Your Blog')
@section('meta_description', 'Browse our latest articles and blog posts')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <!-- Page Header -->
        <div class="mb-10 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Blog Articles</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Discover our latest thoughts, ideas, and insights on various topics</p>
        </div>
        
        <!-- Featured Article (if available) -->
        @if(isset($featuredArticle))
        <div class="mb-12">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-100">
                <div class="md:flex">
                    <div class="md:w-1/2">
                        @if($featuredArticle->featured_image)
                            <img src="{{ $featuredArticle->featured_image }}" alt="{{ $featuredArticle->title }}" class="w-full h-64 md:h-full object-cover">
                        @else
                            <div class="w-full h-64 md:h-full bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-400">No Image</span>
                            </div>
                        @endif
                    </div>
                    <div class="md:w-1/2 p-6 md:p-8">
                        <div class="mb-4">
                            <span class="bg-indigo-100 text-indigo-600 text-xs font-medium px-2.5 py-0.5 rounded">Featured</span>
                            <a href="{{ route('categories.show', $featuredArticle->category->slug) }}" class="ml-2 text-gray-500 hover:text-indigo-600 text-sm">{{ $featuredArticle->category->name }}</a>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 hover:text-indigo-600 transition">
                            <a href="{{ route('articles.show', $featuredArticle->slug) }}">{{ $featuredArticle->title }}</a>
                        </h2>
                        <p class="text-gray-600 mb-6">{{ $featuredArticle->excerpt }}</p>
                        <div class="flex items-center mb-4">
                            @if($featuredArticle->author->avatar)
                                <img src="{{ $featuredArticle->author->avatar }}" alt="{{ $featuredArticle->author->name }}" class="w-10 h-10 rounded-full mr-3">
                            @else
                                <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center mr-3">
                                    {{ substr($featuredArticle->author->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <p class="font-medium text-gray-800">{{ $featuredArticle->author->name }}</p>
                                <p class="text-sm text-gray-500">{{ $featuredArticle->published_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <a href="{{ route('articles.show', $featuredArticle->slug) }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                            Read Article
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <!-- Filter Options -->
        <div class="mb-8">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-gray-700 font-medium">Filter by:</span>
                    <div class="relative">
                        <select id="category-filter" class="bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-lg focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}" {{ request('category') === $category->slug ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    @if(count($tags) > 0)
                    <div class="relative">
                        <select id="tag-filter" class="bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-lg focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All Tags</option>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->slug }}" {{ request('tag') === $tag->slug ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                </div>
                
                <div class="relative">
                    <select id="sort-filter" class="bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-lg focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="newest" {{ request('sort') === 'newest' || !request('sort') ? 'selected' : '' }}>Newest First</option>
                        <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                        <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>Most Popular</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @forelse($articles as $article)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-shadow duration-300">
                    @if($article->featured_image)
                        <a href="{{ route('articles.show', $article->slug) }}">
                            <img src="{{ $article->featured_image }}" alt="{{ $article->title }}" class="w-full h-56 object-cover">
                        </a>
                    @else
                        <div class="w-full h-56 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">No Image</span>
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <div class="flex items-center mb-2">
                            <a href="{{ route('categories.show', $article->category->slug) }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-800">
                                {{ $article->category->name }}
                            </a>
                            <span class="mx-2 text-gray-300">•</span>
                            <span class="text-xs text-gray-500">{{ $article->published_at->format('M d, Y') }}</span>
                        </div>
                        
                        <h3 class="text-xl font-semibold text-gray-800 mb-3 hover:text-indigo-600 line-clamp-2">
                            <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                        </h3>
                        
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $article->excerpt }}</p>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                @if($article->author->avatar)
                                    <img src="{{ $article->author->avatar }}" alt="{{ $article->author->name }}" class="w-8 h-8 rounded-full mr-2">
                                @else
                                    <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 text-sm flex items-center justify-center mr-2">
                                        {{ substr($article->author->name, 0, 1) }}
                                    </div>
                                @endif
                                <span class="text-sm text-gray-700">{{ $article->author->name }}</span>
                            </div>
                            
                            <div class="flex items-center text-gray-500 text-sm">
                                <span class="flex items-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    {{ $article->views_count }}
                                </span>
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                    {{ $article->comments->count() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    <h3 class="text-xl font-medium text-gray-700 mb-2">No Articles Found</h3>
                    <p class="text-gray-500">There are no articles matching your current filters.</p>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $articles->appends(request()->query())->links() }}
        </div>
        
        <!-- Newsletter Subscription -->
        <div class="bg-indigo-50 rounded-lg p-8 mt-12">
            <div class="max-w-2xl mx-auto text-center">
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Subscribe to our newsletter</h3>
                <p class="text-gray-600 mb-6">Get the latest articles and resources straight to your inbox</p>
                
                {{-- <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col sm:flex-row gap-3 max-w-lg mx-auto">
                    @csrf
                    <input type="email" name="email" placeholder="Enter your email address" class="flex-1 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300">
                        Subscribe
                    </button>
                </form> --}}
                
                <p class="text-xs text-gray-500 mt-4">By subscribing, you agree to our Privacy Policy and consent to receive updates from our company.</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle filter changes
        const categoryFilter = document.getElementById('category-filter');
        const tagFilter = document.getElementById('tag-filter');
        const sortFilter = document.getElementById('sort-filter');
        
        function applyFilters() {
            let url = new URL(window.location);
            
            // Set category filter
            if (categoryFilter.value) {
                url.searchParams.set('category', categoryFilter.value);
            } else {
                url.searchParams.delete('category');
            }
            
            // Set tag filter if it exists
            if (tagFilter) {
                if (tagFilter.value) {
                    url.searchParams.set('tag', tagFilter.value);
                } else {
                    url.searchParams.delete('tag');
                }
            }
            
            // Set sort filter
            if (sortFilter.value) {
                url.searchParams.set('sort', sortFilter.value);
            } else {
                url.searchParams.delete('sort');
            }
            
            window.location.href = url.toString();
        }
        
        // Add event listeners
        if (categoryFilter) categoryFilter.addEventListener('change', applyFilters);
        if (tagFilter) tagFilter.addEventListener('change', applyFilters);
        if (sortFilter) sortFilter.addEventListener('change', applyFilters);
    });
</script>
@endpush
@endsection