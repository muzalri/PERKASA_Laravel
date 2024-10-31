<form method="POST" action="{{ route('pesan.store') }}" enctype="multipart/form-data">
    @csrf
    // ... existing form fields ...
    <img src="{{ asset('storage/' . $message->image) }}" alt="Pesan Gambar" class="max-w-sm">
</form> 