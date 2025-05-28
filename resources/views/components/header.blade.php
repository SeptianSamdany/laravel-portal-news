<header class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
    <!-- Top Section: Logo, Search, Auth -->
    <div class="border-b border-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="/" class="flex items-center group">
                        <div class="font-bold text-2xl tracking-tight">
                            <span class="text-black">News</span><span class="text-red-600">Hub</span>
                        </div>
                    </a>
                </div>

                <!-- Main Navigation (Desktop) -->
                <div class="hidden lg:flex items-center space-x-8">
                    <!-- Home -->
                    <a href="{{ route('home') }}" 
                       class="text-sm font-medium {{ request()->routeIs('home') ? 'text-red-600' : 'text-gray-700 hover:text-red-600' }} transition-colors duration-200">
                        Home
                    </a>

                    <!-- Articles Mega Dropdown -->
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="text-sm font-medium {{ request()->routeIs('articles.*') ? 'text-red-600' : 'text-gray-700 hover:text-red-600' }} transition-colors duration-200 flex items-center">
                            Articles
                            <svg class="ml-1 h-4 w-4 transition-transform duration-200" 
                                 :class="{ 'rotate-180': open }" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute left-0 top-full mt-1 w-48 bg-white rounded-lg shadow-lg border border-gray-100 py-2 z-50">
                            <a href="{{ route('articles.index') }}" 
                               class="block px-4 py-3 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200 {{ request()->routeIs('articles.index') ? 'text-red-600 bg-red-50' : '' }}">
                                <div class="font-medium">All Articles</div>
                                <div class="text-xs text-gray-500 mt-1">Browse all published articles</div>
                            </a>
                            <a href="{{ route('articles.trending') }}" 
                               class="block px-4 py-3 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200 {{ request()->routeIs('articles.trending') ? 'text-red-600 bg-red-50' : '' }}">
                                <div class="font-medium flex items-center">
                                    Trending
                                    <span class="ml-2 px-2 py-1 bg-red-100 text-red-700 text-xs rounded-full">Hot</span>
                                </div>
                                <div class="text-xs text-gray-500 mt-1">Most popular articles</div>
                            </a>
                        </div>
                    </div>

                    <!-- Categories Mega Dropdown -->
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="text-sm font-medium {{ request()->routeIs('categories.*') ? 'text-red-600' : 'text-gray-700 hover:text-red-600' }} transition-colors duration-200 flex items-center">
                            Categories
                            <svg class="ml-1 h-4 w-4 transition-transform duration-200" 
                                 :class="{ 'rotate-180': open }" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute left-0 top-full mt-1 w-80 bg-white rounded-lg shadow-lg border border-gray-100 p-6 z-50">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <h3 class="font-semibold text-gray-900 mb-3">Browse Categories</h3>
                                    <a href="{{ route('categories.index') }}" 
                                       class="block px-3 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-md transition-colors duration-200 {{ request()->routeIs('categories.index') ? 'text-red-600 bg-red-50' : '' }}">
                                        All Categories
                                    </a>
                                    
                                    @php
                                        $featuredCategories = \App\Models\Category::take(5)->get();
                                    @endphp
                                    
                                    @foreach($featuredCategories as $category)
                                        <a href="{{ route('categories.show', $category->slug) }}" 
                                           class="block px-3 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-md transition-colors duration-200 {{ request()->is('categories/' . $category->slug) ? 'text-red-600 bg-red-50' : '' }}">
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                </div>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h3 class="font-semibold text-gray-900 mb-2">Popular Topics</h3>
                                    <p class="text-sm text-gray-600 mb-3">Discover trending categories with the most engaging content.</p>
                                    <a href="{{ route('categories.index') }}" 
                                       class="inline-flex items-center text-sm font-medium text-red-600 hover:text-red-700">
                                        Explore all
                                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Authors Mega Dropdown -->
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="text-sm font-medium {{ request()->routeIs('authors.*') ? 'text-red-600' : 'text-gray-700 hover:text-red-600' }} transition-colors duration-200 flex items-center">
                            Authors
                            <svg class="ml-1 h-4 w-4 transition-transform duration-200" 
                                 :class="{ 'rotate-180': open }" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute left-0 top-full mt-1 w-72 bg-white rounded-lg shadow-lg border border-gray-100 p-6 z-50">
                            <div class="space-y-4">
                                <div>
                                    <h3 class="font-semibold text-gray-900 mb-3">Writers & Contributors</h3>
                                    <a href="{{ route('authors.index') }}" 
                                       class="block px-3 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-md transition-colors duration-200 {{ request()->routeIs('authors.index') ? 'text-red-600 bg-red-50' : '' }}">
                                        <div class="font-medium">All Authors</div>
                                        <div class="text-xs text-gray-500 mt-1">Meet our writing community</div>
                                    </a>
                                </div>
                                
                                <div class="border-t border-gray-100 pt-4">
                                    <h4 class="font-medium text-gray-900 mb-2">Join Our Team</h4>
                                    <a href="{{ route('authors.apply') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        Apply as Author
                                    </a>
                                    <p class="text-xs text-gray-500 mt-2">Share your expertise with our readers</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- About -->
                    {{-- <a href="{{ route('pages.about') }}" 
                       class="text-sm font-medium {{ request()->routeIs('about') ? 'text-red-600' : 'text-gray-700 hover:text-red-600' }} transition-colors duration-200">
                        About
                    </a> --}}
                </div>

                <!-- Search & Auth Section -->
                <div class="flex items-center space-x-4">
                    <!-- Search Bar (Desktop) -->
                    <div class="hidden md:block relative">
                        <form action="{{ route('search.index') }}" method="GET">
                            <div class="relative">
                                <input type="text" 
                                       name="q" 
                                       value="{{ request('q') }}"
                                       placeholder="Search articles..." 
                                       class="w-80 px-4 py-2 pr-12 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none text-sm bg-gray-50 focus:bg-white transition-colors">
                                <button type="submit" 
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-red-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Search Button (Mobile) -->
                    <div class="md:hidden relative" x-data="{ searchOpen: false }">
                        <button @click="searchOpen = !searchOpen" 
                                class="p-2 text-gray-600 hover:text-red-600 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                        
                        <!-- Search Dropdown (Mobile) -->
                        <div x-show="searchOpen" 
                             @click.away="searchOpen = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 top-full mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-100 p-4 z-50">
                            <form action="{{ route('search.index') }}" method="GET">
                                <div class="relative">
                                    <input type="text" 
                                           name="q" 
                                           value="{{ request('q') }}"
                                           placeholder="Search articles..." 
                                           class="w-full px-4 py-3 pr-12 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none text-sm">
                                    <button type="submit" 
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-red-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Auth Section -->
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" 
                                    class="flex items-center space-x-2 text-gray-700 hover:text-red-600 transition-colors duration-200">
                                <div class="w-8 h-8 bg-gray-200 rounded-full overflow-hidden">
                                    @if(auth()->user()->avatar)
                                        <img src="{{ auth()->user()->avatar_url }}" 
                                             alt="{{ Auth::user()->name }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-red-600 text-white text-sm font-medium">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <span class="hidden sm:block text-sm font-medium">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 transition-transform duration-200" 
                                     :class="{ 'rotate-180': open }" 
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            
                            <div x-show="open" 
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 top-full mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 py-2 z-50">
                                
                                <a href="{{ route('profile.edit') }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200">
                                    Your Profile
                                </a>
                                
                                {{-- <a href="{{ route('subscription.form') }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200">
                                    Newsletter
                                </a> --}}
                                
                                @hasanyrole('super_admin|author|writer')
                                    <a href="{{ route('dashboard') }}" 
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200">
                                        Dashboard
                                    </a>
                                @endhasanyrole
                                
                                <hr class="my-2 border-gray-100">
                                
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200">
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('login') }}" 
                               class="text-sm font-medium text-gray-700 hover:text-red-600 transition-colors duration-200">
                                Sign In
                            </a>
                            <a href="{{ route('register') }}" 
                               class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors duration-200">
                                Get Started
                            </a>
                        </div>
                    @endauth

                    <!-- Mobile Menu Button -->
                    <div class="lg:hidden" x-data="{ mobileOpen: false }">
                        <button @click="mobileOpen = !mobileOpen" 
                                class="p-2 text-gray-600 hover:text-red-600 transition-colors duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                <path x-show="mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                        
                        <!-- Mobile Menu -->
                        <div x-show="mobileOpen" 
                             @click.away="mobileOpen = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-4 top-full mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-100 py-4 z-50">
                            
                            <!-- Mobile Search -->
                            <div class="px-4 py-3 border-b border-gray-100">
                                <form action="{{ route('search.index') }}" method="GET">
                                    <div class="relative">
                                        <input type="text" 
                                               name="q" 
                                               value="{{ request('q') }}"
                                               placeholder="Search..." 
                                               class="w-full px-3 py-2 pr-10 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none text-sm">
                                        <button type="submit" 
                                                class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            
                            <!-- Mobile Navigation -->
                            <div class="py-2">
                                <a href="{{ route('home') }}" 
                                   class="block px-4 py-3 text-sm {{ request()->routeIs('home') ? 'text-red-600 bg-red-50' : 'text-gray-700 hover:bg-red-50 hover:text-red-600' }} transition-colors duration-200">
                                    <div class="font-medium">Home</div>
                                </a>
                                
                                <!-- Articles Section -->
                                <div class="px-4 py-2">
                                    <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Articles</div>
                                    <a href="{{ route('articles.index') }}" 
                                       class="block px-3 py-2 text-sm {{ request()->routeIs('articles.index') ? 'text-red-600 bg-red-50' : 'text-gray-700 hover:bg-red-50 hover:text-red-600' }} rounded transition-colors duration-200">
                                        All Articles
                                    </a>
                                    <a href="{{ route('articles.trending') }}" 
                                       class="block px-3 py-2 text-sm {{ request()->routeIs('articles.trending') ? 'text-red-600 bg-red-50' : 'text-gray-700 hover:bg-red-50 hover:text-red-600' }} rounded transition-colors duration-200">
                                        Trending
                                    </a>
                                </div>
                                
                                <!-- Categories Section -->
                                <div class="px-4 py-2">
                                    <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Categories</div>
                                    <a href="{{ route('categories.index') }}" 
                                       class="block px-3 py-2 text-sm {{ request()->routeIs('categories.index') ? 'text-red-600 bg-red-50' : 'text-gray-700 hover:bg-red-50 hover:text-red-600' }} rounded transition-colors duration-200">
                                        All Categories
                                    </a>
                                    
                                    @php
                                        $mobileCategories = \App\Models\Category::take(4)->get();
                                    @endphp
                                    
                                    @foreach($mobileCategories as $category)
                                        <a href="{{ route('categories.show', $category->slug) }}" 
                                           class="block px-3 py-2 text-sm {{ request()->is('categories/' . $category->slug) ? 'text-red-600 bg-red-50' : 'text-gray-700 hover:bg-red-50 hover:text-red-600' }} rounded transition-colors duration-200">
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                </div>
                                
                                <!-- Authors Section -->
                                <div class="px-4 py-2">
                                    <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Authors</div>
                                    <a href="{{ route('authors.index') }}" 
                                       class="block px-3 py-2 text-sm {{ request()->routeIs('authors.index') ? 'text-red-600 bg-red-50' : 'text-gray-700 hover:bg-red-50 hover:text-red-600' }} rounded transition-colors duration-200">
                                        All Authors
                                    </a>
                                    <a href="{{ route('authors.apply') }}" 
                                       class="block px-3 py-2 text-sm {{ request()->routeIs('authors.apply') ? 'text-red-600 bg-red-50' : 'text-gray-700 hover:bg-red-50 hover:text-red-600' }} rounded transition-colors duration-200">
                                        Apply as Author
                                    </a>
                                </div> 
                                
                                <!-- About -->
                                {{-- <a href="{{ route('about') }}" 
                                   class="block px-4 py-3 text-sm {{ request()->routeIs('about') ? 'text-red-600 bg-red-50' : 'text-gray-700 hover:bg-red-50 hover:text-red-600' }} transition-colors duration-200">
                                    <div class="font-medium">About</div>
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Section: Quick Category Access (Mobile scroll) -->
    <div class="bg-gray-50/50 lg:hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="py-3">
                <div class="flex space-x-3 overflow-x-auto scrollbar-hide pb-2">
                    <a href="{{ route('home') }}" 
                       class="flex-shrink-0 px-4 py-2 text-sm font-medium {{ request()->routeIs('home') ? 'bg-red-600 text-white' : 'bg-white text-gray-700 hover:bg-red-50 hover:text-red-600' }} rounded-full border border-gray-200 transition-colors duration-200">
                        Home
                    </a>
                    
                    <a href="{{ route('articles.trending') }}" 
                       class="flex-shrink-0 px-4 py-2 text-sm font-medium {{ request()->routeIs('articles.trending') ? 'bg-red-600 text-white' : 'bg-white text-gray-700 hover:bg-red-50 hover:text-red-600' }} rounded-full border border-gray-200 transition-colors duration-200">
                        Trending
                    </a>
                    
                    @php
                        $quickCategories = \App\Models\Category::take(6)->get();
                    @endphp
                    
                    @foreach($quickCategories as $category)
                        <a href="{{ route('categories.show', $category->slug) }}" 
                           class="flex-shrink-0 px-4 py-2 text-sm font-medium {{ request()->is('categories/' . $category->slug) ? 'bg-red-600 text-white' : 'bg-white text-gray-700 hover:bg-red-50 hover:text-red-600' }} rounded-full border border-gray-200 transition-colors duration-200">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</header>

<style>
/* Custom scrollbar for mobile category scroll */
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
</style>