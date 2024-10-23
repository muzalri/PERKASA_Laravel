@extends('layout.master')

@section('content')
<div class="container">
    <h1>{{ $guideBook->title }}</h1>
    <p>Kategori: {{ $guideBook->category }}</p>
    <div>
        {!! $guideBook->content !!}
    </div>
    <a href="{{ route('guide_books.index') }}">Kembali ke daftar panduan</a>
</div>
@endsection
