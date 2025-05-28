@extends('layouts.standard')

@section('title', 'Tentang Kami - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-white">
    <!-- Page Header -->
    <div class="bg-white border-b-2 border-red-500 py-12 mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                <span class="text-black">Tentang</span> <span class="text-black">News</span><span class="text-red-500">Hub</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto">
                Platform berita terpercaya yang menghadirkan informasi berkualitas untuk masyarakat Indonesia
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        <!-- Company Overview -->
        <div class="mb-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Siapa Kami</h2>
                    <div class="space-y-4 text-gray-600 leading-relaxed">
                        <p>
                            <strong class="text-gray-900">NewsHub</strong> adalah platform media digital yang berkomitmen untuk menyajikan berita dan informasi terkini dengan standar jurnalisme yang tinggi. Sejak didirikan pada tahun 2020, kami telah menjadi sumber informasi terpercaya bagi jutaan pembaca di seluruh Indonesia.
                        </p>
                        <p>
                            Dengan tim redaksi berpengalaman dan jaringan koresponden di berbagai daerah, kami menghadirkan liputan yang mendalam, akurat, dan berimbang dari berbagai sektor kehidupan masyarakat.
                        </p>
                        <p>
                            Kami percaya bahwa informasi yang berkualitas adalah hak setiap warga negara, dan melalui platform digital yang mudah diakses, kami berusaha menjembatani kebutuhan masyarakat akan berita yang dapat dipercaya.
                        </p>
                    </div>
                </div>
                <div class="lg:order-first">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2340&q=80" 
                             alt="NewsHub Office" 
                             class="rounded-lg shadow-lg w-full h-80 object-cover">
                        <div class="absolute inset-0 bg-red-600/10 rounded-lg"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mission & Vision -->
        <div class="mb-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-red-50 rounded-lg p-8">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-red-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 ml-4">Visi Kami</h3>
                    </div>
                    <p class="text-gray-700 leading-relaxed">
                        Menjadi platform media digital terdepan di Indonesia yang menyajikan informasi berkualitas tinggi, 
                        terpercaya, dan dapat diakses oleh seluruh lapisan masyarakat untuk mencerdaskan bangsa.
                    </p>
                </div>

                <div class="bg-red-50 rounded-lg p-8">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-red-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 ml-4">Misi Kami</h3>
                    </div>
                    <ul class="text-gray-700 space-y-2">
                        <li>• Menyajikan berita yang akurat, berimbang, dan dapat dipertanggungjawabkan</li>
                        <li>• Mendorong transparansi dan akuntabilitas dalam kehidupan berbangsa</li>
                        <li>• Memberikan platform diskusi yang sehat bagi masyarakat</li>
                        <li>• Mendukung literasi digital dan media di Indonesia</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Values -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Nilai-Nilai Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Integritas</h3>
                    <p class="text-gray-600">
                        Kami berkomitmen untuk menyajikan berita dengan kejujuran, transparansi, dan tanggung jawab penuh.
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Kecepatan</h3>
                    <p class="text-gray-600">
                        Menghadirkan informasi terkini dengan cepat tanpa mengorbankan keakuratan dan kualitas berita.
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Kolaborasi</h3>
                    <p class="text-gray-600">
                        Membangun kemitraan yang kuat dengan berbagai pihak untuk menghadirkan berita yang komprehensif.
                    </p>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="mb-16 bg-gray-50 rounded-lg p-8">
            <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">NewsHub dalam Angka</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-red-600 mb-2">5M+</div>
                    <div class="text-gray-600">Pembaca Aktif</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-red-600 mb-2">50K+</div>
                    <div class="text-gray-600">Artikel Terbit</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-red-600 mb-2">34</div>
                    <div class="text-gray-600">Provinsi Terjangkau</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-red-600 mb-2">24/7</div>
                    <div class="text-gray-600">Layanan Berita</div>
                </div>
            </div>
        </div>

        <!-- Team Section -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Tim Redaksi</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-32 h-32 mx-auto mb-4 overflow-hidden rounded-full">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=387&q=80
                        " 
                             alt="Dr. Ahmad Wijaya" 
                             class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Dr. Ahmad Wijaya</h3>
                    <p class="text-red-600 mb-2">Pemimpin Redaksi</p>
                    <p class="text-gray-600 text-sm">
                        Berpengalaman 15+ tahun di dunia jurnalistik dan pernah menjadi koresponden untuk media internasional.
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-32 h-32 mx-auto mb-4 overflow-hidden rounded-full">
                        <img src="https://instapay.id/blog/wp-content/uploads/2023/11/ceo-adalah.jpg" 
                             alt="Sarah Indira" 
                             class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Sarah Indira, M.Kom</h3>
                    <p class="text-red-600 mb-2">Kepala Teknologi</p>
                    <p class="text-gray-600 text-sm">
                        Ahli teknologi informasi yang memimpin pengembangan platform digital NewsHub dengan inovasi terdepan.
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-32 h-32 mx-auto mb-4 overflow-hidden rounded-full">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=387&q=80" 
                             alt="Rizky Pratama" 
                             class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Rizky Pratama</h3>
                    <p class="text-red-600 mb-2">Editor Senior</p>
                    <p class="text-gray-600 text-sm">
                        Jurnalis berpengalaman dengan spesialisasi liputan politik dan ekonomi nasional.
                    </p>
                </div>
            </div>
        </div>

        <!-- Awards & Recognition -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Penghargaan & Pengakuan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Media Digital Terbaik 2023</h3>
                    <p class="text-gray-600 text-sm">Penghargaan dari Asosiasi Media Digital Indonesia</p>
                </div>

                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Sertifikat ISO 27001</h3>
                    <p class="text-gray-600 text-sm">Standar keamanan informasi internasional</p>
                </div>

                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Verifikasi Dewan Pers</h3>
                    <p class="text-gray-600 text-sm">Media terverifikasi resmi oleh Dewan Pers Indonesia</p>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="bg-red-50 rounded-lg p-8">
            <h2 class="text-3xl font-bold text-gray-900 text-center mb-8">Hubungi Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-12 h-12 bg-red-600 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Alamat</h3>
                    <p class="text-gray-600">
                        Jl. Merdeka Raya No. 123<br>
                        Jakarta Pusat 10110<br>
                        Indonesia
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-12 h-12 bg-red-600 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M3 8l7.89 7.89a2 2 0 002.83 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Email</h3>
                    <p class="text-gray-600">
                        redaksi@newshub.id<br>
                        info@newshub.id<br>
                        iklan@newshub.id
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-12 h-12 bg-red-600 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Telepon</h3>
                    <p class="text-gray-600">
                        +62 21 1234-5678<br>
                        +62 21 8765-4321<br>
                        Hotline: 0800-NEWS-HUB
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection