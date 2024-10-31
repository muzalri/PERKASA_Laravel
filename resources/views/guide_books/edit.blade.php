@extends('layout.master')

@section('content')
<div class="container">
    <h1>Edit Guide Book</h1>
    <form action="{{ route('guide-books.update', $guideBook) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $guideBook->title }}" required>
        </div>
        <div class="form-group">
            <label for="category">Kategori</label>
            <input type="text" class="form-control" id="category" name="category" value="{{ $guideBook->category }}" required>
        </div>
        <div class="form-group">
            <label for="content">Konten</label>
            <textarea class="form-control" id="content" name="content" rows="5" required>{{ $guideBook->content }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Gambar</label>
            <input type="file" class="form-control-file" id="image" name="image">
            @if($guideBook->image_path)
                <img src="{{ asset('storage/' . $guideBook->image_path) }}" alt="{{ $guideBook->title }}" class="img-thumbnail mt-2" style="max-width: 200px;">
            @endif
        </div>
        <div class="form-group">
            <label for="video">Video</label>
            <input type="file" class="form-control-file" id="video" name="video">
            @if($guideBook->video_path)
                <video width="320" height="240" controls class="mt-2">
                    <source src="{{ asset('storage/' . $guideBook->video_path) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>
@endsection
