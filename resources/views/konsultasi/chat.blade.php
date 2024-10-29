<form method="POST" action="{{ route('upload.image') }}" enctype="multipart/form-data">
    @csrf
    // ... existing form fields ...
    <img src="{{ asset('storage/' . $message->image) }}" alt="Pesan Gambar" class="max-w-sm">
</form> 