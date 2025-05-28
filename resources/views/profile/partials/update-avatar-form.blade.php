{{-- resources/views/profile/partials/update-avatar-form.blade.php --}}
<form method="POST" action="{{ route('profile.update-avatar') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="avatar" class="block text-sm font-medium text-gray-700">
            {{ __('Upload Avatar') }}
        </label>
        <img src="{{ auth()->user()->avatar_url }}" alt="Avatar" class="w-24 h-24 rounded-full">
        <input type="file" name="avatar" id="avatar" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        @error('avatar')
            <span class="text-sm text-red-600">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>{{ __('Save') }}</x-primary-button>
    </div>
</form>