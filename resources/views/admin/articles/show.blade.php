@extends('admin.layouts.app')

@section('title', $article->title)

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6">
        <!-- Header Artikel -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">{{ $article->title }}</h1>
            <div class="mt-2 text-gray-600">
                <span>Oleh: {{ $article->user->name }}</span> |
                <span>Kategori: {{ $article->category->name }}</span> |
                <span>{{ $article->created_at->format('d M Y H:i') }}</span>
            </div>
        </div>

        <!-- Gambar Artikel (jika ada) -->
        @if($article->image)
        <div class="mb-6">
            <img src="{{ asset('imagedb/komunitas/' . $article->image) }}" 
                 alt="Gambar artikel" 
                 class="max-w-full h-auto rounded-lg shadow-sm">
        </div>
        @endif

        <!-- Konten Artikel -->
        <div class="prose max-w-none mb-8">
            {!! nl2br(e($article->body)) !!}
        </div>

        <!-- Statistik -->
        <div class="flex items-center space-x-4 text-gray-600 mb-8">
            <span><i class="fas fa-heart text-red-500"></i> {{ $article->likes->count() }} Suka</span>
            <span><i class="fas fa-comment text-blue-500"></i> {{ $article->komentars->count() }} Komentar</span>
        </div>

        <!-- Daftar Komentar -->
        <div class="mt-8">
            <h3 class="text-lg font-semibold mb-4">Komentar ({{ $article->komentars->count() }})</h3>
            @foreach($article->komentars as $komentar)
            <div class="bg-gray-50 p-4 rounded-lg mb-4">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-semibold">{{ $komentar->user->name }}</p>
                        <p class="text-sm text-gray-600">{{ $komentar->created_at->format('d/m/Y H:i') }}</p>
                        <p class="mt-2">{{ $komentar->content }}</p>
                    </div>
                    <form action="{{ route('admin.articles.comments.destroy', [$article->id, $komentar->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900"
                                onclick="return confirm('Yakin ingin menghapus komentar ini?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-6">
            <a href="{{ route('admin.articles.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Daftar Artikel
            </a>
        </div>
    </div>
</div>
@endsection 