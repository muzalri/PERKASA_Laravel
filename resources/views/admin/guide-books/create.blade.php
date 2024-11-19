@extends('admin.layouts.app')

@section('title', 'Tambah Guide Book')
@section('header', 'Tambah Guide Book Baru')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6">
        <div id="notification" class="hidden mb-4 p-4 rounded"></div>

        <form id="createGuideBookForm" class="space-y-6">
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
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                </div>

                <!-- Gambar -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Gambar</label>
                    <input type="file" name="image" id="image" accept="image/*"
                           class="mt-1 block w-full">
                </div>

                <!-- Video -->
                <div>
                    <label for="video" class="block text-sm font-medium text-gray-700">Video</label>
                    <input type="file" name="video" id="video" accept="video/*"
                           class="mt-1 block w-full">
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.guide-books.index') }}" 
                       class="px-4 py-2 text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>  
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Load kategori saat halaman dimuat
    loadCategories();
    
    // Handle form submit
    $('#createGuideBookForm').on('submit', function(e) {
        e.preventDefault();
        createGuideBook();
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

function createGuideBook() {
    const token = localStorage.getItem('token');
    let formData = new FormData($('#createGuideBookForm')[0]);
    
    // Ambil konten dari textarea biasa
    formData.append('content', $('#content').val());

    $.ajax({
        url: '/api/admin/guide-books',
        type: 'POST',
        data: formData,
        headers: {
            'Authorization': `Bearer ${token}`,
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.success) {
                showNotification('Guide book berhasil dibuat!', 'success');
                setTimeout(function() {
                    window.location.href = '/admin/guide-books';
                }, 1000);
            } else {
                showNotification(response.message || 'Terjadi kesalahan', 'error');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            showNotification('Terjadi kesalahan pada server', 'error');
        }
    });
}

function showNotification(message, type) {
    let notification = $('#notification');
    
    if (type === 'success') {
        notification.removeClass().addClass('mb-4 p-4 rounded bg-green-100 text-green-700');
    } else {
        notification.removeClass().addClass('mb-4 p-4 rounded bg-red-100 text-red-700');
    }
    
    notification.text(message).show();
}
</script>
@endpush
@endsection 