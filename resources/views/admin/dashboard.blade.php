@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard Admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="dashboard-stats">
    <!-- Loading placeholder -->
    <div class="bg-white rounded-lg shadow-sm p-6 animate-pulse">
        <div class="h-20 bg-gray-200 rounded"></div>
    </div>
    <div class="bg-white rounded-lg shadow-sm p-6 animate-pulse">
        <div class="h-20 bg-gray-200 rounded"></div>
    </div>
    <div class="bg-white rounded-lg shadow-sm p-6 animate-pulse">
        <div class="h-20 bg-gray-200 rounded"></div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    
    if (!token) {
        window.location.href = '/login';
        return;
    }

    fetch('/api/admin/dashboard-stats', {
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Unauthorized');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            const stats = data.data;
            document.getElementById('dashboard-stats').innerHTML = `
                <!-- Card Artikel -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700">Total Artikel</h3>
                            <p class="text-3xl font-bold text-blue-600">${stats.totalArticles}</p>
                        </div>
                        <i class="fas fa-newspaper text-4xl text-blue-200"></i>
                    </div>
                    <a href="{{ route('admin.articles.index') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800">
                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                <!-- Card Kategori -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700">Total Kategori</h3>
                            <p class="text-3xl font-bold text-green-600">${stats.totalCategories}</p>
                        </div>
                        <i class="fas fa-tags text-4xl text-green-200"></i>
                    </div>
                    <a href="{{ route('admin.categories.index') }}" class="mt-4 inline-block text-green-600 hover:text-green-800">
                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                <!-- Card Panduan -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700">Total Panduan</h3>
                            <p class="text-3xl font-bold text-yellow-600">${stats.totalGuideBooks}</p>
                        </div>
                        <i class="fas fa-book text-4xl text-yellow-200"></i>
                    </div>
                    <a href="{{ route('admin.guide-books.index') }}" class="mt-4 inline-block text-yellow-600 hover:text-yellow-800">
                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            `;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        if (error.message === 'Unauthorized') {
            window.location.href = '/login';
        }
    });
});
</script>
@endpush
@endsection
