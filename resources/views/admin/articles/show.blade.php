@extends('admin.layouts.app')

@section('title', 'Detail Artikel')
@section('header', 'Detail Artikel')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">{{ $article->title }}</h2>
            <div class="mt-2 text-sm text-gray-600">
                Kategori: {{ $article->category->name }}
            </div>
            <div class="text-sm text-gray-600">
                Penulis: {{ $article->user->name }}
            </div>
            <div class="text-sm text-gray-600">
                Tanggal: {{ $article->created_at->format('d/m/Y H:i') }}
            </div>
        </div>

        <div class="prose max-w-none mb-6">
            {!! $article->body !!}
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

        <div class="flex justify-end space-x-3 mt-6">
            <a href="{{ route('admin.articles.index') }}" 
               class="px-4 py-2 text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                Kembali
            </a>
            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600"
                        onclick="return confirm('Yakin ingin menghapus artikel ini?')">
                    Hapus Artikel
                </button>
            </form>
        </div>
    </div>
</div>
@endsection 