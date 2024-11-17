@extends('admin.layouts.app')

@section('title', 'Kategori')
@section('header', 'Manajemen Kategori')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold">Daftar Kategori</h2>
            <button onclick="document.getElementById('createModal').classList.remove('hidden')" 
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                <i class="fas fa-plus mr-2"></i>Tambah Kategori
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Kategori
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($categories as $category)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $category->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Kategori -->
<div id="createModal" class="fixed inset-0 bg-black bg-opacity-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Tambah Kategori Baru</h3>
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Kategori
                        </label>
                        <input type="text" name="name" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                onclick="document.getElementById('createModal').classList.add('hidden')"
                                class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 