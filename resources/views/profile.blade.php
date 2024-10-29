@extends('layout.master')
@section('title', 'Profile')

@section('content')
<div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-md">
    @if (session('success'))
    <div class="mb-4 p-4 text-green-700 bg-green-100 rounded">
        {{ session('success') }}
    </div>
    @endif

    <div class="flex items-center mb-6">
        @if(Auth::user()->profile_picture)
            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Foto Profil" class="w-20 h-20 rounded-full mr-4">
        @else
            <i class="fas fa-user-circle text-5xl text-gray-400 mr-4"></i>
        @endif
        <h3 class="text-2xl font-semibold">Profile</h3>
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