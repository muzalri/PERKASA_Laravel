@extends('admin.layouts.app')

@section('title', 'Detail Artikel')
@section('header', 'Detail Artikel')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6">
        <div id="loading-state" class="animate-pulse">
            <div class="h-8 bg-gray-200 rounded w-1/4 mb-4"></div>
            <div class="h-4 bg-gray-200 rounded w-1/3 mb-2"></div>
            <div class="h-4 bg-gray-200 rounded w-1/2 mb-4"></div>
            <div class="h-64 bg-gray-200 rounded mb-4"></div>
        </div>

        <div id="article-content" style="display: none;">
            <!-- Konten akan diisi melalui JavaScript -->
        </div>

        <div class="mt-6">
            <h3 class="text-lg font-semibold mb-4">Komentar</h3>
            <div id="comments-section" class="space-y-4">
                <!-- Komentar akan diisi melalui JavaScript -->
            </div>
        </div>

        <div class="flex justify-end space-x-3 mt-6">
            <a href="{{ route('admin.articles.index') }}" 
               class="px-4 py-2 text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                Kembali
            </a>
            <button onclick="deleteArticle()" 
                    class="px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600">
                Hapus
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
let articleId;

document.addEventListener('DOMContentLoaded', function() {
    const pathArray = window.location.pathname.split('/');
    articleId = pathArray[pathArray.length - 1];
    loadArticle();
});

function loadArticle() {
    const token = localStorage.getItem('token');
    
    $.ajax({
        url: `/api/admin/articles/${articleId}`,
        type: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        },
        success: function(response) {
            if (response.success) {
                const article = response.data;
                $('#article-content').html(`
                    <h2 class="text-2xl font-bold mb-4">${article.title}</h2>
                    <div class="mb-4">
                        <span class="font-medium">Kategori:</span> 
                        ${article.category?.name || 'Tidak ada kategori'}
                    </div>
                    <div class="mb-4">
                        <span class="font-medium">Penulis:</span> 
                        ${article.user?.name || 'Tidak ada penulis'}
                    </div>
                    ${article.image ? `
                        <div class="mb-6">
                            <img src="/imagedb/komunitas/${article.image}" 
                                 alt="Article Image" class="max-w-lg rounded">
                        </div>
                    ` : ''}
                    <div class="prose max-w-none mb-6">
                        ${article.body}
                    </div>
                `);

                // Render komentar
                const commentsHtml = article.komentars?.map(comment => `
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="flex items-center gap-2">
                                    ${comment.user?.profile_photo ? 
                                        `<img src="/imagedb/profile_photo/${comment.user.profile_photo}" 
                                         alt="Profile" class="w-8 h-8 rounded-full">` : 
                                        `<div class="w-8 h-8 bg-gray-300 rounded-full"></div>`
                                    }
                                    <div>
                                        <p class="font-medium">${comment.user?.name || 'Pengguna'}</p>
                                        <p class="text-sm text-gray-500">
                                            ${new Date(comment.created_at).toLocaleDateString('id-ID', {
                                                year: 'numeric',
                                                month: 'long',
                                                day: 'numeric'
                                            })}
                                        </p>
                                    </div>
                                </div>
                                <p class="mt-2">${comment.body}</p>
                            </div>
                            <button onclick="deleteComment(${comment.id})" 
                                    class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `).join('') || '<p class="text-gray-500">Belum ada komentar</p>';

                $('#comments-section').html(commentsHtml);
                
                $('#loading-state').hide();
                $('#article-content').show();
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

function deleteComment(commentId) {
    if (!confirm('Yakin ingin menghapus komentar ini?')) {
        return;
    }

    const token = localStorage.getItem('token');
    fetch(`/api/admin/articles/${articleId}/komentar/${commentId}`, {
        method: 'DELETE',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Komentar berhasil dihapus');
            loadArticle();
        } else {
            alert(data.message || 'Gagal menghapus komentar');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menghapus komentar');
    });
}

function deleteArticle() {
    if (!confirm('Yakin ingin menghapus artikel ini?')) {
        return;
    }

    const token = localStorage.getItem('token');
    fetch(`/api/admin/articles/${articleId}`, {
        method: 'DELETE',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Artikel berhasil dihapus');
            window.location.href = '/admin/articles';
        } else {
            alert(data.message || 'Gagal menghapus artikel');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menghapus artikel');
    });
}
</script>
@endpush
@endsection 