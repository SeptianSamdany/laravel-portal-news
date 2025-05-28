{{-- filepath: c:\Laravel\laravel-portal-news\resources\views\articles\index.blade.php --}}
@extends('layouts.standard')

@section('title', 'Latest News & Articles - ' . config('app.name'))
@section('meta_description', 'Stay informed with our latest news articles and in-depth coverage on various topics.')

@section('content')
<div class="container mx-auto px-4 py-8">
<!-- Hero Section with Featured Articles Carousel -->
@if($featuredArticles->count() > 0)
    <div class="mb-12" 
        x-data="{
            currentIndex: 0,
            articles: {{ Illuminate\Support\Js::from($featuredArticles) }},
            timer: null,
            autoplaySpeed: 5000,
            isHovering: false,
            touchStartX: 0,
            touchEndX: 0,
            
            init() {
                this.startTimer();
                this.preloadImages();
                
                // Touch events for mobile swipe
                this.$el.addEventListener('touchstart', (e) => { this.touchStartX = e.changedTouches[0].screenX });
                this.$el.addEventListener('touchend', (e) => {
                    this.touchEndX = e.changedTouches[0].screenX;
                    if (this.touchStartX - this.touchEndX > 50) {
                        this.next();
                    } else if (this.touchEndX - this.touchStartX > 50) {
                        this.prev();
                    }
                });
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
            
            prev() {
                this.currentIndex = (this.currentIndex - 1 + this.articles.length) % this.articles.length;
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
        @mouseleave="resumeTimer()"
        @keydown.arrow-right="next()"
        @keydown.arrow-left="prev()">
        
        <div class="relative rounded-xl overflow-hidden shadow-2xl" tabindex="0">
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

            <!-- Carousel Slides -->
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
                                    
                                    <!-- Reading time -->
                                    <div class="flex items-center bg-black/30 rounded-full px-3 py-1 backdrop-blur-sm">
                                        <svg class="h-3 w-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span x-text="`${Math.ceil(article.content ? article.content.split(' ').length / 200 : 3)} min`"></span>
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
            
            <!-- Navigation Arrows -->
            <button @click="prev()" 
                    class="absolute left-4 top-1/2 transform -translate-y-1/2 w-10 h-10 bg-black/30 backdrop-blur-sm hover:bg-black/50 text-white rounded-full flex items-center justify-center transition-all duration-200 focus:outline-none z-10 hover:scale-110">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="sr-only">Previous slide</span>
            </button>
            
            <button @click="next()" 
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 w-10 h-10 bg-black/30 backdrop-blur-sm hover:bg-black/50 text-white rounded-full flex items-center justify-center transition-all duration-200 focus:outline-none z-10 hover:scale-110">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="sr-only">Next slide</span>
            </button>
        </div>
    </div>
@endif

    <!-- Advertisement Section -->
    @include('components.advertisement')

    <div class="container mx-auto px-4">
        <!-- Main Content Wrapper -->
        <div class="flex flex-col gap-12">
            <!-- Latest Articles Section with Minimalist News Layout -->
            <div class="w-full">
                <div class="flex flex-wrap items-center justify-between mb-8 pb-3 border-b border-gray-200">
                    <h2 class="text-2xl text-gray-900 font-bold border-l-4 border-red-600 pl-4">
                        Latest News
                    </h2>
                    <div class="flex items-center space-x-2 text-sm">
                        <a href="{{ route('articles.trending') }}" class="text-red-600 hover:text-red-300 transition-colors font-medium">
                            View All Articles
                        </a>
                    </div>
                </div>
                
                @php
                $latestArticles = $articles->take(7);
                $featuredArticle = $latestArticles->shift();
                $secondaryArticles = $latestArticles->take(2);
                $remainingArticles = $latestArticles->skip(2);
                @endphp
                
                @if($articles->isNotEmpty())
                <!-- News Grid Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
                    
                    <!-- Featured Article (Left Column - Spans 2 columns on large screens) -->
                    @if($featuredArticle)
                    <div class="lg:col-span-2">
                        <article class="group">
                            <a href="{{ route('articles.show', $featuredArticle->slug) }}" class="block">
                                <div class="relative mb-4">
                                    <img src="{{ Storage::url($featuredArticle->thumbnail) }}" alt="{{ $featuredArticle->title }}" 
                                        class="w-full h-[300px] lg:h-[400px] object-cover">
                                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/30 transition-colors"></div>
                                </div>
                                
                                <!-- Category -->
                                @if($featuredArticle->category)
                                <div class="mb-2">
                                    <span class="text-red-600 text-sm font-medium uppercase tracking-wide">
                                        {{ $featuredArticle->category->name }}
                                    </span>
                                </div>
                                @endif
                                
                                <!-- Title -->
                                <h3 class="text-2xl lg:text-3xl text-gray-900 mb-3 leading-tight font-bold group-hover:text-gray-700 transition-colors">
                                    {{ $featuredArticle->title }}
                                </h3>
                                
                                <!-- Excerpt -->
                                <p class="text-gray-600 text-base lg:text-lg mb-4 line-clamp-2 leading-relaxed">
                                    {{ $featuredArticle->excerpt }}
                                </p>
                                
                                <!-- Meta -->
                                <div class="flex items-center text-gray-500 text-sm space-x-4">
                                    <span class="font-medium">{{ $featuredArticle->author->name }}</span>
                                    <span>•</span>
                                    <span>{{ $featuredArticle->published_at->format('M d, Y') }}</span>
                                    <span>•</span>
                                    <span>{{ number_format($featuredArticle->views_count) }} views</span>
                                </div>
                            </a>
                        </article>
                    </div>
                    @endif
                    
                    <!-- Secondary Articles (Right Column) -->
                    <div class="space-y-8">
                        @foreach($secondaryArticles as $article)
                        <article class="group">
                            <a href="{{ route('articles.show', $article->slug) }}" class="block">
                                <div class="relative mb-3">
                                    <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}" 
                                        class="w-full h-48 object-cover">
                                    <div class="absolute inset-0 bg-black/10 group-hover:bg-black/20 transition-colors"></div>
                                </div>
                                
                                <!-- Category -->
                                @if($article->category)
                                <div class="mb-2">
                                    <span class="text-red-600 text-xs font-medium uppercase tracking-wide">
                                        {{ $article->category->name }}
                                    </span>
                                </div>
                                @endif
                                
                                <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-gray-700 transition-colors leading-tight">
                                    {{ $article->title }}
                                </h3>
                                
                                <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                    {{ $article->excerpt }}
                                </p>
                                
                                <div class="flex items-center justify-between text-xs text-gray-500">
                                    <span class="font-medium">{{ $article->author->name }}</span>
                                    <div class="flex items-center space-x-3">
                                        <span>{{ $article->published_at->format('M d') }}</span>
                                        <span>{{ number_format($article->views_count) }} views</span>
                                    </div>
                                </div>
                            </a>
                        </article>
                        @endforeach
                    </div>
                </div>
                
                <!-- More Latest Articles - Clean List -->
                @if($remainingArticles->count() > 0)
                <div class="border-t border-gray-200 pt-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">
                        More Stories
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach($remainingArticles as $article)
                        <article class="flex border-b border-gray-100 pb-4 group">
                            <a href="{{ route('articles.show', $article->slug) }}" class="flex w-full">
                                <div class="w-24 h-20 flex-shrink-0 mr-4">
                                    <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}" 
                                        class="w-full h-full object-cover">
                                </div>
                                
                                <div class="flex-1">
                                    <!-- Category -->
                                    @if($article->category)
                                    <span class="text-xs text-red-600 font-medium uppercase tracking-wide">
                                        {{ $article->category->name }}
                                    </span>
                                    @endif
                                    
                                    <h4 class="text-sm font-bold text-gray-900 mt-1 mb-2 line-clamp-2 group-hover:text-gray-700 transition-colors leading-tight">
                                        {{ $article->title }}
                                    </h4>
                                    
                                    <div class="flex items-center justify-between text-xs text-gray-500">
                                        <span class="font-medium">{{ $article->author->name }}</span>
                                        <div class="flex items-center space-x-2">
                                            <span>{{ $article->published_at->format('M d') }}</span>
                                            <span>{{ number_format($article->views_count) }} views</span>
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
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        <h3 class="text-xl font-medium text-gray-900 mb-2">No Articles Available</h3>
                        <p class="text-gray-600">Check back later for the latest news and updates.</p>
                    </div>
                </div>
                @endif
                
                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    {{ $articles->links() }}
                </div>
            </div>
    
            <!-- Advertisement Section -->
            @include('components.advertisement')

            <!-- Editor's Picks Section -->
            <div class="w-full mt-16">
                <div class="flex flex-wrap items-center justify-between mb-8 pb-3 border-b border-gray-200">
                    <h2 class="text-2xl text-gray-900 font-bold border-l-4 border-red-600 pl-4">
                        Editor Picks
                    </h2>
                    <div class="flex items-center space-x-2 text-sm">
                        <a href="{{ route('articles.editor-picks') }}" class="text-red-600 hover:text-red-300 transition-colors font-medium">
                            View All Picks
                        </a>
                    </div>
                </div>
                
                @if($editorPicks->isNotEmpty())
                <!-- Editor's Picks Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    
                    <!-- Main Featured Pick (Left Side - 7 columns) -->
                    @if($mainPick)
                    <div class="lg:col-span-7">
                        <article class="group relative bg-white border-2 border-gray-100">
                            <a href="{{ route('articles.show', $mainPick->slug) }}" class="block">
                                <!-- Image Container -->
                                <div class="relative overflow-hidden">
                                    <img src="{{ Storage::url($mainPick->thumbnail) }}" alt="{{ $mainPick->title }}" 
                                        class="w-full h-[320px] object-cover">
                                    
                                    <!-- Editor's Pick Badge -->
                                    <div class="absolute top-4 right-4">
                                        <div class="bg-red-600 text-white px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider shadow-lg">
                                            Editor's Pick
                                        </div>
                                    </div>
                                    
                                    <!-- Category Badge -->
                                    @if($mainPick->category)
                                    <div class="absolute bottom-4 left-4">
                                        <span class="bg-black text-white px-3 py-1 rounded-full text-xs font-medium uppercase">
                                            {{ $mainPick->category->name }}
                                        </span>
                                    </div>
                                    @endif
                                </div>
                                
                                <!-- Content Section -->
                                <div class="p-6 bg-white">
                                    <h3 class="text-xl lg:text-2xl font-bold text-black mb-3 line-clamp-2 group-hover:text-red-600 transition-colors duration-300">
                                        {{ Str::limit($mainPick->title, 60) }}
                                    </h3>
                                    
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                        {{ Str::limit($mainPick->excerpt, 100) }}
                                    </p>
                                    
                                    <!-- Meta Info -->
                                    <div class="flex items-center justify-between text-xs text-gray-500 border-t pt-3">
                                        <div class="flex items-center space-x-3">
                                            <span class="font-medium text-black">{{ Str::limit($mainPick->author->name, 15) }}</span>
                                            <span class="text-red-500">•</span>
                                            <span>{{ $mainPick->published_at->format('M d') }}</span>
                                        </div>
                                        <div class="flex items-center space-x-1 text-red-600">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="font-medium">{{ number_format($mainPick->views_count) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </article>
                    </div>
                    @endif
                    
                    <!-- Side Picks (Right Side - 5 columns) -->
                    <div class="lg:col-span-5">
                        <div class="space-y-6">
                            @foreach($sidePicks as $pick)
                            <article class="group">
                                <a href="{{ route('articles.show', $pick->slug) }}" class="flex gap-4 pb-6 border-b border-gray-100 last:border-b-0 last:pb-0">
                                    <!-- Image -->
                                    <div class="w-28 h-20 flex-shrink-0 overflow-hidden">
                                        <img src="{{ Storage::url($pick->thumbnail) }}" alt="{{ $pick->title }}" 
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    </div>
                                    
                                    <!-- Content -->
                                    <div class="flex-1 min-w-0">
                                        <!-- Category -->
                                        @if($pick->category)
                                        <div class="mb-1">
                                            <span class="text-red-600 text-xs font-medium uppercase tracking-wide">
                                                {{ $pick->category->name }}
                                            </span>
                                        </div>
                                        @endif
                                        
                                        <!-- Title -->
                                        <h4 class="text-base font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-gray-700 transition-colors leading-tight">
                                            {{ $pick->title }}
                                        </h4>
                                        
                                        <!-- Meta -->
                                        <div class="flex items-center text-xs text-gray-500 space-x-3">
                                            <span>{{ $pick->author->name }}</span>
                                            <span>{{ $pick->published_at->format('M d') }}</span>
                                            <span>{{ number_format($pick->views_count) }} views</span>
                                        </div>
                                    </div>
                                </a>
                            </article>
                            @endforeach
                            
                            <!-- View More Button -->
                            <div class="pt-4 border-t border-gray-100">
                                <a href="#" class="flex items-center justify-center w-full py-3 text-sm font-medium text-gray-700 bg-gray-50 hover:bg-gray-100 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    More Editor's Picks
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Additional Picks Row (Optional - if more than 5 picks) -->
                @php
                $additionalPicks = App\Models\Article::with(['author', 'category'])
                                    ->where('status', 'published')
                                    ->latest('published_at')
                                    ->skip(5)
                                    ->take(3)
                                    ->get();
                @endphp
                
                @if($additionalPicks->isNotEmpty())
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        @foreach($additionalPicks as $pick)
                        <article class="group">
                            <a href="{{ route('articles.show', $pick->slug) }}" class="block">
                                <!-- Image -->
                                <div class="relative mb-4 overflow-hidden">
                                    <img src="{{ Storage::url($pick->thumbnail) }}" alt="{{ $pick->title }}" 
                                        class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-black/10 group-hover:bg-black/20 transition-colors"></div>
                                </div>
                                
                                <!-- Content -->
                                <div>
                                    @if($pick->category)
                                    <div class="mb-2">
                                        <span class="text-red-600 text-xs font-medium uppercase tracking-wide">
                                            {{ $pick->category->name }}
                                        </span>
                                    </div>
                                    @endif
                                    
                                    <h4 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-gray-700 transition-colors leading-tight">
                                        {{ $pick->title }}
                                    </h4>
                                    
                                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                        {{ $pick->excerpt }}
                                    </p>
                                    
                                    <div class="flex items-center text-xs text-gray-500 space-x-3">
                                        <span>{{ $pick->author->name }}</span>
                                        <span>{{ $pick->published_at->format('M d, Y') }}</span>
                                        <span>{{ number_format($pick->views_count) }} views</span>
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
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                        <h3 class="text-xl font-medium text-gray-900 mb-2">No Editor's Picks Available</h3>
                        <p class="text-gray-600">Featured articles will appear here once selected by editors.</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Advertisement Section -->
            @include('components.advertisement')

            <!-- Articles by Category Section - Clean & Minimalist -->
            <div class="w-full mt-16">
                <div class="flex flex-wrap items-center justify-between mb-8 pb-3 border-b border-gray-200">
                    <h2 class="text-2xl text-gray-900 font-bold border-l-4 border-red-600 pl-4">
                        Browse by Category
                    </h2>
                    <div class="flex items-center space-x-2 text-sm">
                        <a href="#" class="text-red-600 hover:text-red-300 transition-colors font-medium">
                            All Categories
                        </a>
                    </div>
                </div>
                
                @php
                $categories = App\Models\Category::withCount('articles')
                                ->having('articles_count', '>', 0)
                                ->orderBy('articles_count', 'desc')
                                ->take(6)
                                ->get();
                @endphp
                
                @if($categories->isNotEmpty())
                <!-- Simple Category Tabs -->
                <div class="mb-10">
                    <div class="flex flex-wrap gap-6 border-b border-gray-100">
                        <button class="category-tab active pb-3 text-sm font-medium text-red-600 border-b-2 border-red-600" 
                                data-category="all">
                            All Articles
                        </button>
                        @foreach($categories as $category)
                        <button class="category-tab pb-3 text-sm font-medium text-gray-500 hover:text-gray-900 border-b-2 border-transparent hover:border-gray-300 transition-colors" 
                                data-category="{{ $category->id }}">
                            {{ $category->name }}
                        </button>
                        @endforeach
                    </div>
                </div>
                
                <!-- Category Content -->
                <div id="category-content">
                    <!-- All Articles Section (Default) -->
                    <div class="category-section active" data-category="all">
                        @php
                        $recentArticles = App\Models\Article::with(['author', 'category'])
                                        ->where('status', 'published')
                                        ->latest('published_at')
                                        ->take(8)
                                        ->get();
                        @endphp
                        
                        <div class="space-y-6">
                            @foreach($recentArticles as $article)
                            <article class="group">
                                <a href="{{ route('articles.show', $article->slug) }}" class="flex gap-6 py-6 border-b border-gray-100 hover:bg-gray-50/50 transition-colors">
                                    <!-- Image -->
                                    <div class="w-32 h-24 flex-shrink-0">
                                        <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}" 
                                            class="w-full h-full object-cover">
                                    </div>
                                    
                                    <!-- Content -->
                                    <div class="flex-1 min-w-0">
                                        <!-- Category -->
                                        @if($article->category)
                                        <div class="mb-2">
                                            <span class="text-red-600 text-xs font-medium uppercase tracking-wide">
                                                {{ $article->category->name }}
                                            </span>
                                        </div>
                                        @endif
                                        
                                        <!-- Title -->
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-gray-700 transition-colors line-clamp-2">
                                            {{ $article->title }}
                                        </h3>
                                        
                                        <!-- Excerpt -->
                                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                            {{ $article->excerpt }}
                                        </p>
                                        
                                        <!-- Meta -->
                                        <div class="flex items-center text-xs text-gray-500 space-x-4">
                                            <span>{{ $article->author->name }}</span>
                                            <span>{{ $article->published_at->format('M d, Y') }}</span>
                                            <span>{{ number_format($article->views_count) }} views</span>
                                        </div>
                                    </div>
                                </a>
                            </article>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Individual Category Sections -->
                    @foreach($categories as $category)
                    @php
                    $categoryArticles = $category->articles()
                                    ->with(['author', 'category'])
                                    ->where('status', 'published')
                                    ->latest('published_at')
                                    ->take(8)
                                    ->get();
                    @endphp
                    
                    @if($categoryArticles->isNotEmpty())
                    <div class="category-section hidden" data-category="{{ $category->id }}">
                        <div class="space-y-6">
                            @foreach($categoryArticles as $article)
                            <article class="group">
                                <a href="{{ route('articles.show', $article->slug) }}" class="flex gap-6 py-6 border-b border-gray-100 hover:bg-gray-50/50 transition-colors">
                                    <!-- Image -->
                                    <div class="w-32 h-24 flex-shrink-0">
                                        <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}" 
                                            class="w-full h-full object-cover">
                                    </div>
                                    
                                    <!-- Content -->
                                    <div class="flex-1 min-w-0">
                                        <!-- Category -->
                                        <div class="mb-2">
                                            <span class="text-red-600 text-xs font-medium uppercase tracking-wide">
                                                {{ $article->category->name }}
                                            </span>
                                        </div>
                                        
                                        <!-- Title -->
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-gray-700 transition-colors line-clamp-2">
                                            {{ $article->title }}
                                        </h3>
                                        
                                        <!-- Excerpt -->
                                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                            {{ $article->excerpt }}
                                        </p>
                                        
                                        <!-- Meta -->
                                        <div class="flex items-center text-xs text-gray-500 space-x-4">
                                            <span>{{ $article->author->name }}</span>
                                            <span>{{ $article->published_at->format('M d, Y') }}</span>
                                            <span>{{ number_format($article->views_count) }} views</span>
                                        </div>
                                    </div>
                                </a>
                            </article>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                
                @else
                <!-- Empty State -->
                <div class="py-16 text-center">
                    <div class="max-w-md mx-auto">
                        <h3 class="text-xl font-medium text-gray-900 mb-2">No Categories Available</h3>
                        <p class="text-gray-600">Categories will appear here once articles are published.</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Advertisement Section -->
            @include('components.advertisement')
        </div>
    </div>
@endsection