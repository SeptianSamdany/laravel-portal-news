{{-- filepath: c:\Laravel\laravel-portal-news\resources\views\articles\trending.blade.php --}}
@extends('layouts.standard')

@section('title', 'Trending Articles - ' . config('app.name'))
@section('meta_description', 'Discover the most popular and trending articles that everyone is reading right now.')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Hero Section with Top Trending Article -->
    @if($trendingArticles->count() > 0)
        @php
            $topTrending = $trendingArticles->first();
        @endphp
        
        <div class="mb-12">
            <div class="relative rounded-xl overflow-hidden shadow-2xl">
                <div class="relative h-[400px] md:h-[500px] lg:h-[550px] overflow-hidden">
                    <img src="{{ Storage::url($topTrending->thumbnail) }}" 
                        alt="{{ $topTrending->title }}" 
                        class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700">
                    
                    <!-- Enhanced gradient overlay to match featured carousel -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
                    
                    <!-- Trending Badge - positioned like featured carousel -->
                    <div class="absolute top-6 left-6 z-10">
                        <div class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-bold uppercase tracking-wider rounded-full hover:bg-red-700 transition-all duration-200 hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                            <span>Trending</span>
                        </div>
                    </div>
                    
                    <div class="absolute bottom-0 left-0 right-0 p-6 md:p-10 lg:p-12">
                        <div class="max-w-3xl">
                            <!-- Category Badge - matching featured carousel style -->
                            @if($topTrending->category)
                                <div class="mb-4">
                                    <a href="{{ route('articles.index', ['category' => $topTrending->category->slug]) }}" 
                                    class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-bold uppercase tracking-wider rounded-full hover:bg-red-700 transition-all duration-200 hover:scale-105">
                                        <span>{{ $topTrending->category->name }}</span>
                                    </a>    
                                </div>
                            @endif
                            
                            <!-- Title - matching featured carousel style -->
                            <h1 class="text-2xl md:text-3xl lg:text-4xl text-white font-bold mb-3 lg:mb-4 
                                    leading-tight tracking-tight drop-shadow-lg border-l-8 border-red-600 pl-6">
                                {{ Str::limit($topTrending->title, 60) }}
                            </h1>
                            
                            <!-- Excerpt - matching featured carousel style -->
                            <div class="mb-6">
                                <p class="text-gray-100 text-sm md:text-base max-w-2xl 
                                        leading-relaxed font-light line-clamp-2">
                                    {{ Str::limit($topTrending->excerpt, 120) }}
                                </p>
                            </div>
                            
                            <!-- Meta Info - matching featured carousel style with backdrop blur -->
                            <div class="flex flex-wrap items-center gap-4 mb-6 text-xs text-gray-300">
                                <div class="flex items-center bg-black/30 rounded-full px-3 py-1 backdrop-blur-sm">
                                    <svg class="h-3 w-3 mr-2 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-white font-medium">{{ $topTrending->author->name }}</span>
                                </div>
                                
                                <div class="flex items-center bg-black/30 rounded-full px-3 py-1 backdrop-blur-sm">
                                    <svg class="h-3 w-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ $topTrending->published_at->format('j M') }}</span>
                                </div>
                                
                                <div class="flex items-center bg-black/30 rounded-full px-3 py-1 backdrop-blur-sm">
                                    <svg class="h-3 w-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <span>{{ number_format($topTrending->views_count) }}</span>
                                </div>
                                
                                @if($topTrending->comments)
                                <div class="flex items-center bg-black/30 rounded-full px-3 py-1 backdrop-blur-sm">
                                    <svg class="h-3 w-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                    <span>{{ $topTrending->comments->count() }}</span>
                                </div>
                                @endif
                            </div>
                            
                            <!-- CTA Button - matching featured carousel style -->
                            <div>
                                <a href="{{ route('articles.show', $topTrending->slug) }}" 
                                class="inline-flex items-center bg-gradient-to-r from-red-600 to-red-700 text-white font-bold text-sm px-6 py-3 rounded-full hover:from-red-700 hover:to-red-800 transition-all duration-300 group transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    <span>Baca Sekarang</span>
                                    <svg class="ml-2 h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container mx-auto px-4">
        <!-- Main Content Wrapper -->
        <div class="flex flex-col gap-12">
            <!-- Trending Articles Section -->
            <div class="w-full">
                <div class="flex flex-wrap items-center justify-between mb-8 pb-3 border-b border-gray-200">
                    <h2 class="text-2xl text-gray-900 font-bold border-l-8 border-red-600 pl-6 flex items-center">
                        Trending Articles
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </h2>
                    <div class="flex items-center space-x-2 text-sm">
                        <span class="text-gray-500">Sorted by popularity</span>
                    </div>
                </div>
                
                @if($trendingArticles->count() > 1)
                @php
                    $remainingTrending = $trendingArticles->skip(1);
                    $topThree = $remainingTrending->take(2);
                    $otherTrending = $remainingTrending->skip(2);
                @endphp
                
                <!-- Top 3 Trending (excluding the hero article) -->
                @if($topThree->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                    @foreach($topThree as $index => $article)
                    <article class="group relative">
                       <!-- Ranking Badge -->
                        <div class="absolute top-4 left-4 z-10">
                            <div class="flex items-center justify-center w-8 h-8 bg-red-600 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                        </div>
                        
                        <a href="{{ route('articles.show', $article->slug) }}" class="block">
                            <div class="relative mb-4">
                                <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}" 
                                    class="w-full h-[250px] object-cover rounded-lg">
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/30 transition-colors rounded-lg"></div>
                            </div>
                            
                            <!-- Category -->
                            @if($article->category)
                            <div class="mb-2">
                                <span class="text-red-600 text-sm font-medium uppercase tracking-wide">
                                    {{ $article->category->name }}
                                </span>
                            </div>
                            @endif
                            
                            <!-- Title -->
                            <h3 class="text-xl font-bold text-gray-900 mb-3 leading-tight group-hover:text-gray-700 transition-colors line-clamp-2">
                                {{ $article->title }}
                            </h3>
                            
                            <!-- Excerpt -->
                            <p class="text-gray-600 text-base mb-4 line-clamp-2 leading-relaxed">
                                {{ $article->excerpt }}
                            </p>
                            
                            <!-- Meta -->
                            <div class="flex items-center justify-between text-gray-500 text-sm">
                                <div class="flex items-center space-x-3">
                                    <span class="font-medium">{{ $article->author->name }}</span>
                                    <span>•</span>
                                    <span>{{ $article->published_at->format('M d, Y') }}</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        {{ number_format($article->views_count) }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </article>
                    @endforeach
                </div>
                @endif
                
                <!-- Other Trending Articles -->
                @if($otherTrending->count() > 0)
                <div class="border-t border-gray-200 pt-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">
                        More Trending Stories
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach($otherTrending as $index => $article)
                        <article class="group border-b border-gray-100 pb-6 last:border-b-0">
                            <a href="{{ route('articles.show', $article->slug) }}" class="block">
                                <div class="flex items-start space-x-4">
                                    <!-- Ranking Number -->
                                    <div class="flex-shrink-0 flex items-center justify-center w-8 h-8 bg-gray-100 text-gray-600 rounded-full font-bold text-sm mt-1">
                                        {{ $index + 4 }}
                                    </div>
                                    
                                    <div class="flex-1">
                                        <!-- Thumbnail -->
                                        <div class="w-full h-32 mb-3">
                                            <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}" 
                                                class="w-full h-full object-cover rounded-lg">
                                        </div>
                                        
                                        <!-- Category -->
                                        @if($article->category)
                                        <span class="text-xs text-red-600 font-medium uppercase tracking-wide">
                                            {{ $article->category->name }}
                                        </span>
                                        @endif
                                        
                                        <!-- Title -->
                                        <h4 class="text-base font-bold text-gray-900 mt-1 mb-2 line-clamp-2 group-hover:text-gray-700 transition-colors leading-tight">
                                            {{ $article->title }}
                                        </h4>
                                        
                                        <!-- Meta -->
                                        <div class="flex items-center justify-between text-xs text-gray-500">
                                            <span class="font-medium">{{ $article->author->name }}</span>
                                            <div class="flex items-center space-x-2">
                                                <span>{{ $article->published_at->format('M d') }}</span>
                                                <span class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    {{ number_format($article->views_count) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </article>
                        @endforeach
                    </div>
                </div>
                @endif
                
                @else
                <!-- Empty State -->
                <div class="py-16 text-center">
                    <div class="max-w-md mx-auto">
                        <svg class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        <h3 class="text-xl font-medium text-gray-900 mb-2">No Trending Articles</h3>
                        <p class="text-gray-600">Check back later to see what's trending.</p>
                    </div>
                </div>
                @endif
                
                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    {{ $trendingArticles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection