@extends('layout.master')

@section('title', 'Daftar Artikel')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header dengan gradasi -->
    <div class="bg-gradient-to-r from-perkasa-blue to-sky-600 py-8 mt-6 rounded-lg mx-4">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-serif font-bold text-white mb-2">Daftar Artikel</h1>
            <p class="text-sky-100">Berbagi pengetahuan dan pengalaman dengan komunitas</p>
        </div>
    </div>

    <!-- Garis Pemisah -->
    <div class="border-b border-gray-200"></div>

    <!-- Konten Utama -->
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Tombol Buat Artikel -->
        <div class="mb-8">
            <a href="{{ route('komunitas.create') }}" 
               class="inline-flex items-center px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg
                      transform transition duration-200 hover:bg-blue-600 hover:scale-105 hover:shadow-lg">
                <i class="fas fa-plus-circle mr-2"></i>
                Buat Artikel Baru
            </a>
        </div>

        @if($komunitas->count())
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                Judul
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                Kategori
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                Penulis
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($komunitas as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-gray-900 font-medium">{{ $item->title }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $item->category->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <img class="h-8 w-8 rounded-full mr-3" 
                                         src="{{ asset('assets/images/faces/' . rand(1,8) . '.jpg') }}" 
                                         alt="{{ $item->user->name }}">
                                    <p class="text-sm text-gray-900">{{ $item->user->name }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('komunitas.show', $item) }}" 
                                   class="text-blue-600 hover:text-blue-900 font-medium transition-colors">
                                    <i class="fas fa-eye mr-1"></i> Lihat
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination dengan styling -->
            <div class="mt-6">
                {{ $komunitas->links() }}
            </div>
        @else
            <div class="text-center py-12 bg-white rounded-xl shadow-sm">
                <i class="fas fa-newspaper text-gray-400 text-5xl mb-4"></i>
                <p class="text-gray-500 text-lg mb-4">Belum ada artikel.</p>
                <a href="{{ route('komunitas.create') }}" 
                   class="text-blue-600 hover:text-blue-800 font-semibold hover:underline transition-colors">
                    Buat artikel pertama! <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Dark Mode Toggle Button -->
<button id="darkModeToggle" 
        class="fixed bottom-4 right-4 p-3 bg-gray-800 text-white rounded-full shadow-lg 
               hover:bg-gray-700 transition-colors focus:outline-none">
    <i class="fas fa-moon"></i>
</button>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const darkModeToggle = document.getElementById('darkModeToggle');
    const html = document.documentElement;

    darkModeToggle.addEventListener('click', function() {
        html.classList.toggle('dark');
        const isDark = html.classList.contains('dark');
        localStorage.setItem('darkMode', isDark);
        darkModeToggle.innerHTML = isDark ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
    });

    // Check saved preference
    if (localStorage.getItem('darkMode') === 'true') {
        html.classList.add('dark');
        darkModeToggle.innerHTML = '<i class="fas fa-sun"></i>';
    }
});
</script>
@endpush

@push('styles')
<style>
/* Dark mode styles */
.dark {
    @apply bg-gray-900;
}

.dark .bg-white {
    @apply bg-gray-800;
}

.dark .text-gray-900 {
    @apply text-gray-100;
}

.dark .text-gray-600 {
    @apply text-gray-400;
}

.dark .bg-gray-50 {
    @apply bg-gray-800;
}

.dark .divide-gray-200 > * {
    @apply border-gray-700;
}

.dark .hover\:bg-gray-50:hover {
    @apply hover:bg-gray-700;
}
</style>
@endpush
