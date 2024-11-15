@extends('layout.master')

@section('title', 'Panduan')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header dengan gradasi -->
    <div class="bg-gradient-to-r from-perkasa-blue to-sky-600 py-8 mt-6 rounded-lg mx-4">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-serif font-bold text-white mb-2">Panduan Budidaya</h1>
            <p class="text-sky-100">Pelajari teknik dan tips budidaya ikan dari para ahli</p>
        </div>
    </div>

    <!-- Konten Utama -->
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Tombol Tambah Panduan (untuk admin) -->
        @can('create', 'App\Models\GuideBook')
        <div class="mb-8">
            <a href="{{ route('guide-books.create') }}" 
               class="inline-flex items-center px-6 py-3 bg-yellow-500 text-white font-semibold rounded-lg
                      transform transition duration-200 hover:bg-yellow-600 hover:scale-105 hover:shadow-lg">
                <i class="fas fa-plus-circle mr-2"></i>
                Tambah Panduan Baru
            </a>
        </div>
        @endcan

        <!-- Grid Panduan -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($guideBooks ?? [] as $book)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-book text-2xl text-yellow-500 mr-3"></i>
                            <h3 class="text-xl font-semibold text-gray-800">{{ $book->title }}</h3>
                        </div>
                        <p class="text-gray-600 mb-4">{{ $book->description }}</p>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i class="fas fa-clock mr-2"></i>
                            <span>Durasi Baca: {{ $book->reading_time }} menit</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-user mr-1"></i>{{ $book->author }}
                            </span>
                            <a href="{{ route('guide-books.show', $book) }}" 
                               class="inline-flex items-center text-yellow-600 hover:text-yellow-800">
                                Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-book text-gray-400 text-5xl mb-4"></i>
                    <p class="text-gray-500 text-lg mb-4">Belum ada panduan tersedia.</p>
                    @can('create', 'App\Models\GuideBook')
                    <a href="{{ route('guide-books.create') }}" 
                       class="text-yellow-600 hover:text-yellow-800 font-semibold hover:underline transition-colors">
                        Tambah panduan pertama! <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                    @endcan
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection 