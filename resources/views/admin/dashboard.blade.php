@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard Admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Card Artikel -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Total Artikel</h3>
                <p class="text-3xl font-bold text-blue-600">{{ $totalArticles }}</p>
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
                <p class="text-3xl font-bold text-green-600">{{ $totalCategories }}</p>
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
                <p class="text-3xl font-bold text-yellow-600">{{ $totalGuideBooks }}</p>
            </div>
            <i class="fas fa-book text-4xl text-yellow-200"></i>
        </div>
        <a href="{{ route('admin.guide-books.index') }}" class="mt-4 inline-block text-yellow-600 hover:text-yellow-800">
            Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>
</div>
@endsection
