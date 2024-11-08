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
            </div>
        @endif
    </div>
</div>
@endsection
