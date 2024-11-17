@extends('admin.layouts.app')

@section('title', 'Tambah Guide Book')
@section('header', 'Tambah Guide Book Baru')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6">
        <form action="{{ route('admin.guide-books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-6">
                <!-- Judul -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" name="title" id="title" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="category_id" id="category_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konten -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">Konten</label>
                    <textarea name="content" id="content" rows="10" required
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gambar -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Gambar</label>
                    <input type="file" name="image" id="image" accept="image/*"
                           class="mt-1 block w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-md file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-blue-50 file:text-blue-700
                                  hover:file:bg-blue-100">
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Video -->
                <div>
                    <label for="video" class="block text-sm font-medium text-gray-700">Video</label>
                    <input type="file" name="video" id="video" accept="video/*"
                           class="mt-1 block w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-md file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-blue-50 file:text-blue-700
                                  hover:file:bg-blue-100">
                    @error('video')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.guide-books.index') }}" 
                       class="px-4 py-2 text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/5/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#content',
        height: 400,
        plugins: 'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste code help wordcount',
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help'
    });
</script>
@endpush
@endsection 