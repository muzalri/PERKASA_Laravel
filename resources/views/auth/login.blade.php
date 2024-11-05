@extends('layout.auth')

@section('title', 'Login')

@section('content')
<div class="flex h-screen bg-gray-100">
    <!-- Bagian kiri - Gambar dan Pesan Selamat Datang -->
    <div class="bg-perkasa-blue hidden lg:flex lg:w-1/2">
        <div class="w-full flex flex-col justify-center items-center text-center">
            <div class="text-white text-6xl font-bold">
                Selamat<br>Datang<br>Kembali!
            </div>
        </div>
    </div>
    
    <!-- Bagian kanan - Form Login -->
    <div class="w-full lg:w-1/2 flex items-center justify-center">
        <div class="max-w-md w-full space-y-8 p-10 bg-sky-50 rounded-xl shadow-lg">
            <div class="text-center">
                <h2 class="mt-6 text-3xl font-bold text-gray-900">
                    Login
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Masukkan detail Anda untuk masuk ke akun Anda
                </p>
            </div>

            @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ session('success') }}
            </div>
            @endif

            <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email" class="sr-only">Email</label>
                        <input id="email" name="email" type="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-teal-500 focus:border-teal-500 focus:z-10 sm:text-sm" placeholder="Email" value="{{ old('email') }}">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-teal-500 focus:border-teal-500 focus:z-10 sm:text-sm" placeholder="Password">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                            Ingat saya
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="auth-forgot-password.html" class="font-medium text-teal-600 hover:text-teal-500">
                            Lupa password?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-perkasa-blue hover:bg-perkasa-blue/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                        Login
                    </button>
                </div>
            </form>

            <div class="text-center">
                <p class="mt-2 text-sm text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-medium text-teal-600 hover:text-teal-500">
                        Daftar
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
