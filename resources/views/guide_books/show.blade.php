@extends('layout.master')

@section('content')
<div class="container">
    <h1>{{ $guideBook->title }}</h1>
    <p>Kategori: {{ $guideBook->category }}</p>
    <div>
        {!! $guideBook->content !!}
    </div>
    @if(auth()->check() && auth()->user()->isPakar())
        <a href="{{ route('guide_books.edit', $guideBook->id) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('guide_books.destroy', $guideBook->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus panduan ini?')">Hapus</button>
        </form>
    @endif
    <a href="{{ route('guide_books.index') }}">Kembali ke daftar panduan</a>
</div>
@endsection
