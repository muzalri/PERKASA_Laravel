@extends('layout.master')

@section('title', 'Edit Profil')

@section('content')
    <h1>Edit Profil</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color:red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf

        <!-- Nama -->
        <div>
            <label for="name">Nama</label>
            <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <!-- Email -->
        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <!-- Password -->
        <div>
            <label for="password">Password Baru (biarkan kosong jika tidak ingin mengubah)</label>
            <input id="password" type="password" name="password">
        </div>

        <!-- Konfirmasi Password -->
        <div>
            <label for="password_confirmation">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation">
        </div>

        <!-- No HP -->
        <div>
            <label for="no_hp">No HP</label>
            <input id="no_hp" type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" required>
        </div>

        <!-- Alamat -->
        <div>
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" required>{{ old('alamat', $user->alamat) }}</textarea>
        </div>

        <!-- Submit -->
        <div>
            <button type="submit">Perbarui Profil</button>
        </div>
    </form>

    <p><a href="{{ route('dashboard') }}">Kembali ke Dashboard</a></p>
@endsection