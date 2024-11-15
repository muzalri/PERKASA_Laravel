<!-- resources/views/komunitas/create.blade.php -->

@extends('layout.master')

@section('title', 'Buat Artikel Baru')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Buat Artikel Baru</h1>
            <p class="text-gray-600">Bagikan pengetahuan Anda dengan komunitas</p>
        </div>

        <form action="{{ route('komunitas.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Judul -->
            <div class="space-y-2">
                <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror" 
                       id="title" 
                       name="title"
                       value="{{ old('title') }}" 
                       required
                       placeholder="Masukkan judul artikel...">
                @error('title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori -->
            <div class="space-y-2">
                <label for="komunitas_category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('komunitas_category_id') border-red-500 @enderror" 
                        id="komunitas_category_id" 
                        name="komunitas_category_id" 
                        required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('komunitas_category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('komunitas_category_id')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Isi Artikel -->
            <div class="space-y-2">
                <label for="body" class="block text-sm font-medium text-gray-700">Isi Artikel</label>
                <div class="relative">
                    <textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent min-h-[200px] @error('body') border-red-500 @enderror" 
                              id="body" 
                              name="body" 
                              required
                              placeholder="Tulis artikel Anda di sini...">{{ old('body') }}</textarea>
                    <div class="absolute bottom-2 right-2 text-sm text-gray-500">
                        <span id="charCount">0</span>/1000
                    </div>
                </div>
                @error('body')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol -->
            <div class="flex space-x-4 pt-6">
                <button type="submit" 
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 flex items-center">
                    <i class="fas fa-paper-plane mr-2"></i>
                    Publikasikan
                </button>
                <a href="{{ route('komunitas') }}" 
                   class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const bodyTextarea = document.getElementById('body');
    const charCount = document.getElementById('charCount');
    const maxLength = 1000;

    function updateCharCount() {
        const length = bodyTextarea.value.length;
        charCount.textContent = length;
        
        if (length > maxLength) {
            charCount.classList.add('text-red-500');
        } else {
            charCount.classList.remove('text-red-500');
        }
    }

    bodyTextarea.addEventListener('input', updateCharCount);
    updateCharCount();
});
</script>
@endpush

@push('styles')
<style>
.form-group label {
    @apply block text-sm font-medium text-gray-700 mb-1;
}

.form-control {
    @apply w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent;
}

.btn {
    @apply px-6 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-200;
}

.btn-primary {
    @apply bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500;
}

.btn-secondary {
    @apply bg-gray-100 text-gray-700 hover:bg-gray-200 focus:ring-gray-500;
}
</style>
@endpush
