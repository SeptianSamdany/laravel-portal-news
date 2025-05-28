{{-- resources/views/layouts/standard.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
   
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('meta_description', 'Portal berita terkini dan terpercaya.')">
    <meta name="keywords" content="@yield('meta_keywords', 'berita, news, portal, trending')">
    <meta property="og:title" content="@yield('title', config('app.name'))">
    <meta property="og:description" content="@yield('meta_description', 'Portal berita terkini dan terpercaya.')">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('meta_image', asset('default-image.jpg'))">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', config('app.name'))">
    <meta name="twitter:description" content="@yield('meta_description', 'Portal berita terkini dan terpercaya.')">
    <meta name="twitter:image" content="@yield('meta_image', asset('default-image.jpg'))">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-serif antialiased bg-white text-gray-800" x-data="{ mobileMenuOpen: false }">
    <!-- Header -->
    @include('components.header')
    
    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('components.footer')
   
    @stack('scripts')
</body>
</html>