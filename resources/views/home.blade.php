@extends('layouts.standard')

@section('title', 'Beranda - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-white">
    <!-- Welcome Banner Section -->
    <div class="bg-white border-b-2 border-red-500 py-8 mb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                <span class="text-black">News</span><span class="text-red-500">Hub</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                Pusat Informasi Terpercaya untuk Berita Terkini
            </p>
            
            <div class="flex flex-wrap justify-center gap-8 text-sm">
                <div class="flex items-center text-gray-700">
                    <svg class="w-4 h-4 mr-3 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Berita Terverifikasi
                </div>
                <div class="flex items-center text-gray-700">
                    <svg class="w-4 h-4 mr-3 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                    </svg>
                    Update 24/7
                </div>
                <div class="flex items-center text-gray-700">
                    <svg class="w-4 h-4 mr-3 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                    </svg>
                    Multi Kategori
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="stat-card bg-white border border-gray-300 p-6 text-center">
                <div class="text-3xl font-bold text-red-600 mb-2">1,250</div>
                <div class="text-sm text-gray-600 border-t border-gray-100 pt-2">Total Artikel</div>
            </div>
            <div class="stat-card bg-white border border-gray-300 p-6 text-center">
                <div class="text-3xl font-bold text-red-600 mb-2">89,500</div>
                <div class="text-sm text-gray-600 border-t border-gray-100 pt-2">Total Pembaca</div>
            </div>
            <div class="stat-card bg-white border border-gray-300 p-6 text-center">
                <div class="text-3xl font-bold text-red-600 mb-2">12</div>
                <div class="text-sm text-gray-600 border-t border-gray-100 pt-2">Kategori Berita</div>
            </div>
            <div class="stat-card bg-white border border-gray-300 p-6 text-center">
                <div class="text-3xl font-bold text-red-600 mb-2">2,150</div>
                <div class="text-sm text-gray-600 border-t border-gray-100 pt-2">Pembaca Harian</div>
            </div>
        </div>
    </div>

    <!-- Hero Section with Featured Articles Carousel - Auto Rotate Only -->
    @if($featuredArticles->count() > 0)
        <div class="mb-12" 
            x-data="{
                currentIndex: 0,
                articles: {{ Illuminate\Support\Js::from($featuredArticles) }},
                timer: null,
                autoplaySpeed: 5000,
                isHovering: false,
                
                init() {
                    this.startTimer();
                    this.preloadImages();
                },
                
                preloadImages() {
                    this.articles.forEach(article => {
                        const img = new Image();
                        img.src = '/storage/' + article.thumbnail;
                    });
                },
                
                startTimer() {
                    if (!this.isHovering) {
                        clearInterval(this.timer);
                        this.timer = setInterval(() => {
                            this.next();
                        }, this.autoplaySpeed);
                    }
                },
                
                pauseTimer() {
                    this.isHovering = true;
                    clearInterval(this.timer);
                },
                
                resumeTimer() {
                    this.isHovering = false;
                    this.startTimer();
                },
                
                next() {
                    this.currentIndex = (this.currentIndex + 1) % this.articles.length;
                    this.resetTimer();
                },
                
                goToSlide(index) {
                    this.currentIndex = index;
                    this.resetTimer();
                },
                
                resetTimer() {
                    clearInterval(this.timer);
                    if (!this.isHovering) {
                        this.startTimer();
                    }
                },
                
                truncateText(text, length = 80) {
                    return text.length > length ? text.substring(0, length) + '...' : text;
                }
            }"
            @mouseenter="pauseTimer()"
            @mouseleave="resumeTimer()">
            
            <div class="relative rounded-xl overflow-hidden shadow-2xl">
                <!-- Progress Bar -->
                <div class="absolute top-0 left-0 right-0 z-20 h-1 bg-black/20">
                    <div class="h-full bg-gradient-to-r from-red-500 to-red-600"
                        x-ref="progressBar"
                        x-effect="
                            if (!isHovering) {
                                $refs.progressBar.style.transition = `width ${autoplaySpeed}ms linear`;
                                $refs.progressBar.style.width = '100%';
                                setTimeout(() => {
                                    $refs.progressBar.style.width = '0%';
                                }, 50);
                            } else {
                                $refs.progressBar.style.transition = 'none';
                            }
                        "
                        :style="{ width: '0%' }">
                    </div>
                </div>

                <div class="relative h-[400px] md:h-[500px] lg:h-[550px] overflow-hidden">
                    <template x-for="(article, index) in articles" :key="index">
                        <div x-show="currentIndex === index"
                            x-transition:enter="transition ease-out duration-700"
                            x-transition:enter-start="opacity-0 transform scale-105"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-500"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="absolute inset-0 w-full h-full">
                            
                            <img :src="'/storage/' + article.thumbnail" :alt="article.title" 
                                class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
                            
                            <div class="absolute bottom-0 left-0 right-0 p-6 md:p-10 lg:p-12">
                                <div class="max-w-3xl">
                                    <!-- Category Badge -->
                                    <template x-if="article.category">
                                        <div class="mb-4">
                                            <a :href="`/articles?category=${article.category.slug}`" 
                                            class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-bold uppercase tracking-wider rounded-full hover:bg-red-700 transition-all duration-200 hover:scale-105">
                                                <span x-text="article.category.name"></span>
                                            </a>    
                                        </div>
                                    </template>
                                    
                                    <!-- Title -->
                                    <h1 class="text-2xl md:text-3xl lg:text-4xl text-white font-bold mb-3 lg:mb-4 
                                            leading-tight tracking-tight drop-shadow-lg border-l-8 border-red-600 pl-6"
                                        x-text="truncateText(article.title, 60)">
                                    </h1>
                                    
                                    <!-- Excerpt -->
                                    <div class="mb-6">
                                        <p class="text-gray-100 text-sm md:text-base max-w-2xl 
                                                leading-relaxed font-light line-clamp-2"
                                        x-text="truncateText(article.excerpt, 120)">
                                        </p>
                                    </div>
                                    
                                    <!-- Meta Info -->
                                    <div class="flex flex-wrap items-center gap-4 mb-6 text-xs text-gray-300">
                                        <div class="flex items-center bg-black/30 rounded-full px-3 py-1 backdrop-blur-sm">
                                            <svg class="h-3 w-3 mr-2 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="text-white font-medium" x-text="article.author.name"></span>
                                        </div>
                                        
                                        <div class="flex items-center bg-black/30 rounded-full px-3 py-1 backdrop-blur-sm">
                                            <svg class="h-3 w-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span x-text="new Date(article.published_at).toLocaleDateString('id-ID', {
                                                day: 'numeric',
                                                month: 'short'
                                            })"></span>
                                        </div>
                                        
                                        <div class="flex items-center bg-black/30 rounded-full px-3 py-1 backdrop-blur-sm">
                                            <svg class="h-3 w-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            <span x-text="article.views_count.toLocaleString('id-ID')"></span>
                                        </div>
                                    </div>
                                    
                                    <!-- CTA Button -->
                                    <div>
                                        <a :href="`/articles/${article.slug}`" 
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
                    </template>
                </div>
                
                <!-- Dots Navigation -->
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
                    <template x-for="(article, index) in articles" :key="index">
                        <button @click="goToSlide(index)" 
                                class="w-3 h-3 rounded-full transition-all duration-300 focus:outline-none transform hover:scale-110"
                                :class="currentIndex === index ? 'bg-red-600 shadow-lg' : 'bg-white/50 hover:bg-white/70'">
                            <span class="sr-only" x-text="`Go to slide ${index + 1}`"></span>
                        </button>
                    </template>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Content Area -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content Column -->
            <div class="lg:col-span-3">
                
                <!-- Breaking News Section -->
                @if($breakingNews->count() > 0)
                    <div class="mb-12">
                        <div class="flex items-center mb-6" x-data="{ offset: 0 }" x-init="setInterval(() => {offset -= 1;
                                        if (offset <= -$refs.marquee.scrollWidth) {
                                            offset = $refs.container.offsetWidth;}}, 20)">
                            <div class="bg-red-600 text-white px-4 py-2 rounded-l-md font-bold text-sm uppercase tracking-wide">
                                Breaking News
                            </div>
                            <div class="bg-red-100 flex-1 h-10 rounded-r-md flex items-center overflow-hidden relative" x-ref="container">
                                <div
                                    class="absolute whitespace-nowrap text-red-800 text-sm font-medium"
                                    :style="'transform: translateX(' + offset + 'px)'"
                                    x-ref="marquee"
                                >
                                    {{ $breakingNews->first()->title }}
                                </div>
                            </div>
                        </div>     
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($breakingNews->take(3) as $news)
                                <article class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-200">
                                    <div class="aspect-w-16 aspect-h-9">
                                        <img src="/storage/{{ $news->thumbnail }}" 
                                             alt="{{ $news->title }}" 
                                             class="w-full h-48 object-cover">
                                    </div>
                                    
                                    <div class="p-4">
                                        @if($news->category)
                                            <div class="mb-2">
                                                <span class="inline-block bg-red-100 text-red-800 text-xs font-medium px-2 py-1 rounded">
                                                    {{ $news->category->name }}
                                                </span>
                                            </div>
                                        @endif
                                        
                                        <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 hover:text-red-600 transition-colors duration-200">
                                            <a href="/articles/{{ $news->slug }}">{{ $news->title }}</a>
                                        </h3>
                                        
                                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                            {{ $news->excerpt }}
                                        </p>
                                        
                                        <div class="flex items-center text-xs text-gray-500">
                                            <span>{{ $news->author->name }}</span>
                                            <span class="mx-2">•</span>
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

                {{-- Editor's Pick Section --}}
                {{-- @if(isset($editorsPick) && $editorsPick->count() > 0)
                    <div class="mb-12">
                        <div class="flex items-center mb-6">
                            <div class="bg-yellow-500 text-white px-4 py-2 rounded-l-md font-bold text-sm uppercase tracking-wide">
                                <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                Pilihan Editor
                            </div>
                            <div class="bg-yellow-100 flex-1 h-10 rounded-r-md flex items-center px-4">
                                <div class="text-yellow-800 text-sm font-medium">
                                    Artikel terpilih dari tim redaksi NewsHub
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($editorsPick->take(2) as $article)
                                <article class="bg-gradient-to-br from-yellow-50 to-orange-50 border border-yellow-200 rounded-lg overflow-hidden hover:shadow-lg transition-all duration-300">
                                    <div class="aspect-w-16 aspect-h-9">
                                        <img src="/storage/{{ $article->thumbnail }}" 
                                            alt="{{ $article->title }}" 
                                            class="w-full h-56 object-cover">
                                    </div>
                                    
                                    <div class="p-6">
                                        @if($article->category)
                                            <div class="mb-3">
                                                <span class="inline-block bg-yellow-200 text-yellow-800 text-xs font-medium px-2 py-1 rounded">
                                                    {{ $article->category->name }}
                                                </span>
                                            </div>
                                        @endif
                                        
                                        <h3 class="font-bold text-gray-900 mb-3 text-lg line-clamp-2 hover:text-yellow-600 transition-colors duration-200">
                                            <a href="/articles/{{ $article->slug }}">{{ $article->title }}</a>
                                        </h3>
                                        
                                        <p class="text-gray-700 text-sm mb-4 line-clamp-3">
                                            {{ $article->excerpt }}
                                        </p>
                                        
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center text-xs text-gray-600">
                                                <span>{{ $article->author->name }}</span>
                                                <span class="mx-2">•</span>
                                                <time>{{ $article->published_at->diffForHumans() }}</time>
                                            </div>
                                            <div class="text-yellow-600">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endif --}}

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
                                            <span class="inline-block bg-gray-100 text-gray-800 text-xs font-medium px-2 py-1 rounded">
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

                <!-- Category Sections -->
                @foreach($categoriesWithArticles as $category)
                    <div class="mb-12">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl text-gray-900 font-bold border-l-4 border-red-600 pl-4">
                                {{ $category->name }}
                            </h2>
                            <a href="/articles?category={{ $category->slug }}" 
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
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Trending Articles -->
                <div class="bg-white rounded-lg p-5 mb-6 border border-gray-200">
                    <h3 class="text-base font-semibold text-black mb-4">
                        Trending
                    </h3>
                    
                    <div class="space-y-4">
                        @foreach($trendingArticles->take(5) as $index => $article)
                            <div class="flex items-start gap-3 group">
                                <div class="flex-shrink-0 w-6 h-6 bg-red-500 text-white rounded flex items-center justify-center text-xs font-medium">
                                    {{ $index + 1 }}
                                </div>
                                
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-medium text-black line-clamp-2 group-hover:text-red-500 transition-colors duration-150">
                                        <a href="/articles/{{ $article->slug }}">{{ $article->title }}</a>
                                    </h4>
                                    
                                    <div class="flex items-center text-xs text-gray-600 mt-2">
                                        <span>{{ $article->views_count }} views</span>
                                        <span class="mx-2">•</span>
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