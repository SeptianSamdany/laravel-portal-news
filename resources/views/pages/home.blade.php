@extends('layouts.standard')

@section('title', 'Home - Your Blog Name')

@section('content')
<div class="hero-section">
    <div class="container mx-auto px-4 py-16 md:py-24">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Welcome to Your Blog</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Discover insightful articles on various topics written by our expert authors.</p>
            <div class="mt-8">
                <a href="{{ route('articles.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-lg transition duration-300">Explore Articles</a>
            </div>
        </div>
    </div>
</div>

<!-- Featured Articles Section -->
<section class="bg-gray-50 py-12 md:py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-8 text-center">Featured Articles</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($featuredArticles as $article)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden transition-transform duration-300 hover:shadow-md hover:-translate-y-1">
                    @if($article->featured_image)
                        <img src="{{ $article->featured_image }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">No Image</span>
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <span class="text-xs text-indigo-600 font-medium uppercase tracking-wider">{{ $article->category->name }}</span>
                        <h3 class="text-xl font-semibold mt-2 mb-3 text-gray-800 hover:text-indigo-600">
                            <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                        </h3>
                        <p class="text-gray-600 text-sm mb-4">{{ $article->excerpt }}</p>
                        
                        <div class="flex items-center justify-between mt-4">
                            <div class="flex items-center">
                                @if($article->author->avatar)
                                    <img src="{{ $article->author->avatar }}" alt="{{ $article->author->name }}" class="w-8 h-8 rounded-full mr-2">
                                @else
                                    <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center mr-2">
                                        {{ substr($article->author->name, 0, 1) }}
                                    </div>
                                @endif
                                <span class="text-sm text-gray-600">{{ $article->author->name }}</span>
                            </div>
                            <span class="text-xs text-gray-500">{{ $article->published_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500">No featured articles available.</p>
                </div>
            @endforelse
        </div>
        
        <div class="text-center mt-10">
            <a href="{{ route('articles.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium inline-flex items-center">
                View all articles
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-12 md:py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-8 text-center">Popular Categories</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($categories as $category)
                <a href="{{ route('categories.show', $category->slug) }}" class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 text-center hover:shadow-md transition-shadow duration-300">
                    <h3 class="text-lg font-medium text-gray-800">{{ $category->name }}</h3>
                    <p class="text-sm text-gray-500 mt-1">{{ $category->articles_count }} Articles</p>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Latest Articles Section -->
<section class="bg-gray-50 py-12 md:py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-8 text-center">Latest Articles</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($latestArticles as $article)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden flex flex-col md:flex-row">
                    @if($article->featured_image)
                        <div class="md:w-1/3">
                            <img src="{{ $article->featured_image }}" alt="{{ $article->title }}" class="w-full h-48 md:h-full object-cover">
                        </div>
                    @else
                        <div class="md:w-1/3 bg-gray-200 flex items-center justify-center h-48 md:h-auto">
                            <span class="text-gray-400">No Image</span>
                        </div>
                    @endif
                    
                    <div class="p-6 md:w-2/3">
                        <span class="text-xs text-indigo-600 font-medium uppercase tracking-wider">{{ $article->category->name }}</span>
                        <h3 class="text-xl font-semibold mt-2 mb-3 text-gray-800 hover:text-indigo-600">
                            <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                        </h3>
                        <p class="text-gray-600 text-sm mb-4">{{ $article->excerpt }}</p>
                        
                        <div class="flex items-center justify-between mt-4">
                            <div class="flex items-center">
                                @if($article->author->avatar)
                                    <img src="{{ $article->author->avatar }}" alt="{{ $article->author->name }}" class="w-8 h-8 rounded-full mr-2">
                                @else
                                    <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center mr-2">
                                        {{ substr($article->author->name, 0, 1) }}
                                    </div>
                                @endif
                                <span class="text-sm text-gray-600">{{ $article->author->name }}</span>
                            </div>
                            <span class="text-xs text-gray-500">{{ $article->published_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="text-center mt-10">
            <a href="{{ route('articles.index') }}" class="bg-white border border-indigo-600 text-indigo-600 hover:bg-indigo-50 font-medium py-2 px-6 rounded-lg transition duration-300">View More Articles</a>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-12 md:py-16 bg-indigo-700 text-white">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="text-2xl md:text-3xl font-semibold mb-4">Stay Updated</h2>
            <p class="text-indigo-100 mb-8">Subscribe to our newsletter to receive the latest articles and updates.</p>
            
            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col md:flex-row gap-2">
                @csrf
                <input type="email" name="email" placeholder="Your email address" required class="flex-grow px-4 py-2 rounded-lg focus:outline-none text-gray-800">
                <button type="submit" class="bg-white text-indigo-700 font-medium py-2 px-6 rounded-lg hover:bg-indigo-50 transition duration-300">Subscribe</button>
            </form>
        </div>
    </div>
</section>
@endsection