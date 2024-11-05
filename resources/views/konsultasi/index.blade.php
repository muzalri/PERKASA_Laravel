@extends('layout.master')

@section('title', 'Daftar Konsultasi')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header dengan gradasi -->
    <div class="bg-gradient-to-r from-perkasa-blue to-sky-600 py-8 mt-6 rounded-lg mx-4">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-serif font-bold text-white mb-2">Daftar Konsultasi</h1>
            <p class="text-sky-100">Konsultasikan masalah budidaya ikan Anda dengan para pakar</p>
        </div>
    </div>

    <!-- Garis Pemisah -->
    <div class="border-b border-gray-200"></div>

    <!-- Konten Utama -->
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Tombol Buat Konsultasi -->
        <div class="mb-8">
            <a href="{{ route('konsultasi.create') }}" 
               class="inline-flex items-center px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg
                      transform transition duration-200 hover:bg-blue-600 hover:scale-105 hover:shadow-lg">
                <i class="fas fa-plus-circle mr-2"></i>
                Buat Konsultasi Baru
            </a>
        </div>

        @if($konsultasis->count())
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                Judul
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                Pakar
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($konsultasis as $konsultasi)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-gray-900 font-medium">{{ $konsultasi->judul }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $konsultasi->status === 'selesai' ? 'bg-green-100 text-green-800' : 
                                       ($konsultasi->status === 'berlangsung' ? 'bg-blue-100 text-blue-800' : 
                                       'bg-yellow-100 text-yellow-800') }}">
                                    {{ ucfirst($konsultasi->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <img class="h-8 w-8 rounded-full mr-3" 
                                         src="{{ asset('assets/images/faces/' . rand(1,8) . '.jpg') }}" 
                                         alt="{{ $konsultasi->pakar->name }}">
                                    <p class="text-sm text-gray-900">{{ $konsultasi->pakar->name }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $konsultasi->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('konsultasi.show', $konsultasi) }}" 
                                   class="text-blue-600 hover:text-blue-900 font-medium transition-colors">
                                    <i class="fas fa-comments mr-1"></i> Chat
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination dengan styling -->
            <div class="mt-6">
                {{ $konsultasis->links() }}
            </div>
        @else
            <div class="text-center py-12 bg-white rounded-xl shadow-sm">
                <i class="fas fa-comments text-gray-400 text-5xl mb-4"></i>
                <p class="text-gray-500 text-lg mb-4">Belum ada konsultasi.</p>
                <a href="{{ route('konsultasi.create') }}" 
                   class="text-blue-600 hover:text-blue-800 font-semibold hover:underline transition-colors">
                    Buat konsultasi pertama! <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

