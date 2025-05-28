@extends('layouts.standard')

@section('title', 'Pasang Iklan - ' . config('app.name'))

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-red-50 via-white to-red-50 py-16 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <svg class="w-full h-full" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="currentColor" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)" />
            </svg>
        </div>
        
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Icon -->
            <div class="inline-flex items-center justify-center w-16 h-16 bg-red-600 rounded-full mb-6">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Pasang <span class="text-red-600">Iklan</span>
            </h1>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                Jangkau jutaan pembaca dengan memasang iklan di platform berita terpercaya kami. 
                Tingkatkan brand awareness dan capai target audiens yang tepat.
            </p>
            
            <!-- Statistics Preview -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-12">
                <div class="bg-white/60 backdrop-blur-sm p-4 rounded-xl border border-gray-200">
                    <div class="text-2xl font-bold text-red-600 mb-1">2M+</div>
                    <div class="text-sm text-gray-600">Pembaca Bulanan</div>
                </div>
                <div class="bg-white/60 backdrop-blur-sm p-4 rounded-xl border border-gray-200">
                    <div class="text-2xl font-bold text-red-600 mb-1">500K+</div>
                    <div class="text-sm text-gray-600">Pengunjung Harian</div>
                </div>
                <div class="bg-white/60 backdrop-blur-sm p-4 rounded-xl border border-gray-200">
                    <div class="text-2xl font-bold text-red-600 mb-1">85%</div>
                    <div class="text-sm text-gray-600">Tingkat Engagement</div>
                </div>
                <div class="bg-white/60 backdrop-blur-sm p-4 rounded-xl border border-gray-200">
                    <div class="text-2xl font-bold text-red-600 mb-1">24/7</div>
                    <div class="text-sm text-gray-600">Layanan Support</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Advertising Packages Section -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Pilihan <span class="text-red-600">Paket Iklan</span>
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Berbagai format iklan dengan harga kompetitif untuk kebutuhan marketing Anda
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Banner Display -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-center w-16 h-16 bg-red-100 rounded-xl mb-6 mx-auto">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 text-center">Banner Display</h3>
                    <p class="text-gray-600 mb-6 text-center">
                        Iklan banner dengan berbagai ukuran strategis di halaman utama dan artikel
                    </p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center text-gray-700">
                            <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Leaderboard (728x90)
                        </li>
                        <li class="flex items-center text-gray-700">
                            <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Rectangle (300x250)
                        </li>
                        <li class="flex items-center text-gray-700">
                            <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Skyscraper (160x600)
                        </li>
                        <li class="flex items-center text-gray-700">
                            <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Laporan performa bulanan
                        </li>
                    </ul>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-red-600 mb-2">Rp 2,5 Juta</div>
                        <div class="text-gray-500">per bulan</div>
                    </div>
                </div>

                <!-- Native Advertising -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 hover:shadow-xl transition-shadow duration-300 relative">
                    <div class="absolute top-6 left-3 bg-red-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        Terpopuler
                    </div>
                    <div class="flex items-center justify-center w-16 h-16 bg-red-100 rounded-xl mb-6 mx-auto">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 text-center">Native Advertising</h3>
                    <p class="text-gray-600 mb-6 text-center">
                        Konten yang terintegrasi natural dengan berita, memberikan engagement tinggi
                    </p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center text-gray-700">
                            <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Artikel sponsor berkualitas
                        </li>
                        <li class="flex items-center text-gray-700">
                            <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Infografis branded
                        </li>
                        <li class="flex items-center text-gray-700">
                            <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Video content marketing
                        </li>
                        <li class="flex items-center text-gray-700">
                            <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            SEO optimization
                        </li>
                    </ul>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-red-600 mb-2">Rp 5 Juta</div>
                        <div class="text-gray-500">per artikel</div>
                    </div>
                </div>

                <!-- Newsletter Sponsorship -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-center w-16 h-16 bg-red-100 rounded-xl mb-6 mx-auto">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 text-center">Newsletter Sponsor</h3>
                    <p class="text-gray-600 mb-6 text-center">
                        Sponsorship eksklusif dalam newsletter mingguan dengan 150K+ subscriber aktif
                    </p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center text-gray-700">
                            <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Header sponsor placement
                        </li>
                        <li class="flex items-center text-gray-700">
                            <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Dedicated section khusus
                        </li>
                        <li class="flex items-center text-gray-700">
                            <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Analytics report detail
                        </li>
                        <li class="flex items-center text-gray-700">
                            <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Custom design template
                        </li>
                    </ul>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-red-600 mb-2">Rp 3 Juta</div>
                        <div class="text-gray-500">per edisi</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Why Choose Us Section -->
    <div class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Mengapa Pilih <span class="text-red-600">NewsHub?</span>
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Platform berita terpercaya dengan audience berkualitas dan engagement tinggi
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="text-center p-6">
                    <div class="flex items-center justify-center w-16 h-16 bg-red-100 rounded-xl mb-6 mx-auto">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Audience Berkualitas</h3>
                    <p class="text-gray-600">
                        Pembaca aktif dengan demografi yang jelas dan engagement tinggi terhadap konten berita dan informasi
                    </p>
                </div>

                <div class="text-center p-6">
                    <div class="flex items-center justify-center w-16 h-16 bg-red-100 rounded-xl mb-6 mx-auto">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Performa Optimal</h3>
                    <p class="text-gray-600">
                        Website dengan loading cepat dan SEO optimal untuk memaksimalkan reach dan visibility iklan Anda
                    </p>
                </div>

                <div class="text-center p-6">
                    <div class="flex items-center justify-center w-16 h-16 bg-red-100 rounded-xl mb-6 mx-auto">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Laporan Transparan</h3>
                    <p class="text-gray-600">
                        Dapatkan laporan detail mengenai performa iklan dengan metrics yang mudah dipahami dan actionable
                    </p>
                </div>

                <div class="text-center p-6">
                    <div class="flex items-center justify-center w-16 h-16 bg-red-100 rounded-xl mb-6 mx-auto">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Harga Kompetitif</h3>
                    <p class="text-gray-600">
                        Paket iklan dengan harga terjangkau dan ROI yang menguntungkan untuk berbagai skala bisnis
                    </p>
                </div>

                <div class="text-center p-6">
                    <div class="flex items-center justify-center w-16 h-16 bg-red-100 rounded-xl mb-6 mx-auto">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M18.364 5.636a9 9 0 010 12.728m0 0l-2.829-2.829m2.829 2.829L21 21M15.536 15.536a9 9 0 01-12.728 0m0 0l2.829-2.829m-2.829 2.829L3 21m12.728-12.728a9 9 0 010 12.728m0 0L12 21m3.536-3.536L12 21m0 0l-3.536-3.536M12 21V9m0 12l-3.536-3.536"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Support Profesional</h3>
                    <p class="text-gray-600">
                        Tim support berpengalaman siap membantu optimalisasi dan konsultasi kampanye iklan Anda
                    </p>
                </div>

                <div class="text-center p-6">
                    <div class="flex items-center justify-center w-16 h-16 bg-red-100 rounded-xl mb-6 mx-auto">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Custom Solution</h3>
                    <p class="text-gray-600">
                        Solusi iklan yang disesuaikan dengan kebutuhan, target audience, dan budget perusahaan Anda
                    </p>
                </div>
            </div>
        </div>
    </div>

   <!-- Contact Advertisement Team Section -->
    <div class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-black mb-4">
                    Hubungi Tim <span class="text-red-600">Advertisement</span>
                </h2>
                <p class="text-lg text-gray-700 max-w-2xl mx-auto">
                    Siap memulai kampanye iklan Anda? Tim profesional kami siap membantu merencanakan strategi terbaik
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Phone Contact -->
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20 text-center hover:bg-white/15 transition-all duration-300">
                    <div class="flex items-center justify-center w-16 h-16 bg-white/20 rounded-xl mb-6 mx-auto">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-black mb-4">Telepon Langsung</h3>
                    <p class="text-gray-600 mb-6">Konsultasi gratis dengan tim advertisement kami</p>
                    <div class="space-y-3 mb-6">
                        <a href="https://wa.me/6281234567890" class="flex items-center justify-center text-red-600 font-bold text-lg hover:text-red-600 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.472-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.863 3.687"/>
                            </svg>
                            +62 812-3456-7890
                        </a>
                    </div>
                    <p class="text-red-600 text-sm">Senin - Jumat: 09:00 - 18:00 WIB</p>
                </div>

                <!-- Email Contact -->
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20 text-center hover:bg-white/15 transition-all duration-300">
                    <div class="flex items-center justify-center w-16 h-16 bg-white/20 rounded-xl mb-6 mx-auto">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-black mb-4">Email Advertisement</h3>
                    <p class="text-gray-600 mb-6">Kirim proposal atau pertanyaan detail Anda</p>
                    <div class="space-y-3 mb-6">
                        <a href="mailto:ads@newshub.com" class="block text-red-600 font-bold text-lg hover:text-red-700 transition-colors">
                            ads@newshub.com
                        </a>
                    </div>
                    <p class="text-red-600 text-sm">Respon dalam 2-4 jam kerja</p>
                </div>

                <!-- Office Address -->
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20 text-center hover:bg-white/15 transition-all duration-300">
                    <div class="flex items-center justify-center w-16 h-16 bg-white/20 rounded-xl mb-6 mx-auto">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-black mb-4">Kunjungi Kantor</h3>
                    <p class="text-gray-600 mb-6">Meeting langsung untuk diskusi mendalam</p>
                    <div class="space-y-2 mb-6">
                        <p class="text-red-600 font-medium">Jl. Sudirman Kav. 52-53</p>
                        <p class="text-red-600 font-medium">Plaza BII Tower 2, Lt. 15</p>
                        <p class="text-red-600 font-medium">Jakarta Selatan 12190</p>
                    </div>
                </div>
            </div>
            
            <!-- Contact Person Section -->
            <div class="mt-16 bg-white">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-black mb-2">Tim Advertisement NewsHub</h3>
                    <p class="text-gray-600">Profesional berpengalaman siap membantu kesuksesan kampanye Anda</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Account Manager -->
                    <div class="text-center">
                        <div class="w-20 h-20 bg-white rounded-full mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-black mb-2">Sarah Wijaya</h4>
                        <p class="text-red-600 text-sm mb-3">Senior Account Manager</p>
                        <p class="text-gray-600 text-sm mb-4">Spesialis dalam strategi digital marketing dan campaign optimization</p>
                        <div class="space-y-2">
                            <a href="mailto:sarah@newshub.com" class="block text-red-600 text-sm hover:text-red-500 transition-colors">
                                sarah@newshub.com
                            </a>
                        </div>
                    </div>

                    <!-- Creative Director -->
                    <div class="text-center">
                        <div class="w-20 h-20 bg-white rounded-full mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-black mb-2">Budi Santoso</h4>
                        <p class="text-red-600 text-sm mb-3">Creative Director</p>
                        <p class="text-gray-600 text-sm mb-4">Ahli dalam pembuatan konten kreatif dan native advertising</p>
                        <div class="space-y-2">
                            <a href="mailto:budi@newshub.com" class="block text-red-600 text-sm hover:text-red-400 transition-colors">
                                budi@newshub.com
                            </a>
                        </div>
                    </div>

                    <!-- Business Development -->
                    <div class="text-center">
                        <div class="w-20 h-20 bg-white rounded-full mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-black mb-2">Maya Putri</h4>
                        <p class="text-red-600 text-sm mb-3">Business Development</p>
                        <p class="text-gray-600 text-sm mb-4">Fokus pada partnership strategis dan custom advertising solutions</p>
                        <div class="space-y-2">
                            <a href="mailto:maya@newshub.com" class="block text-red-600 text-sm hover:text-red-400 transition-colors">
                                maya@newshub.com
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection