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
                        @php
                            $lastMessage = $konsultasi->pesans->first();
                            $unreadCount = $konsultasi->pesans()
                                ->where('user_id', '!=', auth()->id())
                                ->where('status', 'belum_dibaca')
                                ->count();
                        @endphp

                        @if(!$konsultasi->pesans->count())
                            <span class="px-2 py-1 text-xs text-white rounded bg-gray-500">
                                Belum ada pesan
                            </span>
                        @elseif($lastMessage->user_id === auth()->id())
                            <span class="status-icon">
                                @if($lastMessage->status === 'belum_dibaca')
                                    <i class="fa-solid fa-check-double sent-check"></i>
                                @elseif($lastMessage->status === 'dibaca')
                                    <i class="fa-solid fa-check-double read-check"></i>
                                @endif
                            </span>
                        @elseif($unreadCount > 0)
                            <span class="unread-count">
                                {{ $unreadCount }}
                            </span>
                        @else
                            <span class="status-icon">
                                <i class="fa-solid fa-check-double read-check"></i>
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    function updateStatuses() {
        fetch('/konsultasi/status-updates')
            .then(response => response.json())
            .then(data => {
                data.forEach(konsultasi => {
                    const statusCell = document.querySelector(`#konsultasi-${konsultasi.id}-status`);
                    if (statusCell) {
                        if (konsultasi.unread_count > 0) {
                            statusCell.innerHTML = `
                                <span class="unread-count">
                                    ${konsultasi.unread_count}
                                </span>
                            `;
                        } else if (konsultasi.last_message_status === 'dibaca') {
                            statusCell.innerHTML = `
                                <span class="status-icon">
                                    <i class="fas fa-check-double read-check"></i>
                                </span>
                            `;
                        } else if (konsultasi.last_message_status === 'belum_dibaca') {
                            statusCell.innerHTML = `
                                <span class="status-icon">
                                    <i class="fas fa-check-double sent-check"></i>
                                </span>
                            `;
                        }
                    }
                });
            });
    }

    // Update status setiap 2 detik
    setInterval(updateStatuses, 2000);
});
</script>
@endpush

@push('styles')
<style>
.status-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.sent-check {
    color: #8696a0;
    font-size: 16px;
}

.read-check {
    color: #53bdeb;
    font-size: 16px;
}

.unread-count {
    background-color: #25d366;
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: bold;
}
</style>
@endpush
