@extends('admin.layouts.app')

@section('title', 'Artikel')
@section('header', 'Manajemen Artikel')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6">
        <!-- Loading State -->
        <div id="loading-state" class="animate-pulse">
            <div class="h-12 bg-gray-200 rounded mb-4"></div>
            <div class="h-12 bg-gray-200 rounded mb-4"></div>
            <div class="h-12 bg-gray-200 rounded mb-4"></div>
        </div>

        <div class="overflow-x-auto" id="articles-table" style="display: none;">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Judul
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Penulis
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kategori
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="articles-content">
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
    loadArticles();
});

function loadArticles() {
    const token = localStorage.getItem('token');
    
    $.ajax({
        url: '/api/admin/articles',
        type: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        },
        success: function(response) {
            if (response.success) {
                const tableBody = $('#articles-table tbody');
                tableBody.empty();
                
                response.data.data.forEach(article => {
                    tableBody.append(`
                        <tr>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">${article.title}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">
                                    ${article.user?.name || 'Tidak ada penulis'}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">
                                    ${article.category?.name || 'Tidak ada kategori'}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">
                                    ${new Date(article.created_at).toLocaleDateString('id-ID')}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right text-sm font-medium">
                                <a href="#" onclick="showArticle(${article.id})" 
                                   class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" onclick="deleteArticle(${article.id})" 
                                   class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    `);
                });

                $('#pagination').html(createPaginationLinks(response.data));
                
                $('#loading-state').hide();
                $('#articles-table').show();
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

function deleteArticle(id) {
    if (!confirm('Yakin ingin menghapus artikel ini?')) {
        return;
    }

    const token = localStorage.getItem('token');
    fetch(`/api/admin/articles/${id}`, {
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
            alert('Artikel berhasil dihapus');
            loadArticles();
        } else {
            alert(data.message || 'Gagal menghapus artikel');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menghapus artikel');
    });
}

function showArticle(id) {
    window.location.href = `/admin/articles/${id}`;
}

function createPaginationLinks(data) {
    let html = '<div class="flex justify-center space-x-1">';
    
    if (data.current_page > 1) {
        html += `<button onclick="loadArticles(${data.current_page - 1})" 
                 class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
                 Previous
                 </button>`;
    }

    html += `<span class="px-4 py-2 text-white bg-blue-500 rounded-md">
             ${data.current_page}
             </span>`;

    if (data.current_page < data.last_page) {
        html += `<button onclick="loadArticles(${data.current_page + 1})" 
                 class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
                 Next
                 </button>`;
    }

    html += '</div>';
    return html;
}
</script>
@endpush
@endsection 