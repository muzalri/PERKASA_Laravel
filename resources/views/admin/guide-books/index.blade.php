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

        <!-- Loading State -->
        <div id="loading-state" class="animate-pulse">
            <div class="h-12 bg-gray-200 rounded mb-4"></div>
            <div class="h-12 bg-gray-200 rounded mb-4"></div>
            <div class="h-12 bg-gray-200 rounded mb-4"></div>
        </div>

        <div class="overflow-x-auto" id="guide-books-table" style="display: none;">
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
                <tbody class="bg-white divide-y divide-gray-200" id="guide-books-content">
                </tbody>
            </table>
        </div>

        <div class="mt-4" id="pagination">
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadGuideBooks();
});

function loadGuideBooks() {
    const token = localStorage.getItem('token');
    
    $.ajax({
        url: '/api/admin/guide-books',
        type: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        },
        success: function(response) {
            if (response.success) {
                const tableBody = $('#guide-books-table tbody');
                tableBody.empty();
                
                response.data.data.forEach(book => {
                    tableBody.append(`
                        <tr>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">${book.title}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">
                                    ${book.category_id?.name || 'Tidak ada kategori'}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">
                                    ${book.user_id?.name || 'Tidak ada penulis'}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">
                                    ${new Date(book.created_at).toLocaleDateString('id-ID')}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right text-sm font-medium">
                                <a href="#" onclick="showGuideBook(${book.id})" 
                                   class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" onclick="editGuideBook(${book.id})" 
                                   class="text-yellow-600 hover:text-yellow-900 mr-3">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" onclick="deleteGuideBook(${book.id})" 
                                   class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    `);
                });

                // Update pagination
                $('#pagination').html(createPaginationLinks(response.data));
                
                $('#loading-state').hide();
                $('#guide-books-table').show();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            if (xhr.status === 401) {
                window.location.href = '/login';
            }
        }
    });
}

function deleteGuideBook(id) {
    if (!confirm('Yakin ingin menghapus guide book ini?')) {
        return;
    }

    const token = localStorage.getItem('token');
    fetch(`/api/admin/guide-books/${id}`, {
        method: 'DELETE',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Guide book berhasil dihapus');
            loadGuideBooks();
        } else {
            alert(data.message || 'Gagal menghapus guide book');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menghapus guide book');
    });
}

function createPaginationLinks(data) {
    let html = '<div class="flex justify-center space-x-1">';
    
    // Previous Page
    if (data.current_page > 1) {
        html += `<button onclick="loadGuideBooks(${data.current_page - 1})" 
                 class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
                 Previous
                 </button>`;
    }

    // Current Page
    html += `<span class="px-4 py-2 text-white bg-blue-500 rounded-md">
             ${data.current_page}
             </span>`;

    // Next Page
    if (data.current_page < data.last_page) {
        html += `<button onclick="loadGuideBooks(${data.current_page + 1})" 
                 class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
                 Next
                 </button>`;
    }

    html += '</div>';
    return html;
}

function showGuideBook(id) {
    window.location.href = `/admin/guide-books/${id}`;
}

function editGuideBook(id) {
    window.location.href = `/admin/guide-books/${id}/edit`;
}
</script>
@endpush
@endsection 