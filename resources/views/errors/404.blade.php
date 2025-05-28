{{-- filepath: resources/views/errors/404.blade.php --}}
@extends('layouts.standard')

@section('title', '404 Not Found')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-white">
    <div class="text-center">
        <h1 class="text-7xl font-extrabold text-red-600 mb-4">404</h1>
        <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-2">Halaman Tidak Ditemukan</h2>
        <p class="text-gray-600 mb-6">
            Maaf, halaman yang Anda cari tidak tersedia atau sudah dipindahkan.
        </p>
        <a href="{{ url('/') }}" class="inline-block px-6 py-3 bg-red-600 text-white rounded-md font-medium hover:bg-red-700 transition-colors">
            Kembali ke Beranda
        </a>
    </div>
</div>
@endsection