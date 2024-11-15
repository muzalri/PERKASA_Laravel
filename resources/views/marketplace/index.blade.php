@extends('layout.master')

@section('title', 'Marketplace')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header dengan gradasi -->
    <div class="bg-gradient-to-r from-perkasa-blue to-sky-600 py-8 mt-6 rounded-lg mx-4">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-serif font-bold text-white mb-2">Marketplace</h1>
            <p class="text-sky-100">Temukan produk dan peralatan budidaya ikan berkualitas</p>
        </div>
    </div>

    <!-- Konten Utama -->
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Tombol Tambah Produk -->
        <div class="mb-8">
            <a href="{{ route('marketplace.create') }}" 
               class="inline-flex items-center px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg
                      transform transition duration-200 hover:bg-blue-600 hover:scale-105 hover:shadow-lg">
                <i class="fas fa-plus-circle mr-2"></i>
                Tambah Produk Baru
            </a>
        </div>

        <!-- Filter dan Pencarian -->
        <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
            <div class="flex flex-wrap gap-4 items-center">
                <div class="flex-1">
                    <input type="text" placeholder="Cari produk..." 
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>
                <select class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    <option value="">Semua Kategori</option>
                    <option value="pakan">Pakan Ikan</option>
                    <option value="peralatan">Peralatan</option>
                    <option value="bibit">Bibit Ikan</option>
                </select>
                <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-bluer-600">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
            </div>
        </div>

        <!-- Grid Produk -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($products ?? [] as $product)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition-shadow">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                        <p class="text-purple-600 font-bold mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="text-gray-500 text-sm mt-2">{{ $product->description }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-map-marker-alt mr-1"></i>{{ $product->location }}
                            </span>
                            <button class="px-4 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600">
                                <i class="fas fa-shopping-cart mr-1"></i>Beli
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-store text-gray-400 text-5xl mb-4"></i>
                    <p class="text-gray-500 text-lg mb-4">Belum ada produk tersedia.</p>
                    <a href="{{ route('marketplace.create') }}" 
                       class="text-purple-600 hover:text-purple-800 font-semibold hover:underline transition-colors">
                        Tambah produk pertama! <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection 