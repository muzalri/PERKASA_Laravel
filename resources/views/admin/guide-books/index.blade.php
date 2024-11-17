@extends('admin.layouts.app')

@section('title', 'Guide Books')
@section('header', 'Manajemen Guide Books')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold">Daftar Guide Books</h2>
            <a href="{{ route('admin.guide-books.create') }}" 
               class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                <i class="fas fa-plus mr-2"></i>Tambah Guide Book
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Judul
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kategori
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Penulis
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($guideBooks as $book)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $book->title }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-500">
                                {{ $book->category_id?->name ?? 'Tidak ada kategori' }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-500">
                                {{ $book->user_id?->name ?? 'Tidak ada penulis' }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-500">{{ $book->created_at->format('d/m/Y') }}</div>
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <a href="{{ route('admin.guide-books.show', $book) }}" 
                               class="text-blue-600 hover:text-blue-900 mr-3">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.guide-books.edit', $book) }}" 
                               class="text-yellow-600 hover:text-yellow-900 mr-3">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.guide-books.destroy', $book) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Yakin ingin menghapus guide book ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $guideBooks->links() }}
        </div>
    </div>
</div>
@endsection 