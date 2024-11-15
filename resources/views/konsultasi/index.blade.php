@extends('layout.master')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Konsultasi</h1>
        <a href="{{ route('konsultasi.create') }}" 
           class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition duration-200">
            Konsultasi Baru
        </a>
    </div>

    <div class="space-y-4">
        @foreach($konsultasis as $konsultasi)
        <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition duration-200 p-4">
            <div class="flex justify-between items-start">
                <a href="{{ route('konsultasi.show', $konsultasi) }}" class="block flex-1">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500 text-lg">{{ auth()->user()->role === 'pakar' ? substr($konsultasi->user->name, 0, 1) : substr($konsultasi->pakar->name, 0, 1) }}</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-900">
                                        {{ auth()->user()->role === 'pakar' ? $konsultasi->user->name : $konsultasi->pakar->name }}
                                    </h2>
                                    <p class="text-sm font-medium text-gray-600">{{ $konsultasi->judul }}</p>
                                </div>
                                <span class="text-sm text-gray-500">
                                    @if($konsultasi->last_message_time)
                                        {{ \Carbon\Carbon::parse($konsultasi->last_message_time)->format('H:i') }}
                                    @endif
                                </span>
                            </div>
                            @if($konsultasi->pesans->count() > 0)
                                <p class="text-sm text-gray-500 truncate mt-1">
                                    {{ $konsultasi->pesans->first()->isi }}
                                    @if($konsultasi->unread_count > 0)
                                        <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-blue-500 text-white text-xs ml-2">
                                            {{ $konsultasi->unread_count }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-green-500 text-white text-xs ml-2">
                                            <i class="fas fa-check"></i>
                                        </span>
                                    @endif
                                </p>
                            @else
                                <p class="text-sm text-gray-500 mt-1">Belum ada pesan</p>
                            @endif
                        </div>
                    </div>
                </a>
                <!-- Tombol Delete -->
                <div class="ml-4">
                    <form action="{{ route('konsultasi.destroy', $konsultasi) }}" 
                          method="POST" 
                          class="inline-block"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus konsultasi ini dari daftar Anda?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 transition duration-200">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach

        @if($konsultasis->count() === 0)
            <div class="text-center py-8">
                <p class="text-gray-500">Belum ada konsultasi</p>
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

