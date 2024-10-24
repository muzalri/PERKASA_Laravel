@extends('layout.master')

@section('content')
<div class="container">
    <h1>{{ $guideBook->title }}</h1>
    <p>Kategori: {{ $guideBook->category }}</p>
    @if($guideBook->image_path)
        <img src="{{ asset('storage/' . $guideBook->image_path) }}" alt="{{ $guideBook->title }}" class="img-fluid mb-3">
    @endif
    @if($guideBook->video_path)
        <video width="320" height="240" controls class="mb-3">
            <source src="{{ asset('storage/' . $guideBook->video_path) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    @endif
    <div>
        {!! $guideBook->content !!}
    </div>
    <a href="{{ route('guide-books.index') }}">Kembali ke daftar panduan</a>
</div>
@endsection
