@extends('layout.master')

@section('content')
<div class="container">
    <h1>Buat Konsultasi Baru</h1>
    <form action="{{ route('konsultasi.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="pakar_id">Pilih Pakar</label>
            <select name="pakar_id" id="pakar_id" class="form-control" required>
                @foreach($pakars as $pakar)
                <option value="{{ $pakar->id }}">{{ $pakar->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Buat Konsultasi</button>
    </form>
</div>
@endsection
