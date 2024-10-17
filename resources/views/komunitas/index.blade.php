@extends('layout.master')

@section('title', 'Daftar Komunitas')

@section('content')
<div class="article-list" style="display: flex; justify-content: space-between; align-items: center; padding-left: 50px; padding-right: 50px; margin-bottom: 20px; font-family: 'Montserrat', sans-serif">
    <h1>Daftar Artikel</h1>
    <a href="{{ route('komunitas.create') }}" class="underline-btn" >Buat Artikel Baru</a>
</div>

@if($komunitas->count())
    @foreach($komunitas as $item)
        <div class="card mb-3" style="padding-left: 50px; padding-right: 50px;">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="{{ route('komunitas.show', $item) }}">{{ $item->title }}</a>
                </h5>
                <h6 class="card-subtitle mb-2 text-muted">
                    Kategori: {{ $item->category->name }} | Ditulis oleh: {{ $item->user->name }} | {{ $item->created_at->diffForHumans() }}
                </h6>
                <p class="card-text">{{ Str::limit($item->body, 150) }}</p>
                <a href="{{ route('komunitas.show', $item) }}" class="card-link">Baca Selengkapnya</a>
            </div>
        </div>
    @endforeach

    <!-- Pagination Links -->
    {{ $komunitas->links() }}
    @else
        <p style="font-size: 18px; color: red; text-align: center; margin-top: 20px;">
            Belum ada artikel. <a href="{{ route('komunitas.create') }}">Buat artikel pertama!</a>
        </p>
    @endif

@endsection
