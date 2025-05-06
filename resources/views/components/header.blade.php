<!-- components/header.blade.php -->
<header class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Top Bar -->
        <div class="flex justify-between items-center py-2 text-sm border-b border-gray-100">
            <div class="flex space-x-4">
                <span class="text-gray-500">{{ now()->format('l, F j, Y') }}</span>
                <a href="#" class="text-gray-500 hover:text-gray-700">Subscribe</a>
            </div>
            <div class="flex space-x-4">
                <a href="#" class="text-gray-500 hover:text-gray-700">Sign In</a>
                <a href="#" class="text-gray-500 hover:text-gray-700">Register</a>
            </div>
        </div>
        
        <!-- Main Header -->
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-800">NewsPortal</a>
            </div>
            
            <div class="hidden md:flex items-center space-x-2">
                <form action="{{ route('search') }}" method="GET" class="relative">
                    <input type="text" name="query" placeholder="Search..." class="w-64 py-2 pl-3 pr-10 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    <button type="submit" class="absolute right-0 top-0 mt-2 mr-3 text-gray-400 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>
            
            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none" x-on:click="mobileMenuOpen = !mobileMenuOpen">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Navigation -->
        <nav class="py-3 border-t border-gray-100">
            <div class="flex justify-between items-center">
                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-800 hover:text-blue-600 font-medium">Home</a>
                    
                    @foreach($categories->where('parent_id', null)->where('is_active', true)->take(6) as $category)
                        <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <a href="{{ route('category.show', $category->slug) }}" class="text-gray-800 hover:text-blue-600 font-medium">{{ $category->name }}</a>
                            
                            @if($category->children->where('is_active', true)->count() > 0)
                                <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 hidden group-hover:block">
                                    @foreach($category->children->where('is_active', true) as $child)
                                        <a href="{{ route('category.show', $child->slug) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ $child->name }}</a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                    
                    <a href="#" class="text-gray-800 hover:text-blue-600 font-medium">More</a>
                </div>
                
                <div class="hidden md:flex space-x-4">
                    <a href="#" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636a9 9 0 010 12.728m-3.536-3.536a3 3 0 010-4.243m-3.536 9.9a9 9 0 01-12.728 0" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                        </svg>
                    </a>
                </div>
            </div>
        </nav>
        
        <!-- Mobile menu -->
        <div class="md:hidden" x-show="mobileMenuOpen" x-cloak>
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-800 hover:bg-gray-100">Home</a>
                
                @foreach($categories->where('parent_id', null)->where('is_active', true) as $category)
                    <div x-data="{ open: false }">
                        <button @click="open = !open" class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-gray-800 hover:bg-gray-100">
                            {{ $category->name }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" :class="{'transform rotate-180': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        
                        <div x-show="open" class="pl-4">
                            @foreach($category->children->where('is_active', true) as $child)
                                <a href="{{ route('category.show', $child->slug) }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:bg-gray-100">{{ $child->name }}</a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                
                <form action="{{ route('search') }}" method="GET" class="px-3 py-2">
                    <div class="relative">
                        <input type="text" name="query" placeholder="Search..." class="w-full py-2 pl-3 pr-10 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        <button type="submit" class="absolute right-0 top-0 mt-2 mr-3 text-gray-400 hover:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Breaking News -->
        @if(isset($featuredArticle) && $featuredArticle)
            <div class="py-2 border-t border-gray-100">
                <div class="flex items-center">
                    <span class="bg-red-600 text-white text-xs font-bold px-2 py-1 rounded mr-2">BREAKING</span>
                    <a href="{{ route('article.show', $featuredArticle->slug) }}" class="text-sm font-medium hover:text-blue-600 truncate">
                        {{ $featuredArticle->title }}
                    </a>
                </div>
            </div>
        @endif
    </div>
</header>