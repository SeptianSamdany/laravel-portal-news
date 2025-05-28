<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600|poppins:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
            .auth-input:focus {
                box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.2);
            }
            .auth-button {
                transition: all 0.3s ease;
            }
            .auth-button:hover {
                transform: translateY(-2px);
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <!-- Two Column Layout -->
        <div class="min-h-screen flex">
            <!-- Left Section - Login Form -->
            <div class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-20 xl:px-24">
                <div class="mx-auto w-full max-w-sm lg:w-96">
                    {{ $slot }}
                </div>
            </div>

            <!-- Right Section - NewsHub Profile -->
            <div class="hidden lg:flex lg:flex-1 bg-gradient-to-br from-red-50 to-red-100">
                <div class="flex flex-col justify-center items-center px-12 py-12 w-full">
                    <!-- NewsHub Logo -->
                    <div class="text-center mb-8">
                        <div class="font-bold text-5xl mb-4 tracking-tight">
                            <span class="text-gray-800">News</span><span class="text-red-600">Hub</span>
                        </div>
                        <div class="w-24 h-1 bg-red-600 mx-auto mb-6"></div>
                    </div>

                    <!-- Mission Statement -->
                    <div class="text-center mb-12 max-w-md">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">
                            Sumber Berita Terpercaya
                        </h2>
                        <p class="text-gray-600 leading-relaxed">
                            Dapatkan berita terkini, analisis mendalam, dan cerita yang relevan dengan kehidupan Anda. 
                            NewsHub hadir untuk memberikan informasi akurat dan terpercaya.
                        </p>
                    </div>

                    <!-- Features List -->
                    <div class="space-y-6 mb-12">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 w-10 h-10 bg-red-600 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">Berita Real-time</h3>
                                <p class="text-sm text-gray-600">Update berita setiap detik dari seluruh dunia</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 w-10 h-10 bg-red-600 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">Analisis Mendalam</h3>
                                <p class="text-sm text-gray-600">Penjelasan komprehensif dari para ahli</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 w-10 h-10 bg-red-600 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">Multi Platform</h3>
                                <p class="text-sm text-gray-600">Akses dari web, mobile, dan tablet</p>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="grid grid-cols-3 gap-8 text-center">
                        <div>
                            <div class="text-2xl font-bold text-red-600">10K+</div>
                            <div class="text-sm text-gray-600">Pembaca Aktif</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-red-600">500+</div>
                            <div class="text-sm text-gray-600">Berita Harian</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-red-600">24/7</div>
                            <div class="text-sm text-gray-600">Live Update</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>