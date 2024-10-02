<!-- resources/views/komunitas/edit.blade.php -->

@extends('layout.master')

@section('title', 'Edit Artikel')

@section('content')
<h1>Edit Artikel</h1>

<form action="{{ route('komunitas.update', $komunitas) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="title" class="form-label">Judul</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
            value="{{ old('title', $komunitas->title) }}" required>
        @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="komunitas_category_id" class="form-label">Kategori</label>
        <select class="form-select @error('komunitas_category_id') is-invalid @enderror" id="komunitas_category_id" name="komunitas_category_id" required>
            <option value="">Pilih Kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ (old('komunitas_category_id', $komunitas->komunitas_category_id) == $category->id) ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('komunitas_category_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="body" class="form-label">Isi Artikel</label>
        <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="5" required>{{ old('body', $komunitas->body) }}</textarea>
        @error('body')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Perbarui Artikel</button>
</form>
@endsection
