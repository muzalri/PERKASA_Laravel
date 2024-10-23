@extends('layout.master')

@section('content')
<div class="container">
    <h1>Panduan Peternak Ikan</h1>
    <ul>
        @foreach($guideBooks as $guideBook)
            <li><a href="{{ route('guide_books.show', $guideBook->id) }}">{{ $guideBook->title }}</a></li>
        @endforeach
    </ul>
    @if(auth()->check() && auth()->user()->isPakar())
        <a href="{{ route('guide_books.create') }}" class="btn btn-primary">Tambah Panduan Baru</a>
    @endif
</div>
@endsection
