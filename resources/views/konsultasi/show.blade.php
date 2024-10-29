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
                <div class="card mb-3 {{ $pesan->user_id == auth()->id() ? 'ml-auto' : 'mr-auto' }}" 
                     style="max-width: 70%;"
                     data-pesan-id="{{ $pesan->id }}"
                     data-user-id="{{ $pesan->user_id }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">{{ $pesan->user->name }}</h5>
                            <span class="badge status-badge 
                                {{ $pesan->status === 'belum_dibaca' ? 'bg-danger' : 
                                   ($pesan->status === 'dibaca' ? 'bg-warning' : 'bg-success') }}">
                                {{ ucfirst($pesan->status) }}
                            </span>
                        </div>
                        <p class="card-text">{{ $pesan->isi }}</p>
                        @if ($pesan->gambar)
                            <img src="{{ asset('storage/' . $pesan->gambar) }}" class="img-fluid" alt="Gambar Pesan">
                        @endif
                        <p class="card-text">
                            <small class="text-muted">{{ $pesan->created_at->diffForHumans() }}</small>
                        </p>
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    function updateMessageStatus(messageId, newStatus) {
        const messageElement = document.querySelector(`[data-pesan-id="${messageId}"]`);
        if (messageElement) {
            const statusBadge = messageElement.querySelector('.status-badge');
            const newClass = newStatus === 'belum_dibaca' ? 'bg-danger' : 
                           (newStatus === 'dibaca' ? 'bg-warning' : 'bg-success');
            
            // Remove old status classes
            statusBadge.classList.remove('bg-danger', 'bg-warning', 'bg-success');
            // Add new status class
            statusBadge.classList.add(newClass);
            
            // Update text with proper formatting
            const statusText = newStatus.split('_')
                .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                .join(' ');
            statusBadge.textContent = statusText;
        }
    }

    // Polling untuk memperbarui status pesan setiap 2 detik
    setInterval(() => {
        fetch(`/konsultasi/{{ $konsultasi->id }}/messages-status`)
            .then(response => response.json())
            .then(data => {
                data.forEach(message => {
                    updateMessageStatus(message.id, message.status);
                });
            })
            .catch(error => console.error('Error:', error));
    }, 2000);
});
</script>
@endpush


