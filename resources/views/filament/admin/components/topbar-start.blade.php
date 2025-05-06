{{-- File: resources/views/filament/components/topbar-start.blade.php --}}
@php
    $user = auth()->user();
@endphp

<div class="flex items-center space-x-4">
    @if($user && !$user->hasRole('Writer'))
        <a href="{{ url('admin/articles/create') }}" class="px-3 py-2 text-sm bg-primary-500 text-white rounded-lg hover:bg-primary-600 flex items-center">
            <x-heroicon-o-plus-circle class="w-4 h-4 mr-1" />
            Artikel Baru
        </a>
    @endif
</div>

{{-- File: resources/views/filament/components/topbar-end.blade.php --}}
<div class="flex items-center space-x-4">
    <div class="hidden lg:flex items-center space-x-2">
        <span class="text-sm">
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </span>
    </div>
    
    {{-- Tambahkan notifikasi jika diperlukan --}}
    <div class="relative">
        <button type="button" class="flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-500/5 focus:outline-none">
            <span class="sr-only">Notifikasi</span>
            <x-heroicon-o-bell class="w-5 h-5" />
            
            <span class="absolute top-0 right-0 h-4 w-4 rounded-full bg-danger-500 flex items-center justify-center text-xs text-white">
                0
            </span>
        </button>
    </div>

    {{-- Tombol bantuan cepat --}}
    <a href="https://filamentphp.com/docs" target="_blank" class="flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-500/5 focus:outline-none">
        <span class="sr-only">Bantuan</span>
        <x-heroicon-o-question-mark-circle class="w-5 h-5" />
    </a>
</div>