@extends('layout.auth')

@section('title', 'Login')

@section('content')
<div class="flex h-screen">
    <!-- Bagian Kiri - Form Login -->
    <div class="w-full lg:w-5/12 bg-white p-8 lg:p-12 flex flex-col justify-center">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Login</h1>
            <p class="text-gray-600">Silakan masuk ke akun Anda</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            
            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" 
                           class="h-4 w-4 rounded border-gray-300 text-teal-600 focus:ring-teal-500">
                    <label for="remember" class="ml-2 block text-sm text-gray-700">Ingat Saya</label>
                </div>
            </div>

            <button type="submit" 
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                Login
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="font-medium text-teal-600 hover:text-teal-500">
                Daftar disini
            </a>
        </p>
    </div>

    <!-- Bagian Kanan - Gambar/Ilustrasi -->
    <div class="hidden lg:block lg:w-7/12 bg-gradient-to-b from-teal-600 to-teal-800">
        <div class="h-full flex items-center justify-center p-12">
            <div class="max-w-2xl text-white">
                <h2 class="text-4xl font-bold mb-6">Selamat Datang di PERKASA</h2>
                <p class="text-lg mb-8">Platform inovatif untuk memulai dan mengembangkan bisnis budidaya ikan Anda.</p>
            </div>
        </div>
    </div>
</div>
@endsection 