{{-- filepath: c:\Laravel\laravel-portal-news\resources\views\articles\editor-picks.blade.php --}}
@extends('layouts.standard')

@section('title', 'Editor\'s Picks - ' . config('app.name'))
@section('meta_description', 'Discover our hand-picked selection of the best articles chosen by our editorial team.')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="mb-12">
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-red-600 text-white rounded-full mb-6">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Editor's Picks</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Handpicked stories by our editorial team featuring the most compelling, insightful, and impactful content.</p>
        </div>
    </div>

    <!-- Featured Editor's Pick -->
    @php
    $featuredPick = $editorPicks->first();
    $remainingPicks = $editorPicks->skip(1);
    @endphp

    @if($featuredPick)
    <div class="mb-16">
        <article class="group relative bg-white border border-gray-200 hover:border-red-500 transition-all duration-300 shadow-xl hover:shadow-2xl">
            <a href="{{ route('articles.show', $featuredPick->slug) }}" class="block">
                <div class="relative overflow-hidden">
                    <img src="{{ Storage::url($featuredPick->thumbnail) }}" alt="{{ $featuredPick->title }}" 
                        class="w-full h-[400px] lg:h-[500px] object-cover group-hover:scale-105 transition-transform duration-700">
                    
                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                    
                    <!-- Featured Badge -->
                    <div class="absolute top-6 right-6">
                        <div class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-bold uppercase tracking-wider shadow-lg">
                            Featured Pick
                        </div>
                    </div>
                    
                    <!-- Content Overlay -->
                    <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                        <div class="max-w-4xl">
                            @if($featuredPick->category)
                            <div class="mb-4">
                                <span class="bg-black/50 text-white px-3 py-1 rounded-full text-sm font-medium uppercase backdrop-blur-sm">
                                    {{ $featuredPick->category->name }}
                                </span>
                            </div>
                            @endif
                            
                            <h2 class="text-3xl lg:text-4xl font-bold mb-4 leading-tight">
                                {{ $featuredPick->title }}
                            </h2>
                            
                            <p class="text-gray-200 text-lg mb-6 line-clamp-2 leading-relaxed">
                                {{ $featuredPick->excerpt }}
                            </p>
                            
                            <div class="flex items-center text-gray-300 text-sm space-x-4">
                                <span class="font-medium">{{ $featuredPick->author->name }}</span>
                                <span>•</span>
                                <span>{{ $featuredPick->published_at->format('M d, Y') }}</span>
                                <span>•</span>
                                <span>{{ number_format($featuredPick->views_count) }} views</span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </article>
    </div>
    @endif

    <!-- Grid of Editor's Picks -->
    @if($remainingPicks->count() > 0)
    <div class="mb-16">
        <div class="flex items-center justify-between mb-8 pb-3 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-900 border-l-4 border-red-600 pl-4">
                More Editor's Picks
            </h2>
            <div class="text-sm text-gray-500">
                {{ $editorPicks->count() }} articles selected
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($remainingPicks as $pick)
            <article class="group bg-white border border-gray-200 hover:border-red-500 transition-all duration-300 shadow-lg hover:shadow-xl">
                <a href="{{ route('articles.show', $pick->slug) }}" class="block">
                    <div class="relative overflow-hidden">
                        <img src="{{ Storage::url($pick->thumbnail) }}" alt="{{ $pick->title }}" 
                            class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                        
                        <!-- Editor's Pick Badge -->
                        <div class="absolute top-3 right-3">
                            <div class="bg-red-600 text-white px-2 py-1 rounded text-xs font-bold uppercase">
                                Pick
                            </div>
                        </div>
                        
                        <!-- Category Badge -->
                        @if($pick->category)
                        <div class="absolute bottom-3 left-3">
                            <span class="bg-black/80 text-white px-2 py-1 rounded-full text-xs font-medium uppercase backdrop-blur-sm">
                                {{ $pick->category->name }}
                            </span>
                        </div>
                        @endif
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-red-600 transition-colors duration-300">
                            {{ Str::limit($pick->title, 80) }}
                        </h3>
                        
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ Str::limit($pick->excerpt, 120) }}
                        </p>
                        
                        <div class="flex items-center justify-between text-xs text-gray-500 border-t pt-3">
                            <div class="flex items-center space-x-2">
                                <span class="font-medium text-black">{{ Str::limit($pick->author->name, 20) }}</span>
                                <span class="text-red-500">•</span>
                                <span>{{ $pick->published_at->format('M d') }}</span>
                            </div>
                            <div class="flex items-center space-x-1 text-red-600">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-medium">{{ number_format($pick->views_count) }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </article>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Why These Articles? Section -->
    <div class="mb-16 bg-gray-50 p-8 rounded-xl">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Why These Articles?</h2>
            <p class="text-gray-600 leading-relaxed">
                Our editorial team carefully selects these articles based on their quality, relevance, and impact. 
                Each pick represents content that stands out for its insightful analysis, compelling storytelling, 
                or significant contribution to important conversations.
            </p>
        </div>
    </div>

    <!-- Advertisement Section -->
    @include('components.advertisement')

    <!-- Categories Represented -->
    @php
    $representedCategories = $editorPicks->pluck('category')->filter()->unique('id');
    @endphp
    
    @if($representedCategories->count() > 0)
    <div class="mb-16">
        <div class="flex items-center justify-between mb-6 pb-3 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">Categories Featured</h2>
        </div>
        
        <div class="flex flex-wrap gap-3">
            @foreach($representedCategories as $category)
            <a href="{{ route('articles.index', ['category' => $category->slug]) }}" 
               class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 text-gray-700 text-sm font-medium hover:border-red-500 hover:text-red-600 transition-colors">
                {{ $category->name }}
                <span class="ml-2 bg-red-100 text-red-600 text-xs px-2 py-0.5 rounded-full">
                    {{ $editorPicks->where('category.id', $category->id)->count() }}
                </span>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Pagination -->
    @if($editorPicks->hasPages())
    <div class="flex justify-center">
        {{ $editorPicks->links() }}
    </div>
    @endif

    <!-- Empty State -->
    @if($editorPicks->count() === 0)
    <div class="py-20 text-center">
        <div class="max-w-md mx-auto">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
            </div>
            <h3 class="text-xl font-medium text-gray-900 mb-2">No Editor's Picks Yet</h3>
            <p class="text-gray-600 mb-6">Our editorial team is working on selecting the best articles for you.</p>
            <a href="{{ route('articles.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition-colors">
                Browse All Articles
            </a>
        </div>
    </div>
    @endif

    <!-- Back to Articles -->
    <div class="mt-16 text-center">
        <a href="{{ route('articles.index') }}" 
           class="inline-flex items-center text-gray-600 hover:text-red-600 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to All Articles
        </a>
    </div>
</div>
@endsection