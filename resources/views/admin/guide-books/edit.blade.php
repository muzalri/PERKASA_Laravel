@extends('admin.layouts.app')

@section('title', 'Edit Guide Book')
@section('header', 'Edit Guide Book')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6">
        <div id="notification" class="hidden mb-4 p-4 rounded"></div>

        <form id="editGuideBookForm" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 gap-6">
                <!-- Judul -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" name="title" id="title" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Kategori -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="category_id" id="category_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Pilih Kategori</option>
                    </select>
                </div>

                <!-- Konten -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">Konten</label>
                    <textarea name="content" id="content" rows="10" required
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                     focus:border-blue-500 focus:ring-blue-500"
                              placeholder="Masukkan konten panduan di sini..."></textarea>
                </div>

                <!-- Gambar -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Gambar Baru (Opsional)</label>
                    <input type="file" name="image" id="image" accept="image/*"
                           class="mt-1 block w-full">
                    <div id="current-image" class="mt-2"></div>
                </div>

                <!-- Video -->
                <div>
                    <label for="video" class="block text-sm font-medium text-gray-700">Video Baru (Opsional)</label>
                    <input type="file" name="video" id="video" accept="video/*"
                           class="mt-1 block w-full">
                    <div id="current-video" class="mt-2"></div>
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.guide-books.index') }}" 
                       class="px-4 py-2 text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
let guideBookId;

$(document).ready(function() {
    // Ambil ID dari URL
    const pathArray = window.location.pathname.split('/');
    guideBookId = pathArray[pathArray.length - 2];

    // Load data
    loadCategories();
    loadGuideBook();

    // Handle form submit
    $('#editGuideBookForm').on('submit', function(e) {
        e.preventDefault();
        updateGuideBook();
    });
});

function loadCategories() {
    const token = localStorage.getItem('token');
    
    $.ajax({
        url: '/api/admin/categories',
        type: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        },
        success: function(response) {
            if (response.success) {
                let select = $('#category_id');
                response.data.forEach(function(category) {
                    select.append(new Option(category.name, category.id));
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            showNotification('Gagal memuat kategori', 'error');
        }
    });
}

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
                const guideBook = response.data;
                $('#title').val(guideBook.title);
                $('#category_id').val(guideBook.category_id.id);
                $('#content').val(guideBook.content);

                // Tampilkan gambar jika ada
                if (guideBook.image_path) {
                    $('#current-image').html(`
                        <img src="/imagedb/guide_book/images/${guideBook.image_path}" 
                             alt="Current image" class="max-w-xs rounded">
                    `);
                }

                // Tampilkan video jika ada
                if (guideBook.video_path) {
                    $('#current-video').html(`
                        <video width="320" height="240" controls class="rounded">
                            <source src="/imagedb/guide_book/videos/${guideBook.video_path}" 
                                    type="video/mp4">
                            Browser Anda tidak mendukung tag video.
                        </video>
                    `);
                }
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            showNotification('Gagal memuat data guide book', 'error');
            if (xhr.status === 401) {
                window.location.href = '/login';
            }
        }
    });
}

function updateGuideBook() {
    const token = localStorage.getItem('token');
    let formData = new FormData($('#editGuideBookForm')[0]);
    
    // Tambahkan _method field untuk Laravel agar mengenali sebagai PUT request
    formData.append('_method', 'PUT');

    $.ajax({
        url: `/api/admin/guide-books/${guideBookId}`,
        type: 'POST', // Tetap menggunakan POST untuk upload file
        data: formData,
        headers: {
            'Authorization': `Bearer ${token}`,
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.success) {
                showNotification('Guide book berhasil diperbarui!', 'success');
                setTimeout(function() {
                    window.location.href = '/admin/guide-books';
                }, 1500);
            } else {
                showNotification(response.message || 'Terjadi kesalahan', 'error');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            if (xhr.status === 401) {
                window.location.href = '/login';
            } else if (xhr.status === 422) {
                // Validation errors
                const errors = xhr.responseJSON.errors;
                let errorMessage = '<ul>';
                Object.keys(errors).forEach(key => {
                    errorMessage += `<li>${errors[key][0]}</li>`;
                });
                errorMessage += '</ul>';
                showNotification(errorMessage, 'error');
            } else {
                showNotification('Terjadi kesalahan pada server', 'error');
            }
        }
    });
}

function showNotification(message, type = 'error') {
    const notification = $('#notification');
    
    notification.removeClass('bg-green-100 text-green-700 bg-red-100 text-red-700');
    
    if (type === 'success') {
        notification.addClass('bg-green-100 text-green-700');
    } else {
        notification.addClass('bg-red-100 text-red-700');
    }
    
    notification.html(message).removeClass('hidden');
    
    setTimeout(() => {
        notification.addClass('hidden');
    }, 3000);
}
</script>
@endpush
@endsection 