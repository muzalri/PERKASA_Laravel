@extends('layout.master')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center">Panduan Peternak Ikan</h1>
    
    <div class="row">
        @foreach($guideBooks as $guideBook)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $guideBook->title }}</h5>
                        <p class="card-text">{{ Str::limit($guideBook->description, 100) }}</p>
                        <a href="{{ route('guide_books.show', $guideBook->id) }}" class="btn btn-primary">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
