@extends('layout.master')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header dengan gradasi -->
    <div class="bg-gradient-to-r from-perkasa-blue to-sky-600 py-8 rounded-lg mx-4">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-serif font-bold text-white mb-2">Dashboard</h1>
            <p class="text-sky-100">Selamat datang di Perkasa, kelola semua aktivitas Anda di sini</p>
        </div>
    </div>

    <!-- Konten Utama -->
    <div class="container mx-auto px-4 py-8 max-w-6x1">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card Komunitas -->
            <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center mb-4">
                    <i class="fas fa-users text-3xl text-blue-500 mr-3"></i>
                    <h2 class="text-2xl font-bold text-gray-800">Komunitas</h2>
                </div>
                <p class="text-gray-600 mb-4">Berbagi pengetahuan dan pengalaman dengan komunitas budidaya ikan.</p>
                <a href="{{ route('komunitas') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                    Kunjungi Komunitas <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Card Konsultasi -->
            <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center mb-4">
                    <i class="fas fa-comments text-3xl text-green-500 mr-3"></i>
                    <h2 class="text-2xl font-bold text-gray-800">Konsultasi</h2>
                </div>
                <p class="text-gray-600 mb-4">Konsultasikan masalah budidaya ikan Anda dengan para pakar.</p>
                <a href="{{ route('konsultasi.index') }}" class="inline-flex items-center text-green-600 hover:text-green-800">
                    Mulai Konsultasi <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Card Marketplace -->
            <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center mb-4">
                    <i class="fas fa-store text-3xl text-purple-500 mr-3"></i>
                    <h2 class="text-2xl font-bold text-gray-800">Marketplace</h2>
                </div>
                <p class="text-gray-600 mb-4">Temukan produk dan peralatan budidaya ikan berkualitas.</p>
                <a href="{{ route('marketplace') }}" class="inline-flex items-center text-purple-600 hover:text-purple-800">
                    Kunjungi Marketplace <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Card Panduan -->
            <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center mb-4">
                    <i class="fas fa-book text-3xl text-yellow-500 mr-3"></i>
                    <h2 class="text-2xl font-bold text-gray-800">Panduan</h2>
                </div>
                <p class="text-gray-600 mb-4">Pelajari teknik dan tips budidaya ikan melalui panduan lengkap.</p>
                <a href="{{ route('guide-books.index') }}" class="inline-flex items-center text-yellow-600 hover:text-yellow-800">
                    Baca Panduan <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
