@extends('layout.master')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Daftar Konsultasi</h1>
    <a href="{{ route('konsultasi.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
        Buat Konsultasi Baru
    </a>
    <div class="overflow-x-auto bg-white shadow-md rounded">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Judul
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Pengguna
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Pakar
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($konsultasis as $konsultasi)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $konsultasi->judul }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $konsultasi->user->name }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $konsultasi->pakar->name }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        @if(isset($konsultasi->last_status))
                            @php
                                $statusClass = match($konsultasi->last_status) {
                                    'belum_dibaca' => 'bg-red-500',
                                    'dibaca' => 'bg-yellow-500',
                                    'dibalas' => 'bg-green-500',
                                    default => 'bg-gray-500'
                                };

                                $statusText = match(true) {
                                    !$konsultasi->pesans->count() => 'Belum ada pesan',
                                    $konsultasi->last_sender_id === auth()->id() => 'Pesan terkirim',
                                    $konsultasi->last_status === 'belum_dibaca' => 'Belum dibaca',
                                    $konsultasi->last_status === 'dibaca' => 'Sudah dibaca',
                                    $konsultasi->last_status === 'dibalas' => 'Sudah dibalas',
                                    default => 'Status tidak diketahui'
                                };
                            @endphp
                            <span class="px-2 py-1 text-xs text-white rounded {{ $statusClass }}">
                                {{ $statusText }}
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs text-white rounded bg-gray-500">
                                Belum ada pesan
                            </span>
                        @endif
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('konsultasi.show', $konsultasi) }}" 
                           class="text-blue-600 hover:text-blue-900">
                            Lihat
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
