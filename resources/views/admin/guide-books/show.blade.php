@extends('admin.layouts.app')

@section('title', 'Detail Guide Book')
@section('header', 'Detail Guide Book')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">{{ $guideBook->title }}</h2>
            <div class="mt-2 text-sm text-gray-600">
                Kategori: {{ optional($guideBook->category_id)->name ?? 'Tidak ada kategori' }}
            </div>
            <div class="text-sm text-gray-600">
                Penulis: {{ optional($guideBook->user_id)->name ?? 'Tidak ada penulis' }}
            </div>
        </div>

        <div class="prose max-w-none mb-6">
            {!! $guideBook->content !!}
        </div>

        @if($guideBook->image_path)
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">Gambar</h3>
            <img src="{{ asset('imagedb/guide_book/images/' . $guideBook->image_path) }}" 
                 alt="{{ $guideBook->title }}" 
                 class="max-w-xl rounded-lg">
        </div>
        @endif

        @if($guideBook->video_path)
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">Video</h3>
            <video width="640" height="360" controls class="rounded-lg">
                <source src="{{ asset('imagedb/guide_book/videos/' . $guideBook->video_path) }}" type="video/mp4">
                Browser Anda tidak mendukung tag video.
            </video>
        </div>
        @endif

        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.guide-books.index') }}" 
               class="px-4 py-2 text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                Kembali
            </a>
            <a href="{{ route('admin.guide-books.edit', $guideBook) }}" 
               class="px-4 py-2 text-white bg-yellow-500 rounded-md hover:bg-yellow-600">
                Edit
            </a>
            <form action="{{ route('admin.guide-books.destroy', $guideBook) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600"
                        onclick="return confirm('Yakin ingin menghapus guide book ini?')">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
