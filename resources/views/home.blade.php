@extends('layouts.standard')

@section('title', 'Beranda - ' . config('app.name'))

@push('styles')
<style>
    .slide-up {
        animation: slideUp 0.8s ease-out;
    }
    
    .fade-in {
        animation: fadeIn 1s ease-out;
    }
    
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
</style>
@endpush

@section('content')
<div class="min-h-screen">
    <!-- Hero Section -->
    <section class="bg-white py-16 md:py-24 border-b border-gray-100">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <!-- Brand Logo -->
            <div class="slide-up mb-8">
                <h1 class="text-5xl md:text-6xl font-bold mb-4">
                    <span class="text-black">News</span><span class="text-red-500">Hub</span>
                </h1>
                
                <!-- Clean Divider -->
                <div class="w-16 h-0.5 bg-red-500 mx-auto mb-6"></div>
                
                <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Portal berita terpercaya dengan informasi 
                    <span class="text-red-500 font-medium">akurat</span> dan 
                    <span class="text-black font-medium">terkini</span>
                </p>
            </div>
            
            <!-- Key Features -->
            <div class="fade-in grid md:grid-cols-3 gap-6 mb-12 max-w-3xl mx-auto">
                <div class="flex flex-col items-center p-4">
                    <div class="w-10 h-10 bg-red-500 rounded-lg flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-black text-sm mb-1">Terverifikasi</h3>
                    <p class="text-xs text-gray-500 text-center">Berita telah diverifikasi</p>
                </div>
                
                <div class="flex flex-col items-center p-4">
                    <div class="w-10 h-10 bg-red-500 rounded-lg flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-black text-sm mb-1">Real-Time</h3>
                    <p class="text-xs text-gray-500 text-center">Update setiap saat</p>
                </div>
                
                <div class="flex flex-col items-center p-4">
                    <div class="w-10 h-10 bg-red-500 rounded-lg flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-black text-sm mb-1">Lengkap</h3>
                    <p class="text-xs text-gray-500 text-center">Multi kategori berita</p>
                </div>
            </div>
            
            <!-- Call to Action -->
            <div class="fade-in flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="#content" class="bg-red-500 hover:bg-red-600 text-white font-medium px-8 py-3 rounded-lg transition-colors duration-200 flex items-center group">
                    <span>Baca Berita</span>
                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                
                <a href="{{ route('about') }}" class="text-gray-600 hover:text-red-500 font-medium px-6 py-3 border border-gray-200 hover:border-red-200 rounded-lg transition-colors duration-200">
                    Tentang Kami
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section id="content" class="py-12 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">
            <!-- Section Title -->
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-bold text-black mb-2">Statistik Platform</h2>
                <div class="w-12 h-0.5 bg-red-500 mx-auto"></div>
            </div>
            
            <!-- Stats Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 text-center rounded-lg border border-gray-100">
                    <div class="text-3xl font-bold text-red-500 mb-1">{{ number_format($stats['total_articles'] ?? 1250) }}</div>
                    <div class="text-sm text-gray-600">Total Artikel</div>
                </div>
                
                <div class="bg-white p-6 text-center rounded-lg border border-gray-100">
                    <div class="text-3xl font-bold text-red-500 mb-1">{{ $stats['total_readers'] ?? '89.5K' }}</div>
                    <div class="text-sm text-gray-600">Total Pembaca</div>
                </div>
                
                <div class="bg-white p-6 text-center rounded-lg border border-gray-100">
                    <div class="text-3xl font-bold text-red-500 mb-1">{{ $stats['categories_count'] ?? 12 }}</div>
                    <div class="text-sm text-gray-600">Kategori</div>
                </div>
                
                <div class="bg-white p-6 text-center rounded-lg border border-gray-100">
                    <div class="text-3xl font-bold text-red-500 mb-1">{{ $stats['daily_readers'] ?? '2.1K' }}</div>
                    <div class="text-sm text-gray-600">Harian</div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section Divider -->
    <div class="py-6 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex items-center">
                <div class="flex-1 border-t border-gray-200"></div>
                <span class="px-4 text-sm font-semibold text-red-500 uppercase tracking-wide">
                    Berita Terkini
                </span>
                <div class="flex-1 border-t border-gray-200"></div>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content Column -->
            <div class="lg:col-span-3">
               @if($breakingNews->count() > 0)
                    <div class="mb-12">
                        <!-- Breaking News Marquee -->
                        <div 
                            class="flex items-center bg-white border-l-4 border-red-600 rounded-md px-4 py-3 mb-6 shadow-sm overflow-hidden"
                            x-data="{ offset: 0 }"
                            x-init="setInterval(() => {
                                offset -= 1;
                                if (offset <= -$refs.marquee.scrollWidth) {
                                    offset = $refs.container.offsetWidth;
                                }
                            }, 25)"
                        >
                            <!-- Title -->
                            <span class="text-xs md:text-sm font-semibold uppercase text-red-600 mr-4 tracking-widest whitespace-nowrap">
                                Breaking News
                            </span>

                            <!-- Marquee container -->
                            <div class="relative flex-1 h-6 overflow-hidden" x-ref="container">
                                <div class="absolute whitespace-nowrap text-sm md:text-base text-black font-medium" 
                                    :style="'transform: translateX(' + offset + 'px)'"
                                    x-ref="marquee">
                                    {{ $breakingNews->random()->title }}
                                </div>
                            </div>
                        </div>

                        <!-- Articles -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                            @foreach($breakingNews->take(3) as $news)
                                <article class="bg-white border border-gray-200 rounded-md overflow-hidden hover:shadow-md transition duration-200">
                                    <!-- Thumbnail -->
                                    <img src="/storage/{{ $news->thumbnail }}" alt="{{ $news->title }}" class="w-full h-48 object-cover">

                                    <!-- Content -->
                                    <div class="p-4">
                                        @if($news->category)
                                            <a href="{{ route('categories.show', $news->category->slug) }}"
                                            <span class="inline-block text-red-600 text-xs hover:text-red-400 transition duration-300 mb-2">
                                                {{ $news->category->name }}
                                            </span>
                                            </a>
                                        @endif

                                        <h3 class="text-sm font-semibold text-gray-900 mb-1 line-clamp-2 hover:text-red-600 transition">
                                            <a href="/articles/{{ $news->slug }}">{{ $news->title }}</a>
                                        </h3>

                                        <p class="text-xs text-gray-600 line-clamp-2 mb-2">
                                            {{ $news->excerpt }}
                                        </p>

                                        <div class="text-xs text-gray-500 flex items-center">
                                            <span>{{ $news->author->name }}</span>
                                            <span class="mx-1">•</span>
                                            <time>{{ $news->published_at->diffForHumans() }}</time>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Advertisement Banner -->
                @include('components.advertisement')

                <!-- Latest Articles Section -->
                <div class="mb-12">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl text-gray-900 font-bold border-l-4 border-red-600 pl-4">
                            Latest News
                        </h2>
                        <a href="/articles" class="text-red-600 hover:text-red-800 font-medium text-sm transition-colors duration-200">
                            Lihat Semua →
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach($latestArticles->take(6) as $article)
                            <article class="flex gap-4 bg-white border border-gray-100 rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
                                <div class="flex-shrink-0">
                                    <img src="/storage/{{ $article->thumbnail }}" 
                                         alt="{{ $article->title }}" 
                                         class="w-24 h-24 object-cover rounded-lg">
                                </div>
                                
                                <div class="flex-1 min-w-0">
                                    @if($article->category)
                                        <div class="mb-2">
                                            <span class="inline-block text-red-600 hover:text-red-400 transition-colors duration-200 text-xs font-medium">
                                                {{ $article->category->name }}
                                            </span>
                                        </div>
                                    @endif
                                    
                                    <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 hover:text-red-600 transition-colors duration-200">
                                        <a href="/articles/{{ $article->slug }}">{{ $article->title }}</a>
                                    </h3>
                                    
                                    <div class="flex items-center text-xs text-gray-500">
                                        <span>{{ $article->author->name }}</span>
                                        <span class="mx-2">•</span>
                                        <time>{{ $article->published_at->diffForHumans() }}</time>
                                        <span class="mx-2">•</span>
                                        <span>{{ number_format($article->views_count) }} views</span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

                <!-- Advertisement Banner -->
                @include('components.advertisement')

                <!-- Category Sections -->
                @foreach($categoriesWithArticles as $category)
                    <div class="mb-12">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl text-gray-900 font-bold border-l-4 border-red-600 pl-4">
                                {{ $category->name }}
                            </h2>
                            <a href="{{ route('categories.show', $category->slug) }}" 
                               class="text-red-600 hover:text-red-800 font-medium text-sm transition-colors duration-200">
                                Lihat Semua →
                            </a>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach($category->articles->take(3) as $article)
                                <article class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-200">
                                    <div class="aspect-w-16 aspect-h-9">
                                        <img src="/storage/{{ $article->thumbnail }}" 
                                             alt="{{ $article->title }}" 
                                             class="w-full h-40 object-cover">
                                    </div>
                                    
                                    <div class="p-4">
                                        <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 hover:text-red-600 transition-colors duration-200">
                                            <a href="/articles/{{ $article->slug }}">{{ $article->title }}</a>
                                        </h3>
                                        
                                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                            {{ $article->excerpt }}
                                        </p>
                                        
                                        <div class="flex items-center text-xs text-gray-500">
                                            <span>{{ $article->author->name }}</span>
                                            <span class="mx-2">•</span>
                                            <time>{{ $article->published_at->diffForHumans() }}</time>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <!-- Advertisement Banner -->
                @include('components.advertisement')
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Trending Articles -->
                <div class="bg-white rounded-lg p-5 mb-6 border border-gray-200 shadow-sm">
                    <h3 class="text-lg font-bold text-black border-b-2 border-red-600 pb-2 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 17l6-6 4 4 8-8" />
                        </svg>
                        Trending
                    </h3>

                    <div class="space-y-5">
                        @foreach($trendingArticles->take(5) as $index => $article)
                            <div class="flex items-start group border-l-4 pl-3 border-transparent hover:border-red-600 transition-all duration-200">
                                <!-- Article Info -->
                                <div class="ml-3">
                                    <a href="/articles/{{ $article->slug }}" class="block text-sm font-semibold text-gray-900 group-hover:text-red-600 leading-snug line-clamp-2 transition-colors">
                                        {{ $article->title }}
                                    </a>
                                    <div class="text-xs text-gray-500 mt-1 flex items-center gap-2">
                                        <span>{{ $article->views_count }} views</span>
                                        <span>•</span>
                                        <time>{{ $article->published_at->diffForHumans() }}</time>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Sidebar Advertisement -->
                @include('components.sidebar-advertisement')

                <!-- Categories Widget -->
                <div class="bg-white rounded-lg p-5 mb-6 border border-gray-200">
                    <h3 class="text-base font-semibold text-black mb-4">
                        Kategori
                    </h3>
                    
                    <div class="space-y-1">
                        @foreach($categories as $category)
                            <a href="/articles?category={{ $category->slug }}" 
                            class="flex items-center justify-between py-2 px-3 rounded-md hover:bg-red-50 transition-colors duration-150 group">
                                <span class="text-sm text-black group-hover:text-red-500">{{ $category->name }}</span>
                                <span class="text-xs text-gray-600 bg-gray-100 px-2 py-1 rounded-full">
                                    {{ $category->articles_count }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>

                
            </div>
        </div>
    </div>
</div>
@endsection