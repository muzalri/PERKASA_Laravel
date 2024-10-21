@extends('layout.master')

@section('title', $komunitas->title)

@section('content')

<body class="bg-gray-50 font-sans">
    <div class="container mx-auto px-6 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-6 mb-8">
            <h1 class="text-4xl font-bold text-gray-800">{{ $komunitas->title }}</h1>
            @can('update', $komunitas)
                <div class="flex space-x-3">
                    <a href="{{ route('komunitas.edit', $komunitas) }}" class="bg-yellow-400 text-white px-4 py-2 rounded-lg shadow-sm hover:bg-yellow-500 transition duration-200">Edit</a>
                    <form action="{{ route('komunitas.destroy', $komunitas) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow-sm hover:bg-red-600 transition duration-200">Hapus</button>
                    </form>
                </div>
            @endcan
        </div>

        <!-- Info Kategori dan Penulis -->
        <p class="text-sm text-gray-500 mb-6">
            Kategori: <span class="font-semibold text-gray-700">{{ $komunitas->category ? $komunitas->category->name : 'Tidak Ditentukan' }}</span> |
            Ditulis oleh: <span class="font-semibold text-gray-700">{{ $komunitas->user->name }}</span> |
            <span>{{ $komunitas->created_at->diffForHumans() }}</span>
        </p>

        <!-- Konten Utama -->
        <div class="prose prose-lg max-w-none text-gray-700 mb-10 leading-relaxed">
            {!! nl2br(e($komunitas->body)) !!}
        </div>

        <!-- Like & Dislike Section -->
        <div class="flex items-center space-x-4 mb-10">
            @auth
                <button id="like-button" class="flex items-center px-4 py-2 border border-blue-500 text-blue-500 rounded-full hover:bg-blue-500 hover:text-white transition ease-in-out duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 9l-6 6M9 14l6-6" />
                    </svg>
                    <span id="likes-count">{{ $komunitas->likesCount() }}</span>
                </button>
                <button id="dislike-button" class="flex items-center px-4 py-2 border border-gray-400 text-gray-500 rounded-full hover:bg-gray-400 hover:text-white transition ease-in-out duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l6-6M14 9l-6 6" />
                    </svg>
                    <span id="dislikes-count">{{ $komunitas->dislikesCount() }}</span>
                </button>
            @else
                <p class="text-gray-600">Silakan <a href="{{ route('login') }}" class="text-blue-500 underline hover:text-blue-700">login</a> untuk memberikan like atau dislike.</p>
            @endauth
        </div>

        <!-- Bagian Komentar -->
        <div class="mb-12">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Komentar</h3>

            @auth
                <form action="{{ route('komunitas.komentar.store', $komunitas) }}" method="POST" class="mb-6">
                    @csrf
                    <div class="mb-4">
                        <label for="body" class="block text-gray-700 text-sm mb-2">Tulis Komentar</label>
                        <textarea class="w-full p-4 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('body') border-red-500 @enderror" id="body" name="body" rows="4" required>{{ old('body') }}</textarea>
                        @error('body')
                        <div class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition ease-in-out duration-200">Kirim Komentar</button>
                </form>
            @endauth

            <!-- Daftar Komentar -->
            @if($komunitas->komentars->count())
                @foreach($komunitas->komentars as $komentar)
                    <div class="bg-white p-6 rounded-lg shadow mb-6">
                        <h5 class="font-semibold text-gray-900">{{ $komentar->user->name }}</h5>
                        <p class="text-sm text-gray-500 mb-2">{{ $komentar->created_at->diffForHumans() }}</p>
                        <p class="text-gray-700">{{ $komentar->body }}</p>
                        @if(Auth::check() && (Auth::id() === $komentar->user_id || Auth::id() === $komunitas->user_id))
                            <form action="{{ route('komentar.destroy', $komentar) }}" method="POST" class="mt-4" onsubmit="return confirm('Apakah Anda yakin ingin menghapus komentar ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 text-sm hover:underline">Hapus</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            @else
                <p class="text-gray-600">Belum ada komentar. Jadilah yang pertama untuk mengomentari!</p>
            @endif
        </div>
    </div>

    {{-- Script Like/Dislike --}}
    @auth
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const likeButton = document.getElementById('like-button');
            const dislikeButton = document.getElementById('dislike-button');
            const likesCount = document.getElementById('likes-count');
            const dislikesCount = document.getElementById('dislikes-count');

            likeButton.addEventListener('click', function () {
                toggleLike(true);
            });

            dislikeButton.addEventListener('click', function () {
                toggleLike(false);
            });

            function toggleLike(isLike) {
                fetch("{{ route('komunitas.toggleLike', $komunitas) }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ is_like: isLike })
                })
                .then(response => response.json())
                .then(data => {
                    if(data.status === 'success') {
                        likesCount.textContent = data.likes_count;
                        dislikesCount.textContent = data.dislikes_count;
                    } else {
                        alert('Terjadi kesalahan.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan.');
                });
            }
        });
    </script>
    @endauth
@endsection
