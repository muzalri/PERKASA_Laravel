@extends('layout.auth')

@section('title', 'Login')

@section('content')

<!-- Notifikasi Error -->
@if ($errors->any())
<div class="fixed top-4 right-4 bg-red-100 border-l-4 border-red-500 p-4 rounded shadow-lg">
    <ul>
        @foreach ($errors->all() as $error)
            <li class="text-red-700">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- Notifikasi Sukses -->
@if (session('success'))
<div class="fixed top-4 right-4 bg-green-100 border-l-4 border-green-500 p-4 rounded shadow-lg">
    <p class="text-green-700">{{ session('success') }}</p>
</div>
@endif

<div class="flex h-screen">
    <!-- Bagian Kiri -->
    <div class="w-full lg:w-5/12 bg-gradient-to-b from-teal-600 to-teal-800">
        <div class="flex flex-col justify-between h-full p-8 lg:p-12">
            <!-- Bagian atas dengan logo dan teks -->
            <div>
                <div class="mb-12">
                    <a href="index.html" class="inline-block">
                        <img src="assets/images/logo/logo.png" alt="Logo" class="h-16 hover:scale-105 transition-transform duration-300">
                    </a>
                </div>
                
                <div class="space-y-6">
                    <h1 class="text-4xl lg:text-5xl font-bold text-white leading-tight">
                        Selamat Datang<br>di PERKASA
                    </h1>
                    
                    <div class="space-y-4 text-lg text-gray-100 leading-relaxed">
                        <p>
                            Perkasa adalah platform inovatif yang memberdayakan anak muda Indonesia untuk memulai bisnis budidaya ikan dengan mudah.
                        </p>
                        <p>
                            Dengan hanya menyediakan lahan dan tenaga kerja, Anda akan mendapatkan bimbingan lengkap.
                        </p>                       
                    </div>
                </div>
            </div>

            <!-- Bagian bawah dengan tombol -->
            <div class="mt-auto space-y-4">
                <a href="{{ route('register') }}" 
                   class="block w-full py-4 px-6 text-center text-[#577D8E] bg-white hover:bg-gray-50 rounded-xl font-semibold transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                   Belum Punya Akun? Registrasi Disini
                </a>

                <a href="{{ route('login') }}" 
                    class="block w-full py-4 px-6 text-center text-white border-2 border-white hover:text-black rounded-xl font-semibold transition-all duration-300 transform hover:-translate-y-1">
                    Sudah Punya Akun? Login Disini
                </a>
            </div>
        </div>
    </div>

    <!-- Bagian Kanan -->
    <div class="hidden lg:block lg:w-7/12 bg-[#C7D9E4] relative overflow-hidden">
        <div class="h-full flex items-center justify-center p-12">
            <!-- Tambahkan ilustrasi atau gambar yang relevan -->
            <div class="relative w-full max-w-2xl">
                <div class="absolute -top-20 -right-20 w-40 h-40 bg-[#577D8E] rounded-full opacity-10"></div>
                <div class="absolute -bottom-10 -left-10 w-60 h-60 bg-[#577D8E] rounded-full opacity-10"></div>
                <!-- Area untuk konten kanan - bisa ditambahkan gambar/ilustrasi -->
            </div>
        </div>
    </div>
</div>

@endSection
