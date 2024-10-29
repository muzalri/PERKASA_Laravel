@extends('layout.master')
@section('title', 'Profile')

@section('content')
<div class="max-w-lg mx-auto mt-16 p-6 bg-white rounded-lg shadow-md">
    @if (session('success'))
    <div class="mb-4 p-4 text-green-700 bg-green-100 rounded">
        {{ session('success') }}
    </div>
    @endif

    <!-- Bagian Foto Profil -->
    <div class="mb-6 text-center">
        @if(Auth::user()->profile_photo)
            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Foto Profil" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
        @else
            <img src="{{ asset('assets/images/faces/' . rand(1,8) . '.jpg') }}" alt="Default Foto Profil" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
        @endif
        
        <div class="flex items-center justify-center space-x-2">
            <!-- Form untuk upload foto -->
            <form action="{{ route('profile.upload-photo') }}" method="POST" enctype="multipart/form-data" class="inline">
                @csrf
                <label for="photo" class="cursor-pointer bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                    <i class="fas fa-camera mr-2"></i>Ubah Foto
                </label>
                <input type="file" id="photo" name="profile_photo" class="hidden" onchange="this.form.submit()">
            </form>

            @if(Auth::user()->profile_photo)
                <!-- Form untuk hapus foto -->
                <form action="{{ route('profile.delete-photo') }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus foto profil?')">
                        <i class="fas fa-trash mr-2"></i>Hapus Foto
                    </button>
                </form>
            @endif
        </div>
    </div>

    <div class="space-y-4">
        <p class="flex items-center"><i class="fas fa-user mr-2 text-blue-500"></i><strong>Selamat datang,</strong> {{ Auth::user()->name }}!</p>
        <p class="flex items-center"><i class="fas fa-envelope mr-2 text-blue-500"></i><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p class="flex items-center"><i class="fas fa-phone mr-2 text-blue-500"></i><strong>No HP:</strong> {{ Auth::user()->no_hp }}</p>
        <p class="flex items-center"><i class="fas fa-map-marker-alt mr-2 text-blue-500"></i><strong>Alamat:</strong> {{ Auth::user()->alamat }}</p>
    </div>

    <hr class="my-6">

    <div class="flex justify-between">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Logout</button>
        </form>
        <form method="get" action="{{ route('profile.edit') }}">
            @csrf
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Edit</button>
        </form>
    </div>
</div>
@endsection