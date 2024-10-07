@extends('layout.master')

@section('title', 'Daftar Komunitas')

@section('content')
<body style="background-color: #E0F7F7;">
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Daftar Article</h1>
    <a href="{{ route('komunitas.create') }}" class="btn btn-success" style="background-color: #34BCC2">Buat Artikel Baru</a>
</div>

@if($komunitas->count())
    @foreach($komunitas as $item)
        <div class="card mb-3">
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

    {{ $komunitas->links() }}
@else
    <p>Belum ada artikel. <a href="{{ route('komunitas.create') }}">Buat artikel pertama!</a></p>
@endif
@endsection