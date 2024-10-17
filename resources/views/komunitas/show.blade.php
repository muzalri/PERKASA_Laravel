<!-- resources/views/komunitas/show.blade.php -->

@extends('layout.master')

@section('title', $komunitas->title)

@section('content')

<body style="background-color: #E0F7F7;">
    <style>
            
    </style>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>{{ $komunitas->title }}</h1>
        @can('update', $komunitas)
            <div>
                <a href="{{ route('komunitas.edit', $komunitas) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('komunitas.destroy', $komunitas) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        @endcan
    </div>

    <p class="text-muted">
        Kategori: {{ $komunitas->category ? $komunitas->category->name : 'Tidak Ditentukan' }} |
        Ditulis oleh: {{ $komunitas->user->name }} |
        {{ $komunitas->created_at->diffForHumans() }}
    </p>

    <div class="mb-4">
        {!! nl2br(e($komunitas->body)) !!}
    </div>

    <div class="d-flex align-items-center mb-4">
        @auth
            <button id="like-button" class="btn btn-outline-primary me-2">
                Like <span id="likes-count">{{ $komunitas->likesCount() }}</span>
            </button>
            <button id="dislike-button" class="btn btn-outline-secondary">
                Dislike <span id="dislikes-count">{{ $komunitas->dislikesCount() }}</span>
            </button>
        @else
            <p>Silakan <a href="{{ route('login') }}">login</a> untuk memberikan like atau dislike.</p>
        @endauth
    </div>

    {{-- Bagian Komentar --}}
    <div class="mb-5">
        <h3>Komentar</h3>

        {{-- Formulir Menambahkan Komentar --}}
        @auth
            <form action="{{ route('komunitas.komentar.store', $komunitas) }}" method="POST" class="mb-4">
                @csrf
                <div class="mb-3">
                    <label for="body" class="form-label">Tulis Komentar</label>
                    <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="3" required>{{ old('body') }}</textarea>
                    @error('body')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary" style="background-color: #007bff">Kirim Komentar</button>
            </form>
        @endauth

        {{-- Menampilkan Daftar Komentar --}}
        @if($komunitas->komentars->count())
            @foreach($komunitas->komentars as $komentar)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $komentar->user->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $komentar->created_at->diffForHumans() }}</h6>
                        <p class="card-text">{{ $komentar->body }}</p>
                        @if(Auth::check() && (Auth::id() === $komentar->user_id || Auth::id() === $komunitas->user_id))
                            <form action="{{ route('komentar.destroy', $komentar) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus komentar ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <p>Belum ada komentar. Jadilah yang pertama untuk mengomentari!</p>
        @endif
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
