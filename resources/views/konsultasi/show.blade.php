@extends('layout.master')

@section('content')
<div class="container">
    <h1>{{ $konsultasi->judul }}</h1>
    <p>Pengguna: {{ $konsultasi->user->name }}</p>
    <p>Pakar: {{ $konsultasi->pakar->name }}</p>
    <p>Status: {{ $konsultasi->status }}</p>

    <div class="chat-messages">
        @if($konsultasi->pesans && $konsultasi->pesans->count() > 0)
            @foreach($konsultasi->pesans->sortBy('created_at') as $pesan)
                <div class="card mb-3 {{ $pesan->user_id == auth()->id() ? 'ml-auto' : 'mr-auto' }}" style="max-width: 70%;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $pesan->user->name }}</h5>
                        <p class="card-text">{{ $pesan->isi }}</p>
                        @if ($pesan->gambar)
                            <img src="{{ asset('storage/' . $pesan->gambar) }}" class="img-fluid" alt="Gambar Pesan">
                        @endif
                        <p class="card-text"><small class="text-muted">{{ $pesan->created_at->diffForHumans() }}</small></p>
                    </div>
                </div>
            @endforeach
        @else
            <p>Belum ada pesan dalam konsultasi ini.</p>
        @endif
    </div>

    <form action="{{ route('pesan.store', $konsultasi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <textarea name="isi" class="form-control" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <input type="file" name="gambar" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Kirim Pesan</button>
    </form>
</div>
@endsection


