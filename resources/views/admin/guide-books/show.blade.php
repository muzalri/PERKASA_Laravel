@extends('admin.layouts.app')

@section('title', 'Detail Guide Book')
@section('header', 'Detail Guide Book')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6">
        <div id="loading-state" class="animate-pulse">
            <div class="h-8 bg-gray-200 rounded w-1/4 mb-4"></div>
            <div class="h-4 bg-gray-200 rounded w-1/3 mb-2"></div>
            <div class="h-4 bg-gray-200 rounded w-1/2 mb-4"></div>
            <div class="h-64 bg-gray-200 rounded mb-4"></div>
        </div>

        <div id="guide-book-content" style="display: none;">
            <!-- Konten akan diisi melalui JavaScript -->
        </div>

        <div class="flex justify-end space-x-3 mt-6">
            <a href="{{ route('admin.guide-books.index') }}" 
               class="px-4 py-2 text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                Kembali
            </a>
            <button onclick="editGuideBook()" 
                    class="px-4 py-2 text-white bg-yellow-500 rounded-md hover:bg-yellow-600">
                Edit
            </button>
            <button onclick="deleteGuideBook()" 
                    class="px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600">
                Hapus
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
let guideBookId;

document.addEventListener('DOMContentLoaded', function() {
    const pathArray = window.location.pathname.split('/');
    guideBookId = pathArray[pathArray.length - 1];
    loadGuideBook();
});

function loadGuideBook() {
    const token = localStorage.getItem('token');
    
    $.ajax({
        url: `/api/admin/guide-books/${guideBookId}`,
        type: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        },
        success: function(response) {
            if (response.success) {
                const book = response.data;
                $('#guide-book-content').html(`
                    <h2 class="text-2xl font-bold mb-4">${book.title}</h2>
                    <div class="mb-4">
                        <span class="font-medium">Kategori:</span> 
                        ${book.category_id?.name || 'Tidak ada kategori'}
                    </div>
                    <div class="mb-4">
                        <span class="font-medium">Penulis:</span> 
                        ${book.user_id?.name || 'Tidak ada penulis'}
                    </div>
                    <div class="prose max-w-none mb-6">
                        ${book.content}
                    </div>
                    ${book.image_path ? `
                        <div class="mb-6">
                            <img src="/imagedb/guide_book/images/${book.image_path}" 
                                 alt="Guide Book Image" class="max-w-lg rounded">
                        </div>
                    ` : ''}
                    ${book.video_path ? `
                        <div class="mb-6">
                            <video width="320" height="240" controls class="rounded">
                                <source src="/imagedb/guide_book/videos/${book.video_path}" type="video/mp4">
                                Browser Anda tidak mendukung tag video.
                            </video>
                        </div>
                    ` : ''}
                `);
                
                $('#loading-state').hide();
                $('#guide-book-content').show();
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

function editGuideBook() {
    window.location.href = `/admin/guide-books/${guideBookId}/edit`;
}

function deleteGuideBook() {
    if (!confirm('Yakin ingin menghapus guide book ini?')) {
        return;
    }

    const token = localStorage.getItem('token');
    fetch(`/api/admin/guide-books/${guideBookId}`, {
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
            window.location.href = '/admin/guide-books';
        } else {
            alert(data.message || 'Gagal menghapus guide book');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menghapus guide book');
    });
}
</script>
@endpush
@endsection
