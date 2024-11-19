@extends('admin.layouts.app')

@section('title', 'Kategori')
@section('header', 'Manajemen Kategori')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold">Daftar Kategori</h2>
            <button onclick="showCreateModal()" 
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                <i class="fas fa-plus mr-2"></i>Tambah Kategori
            </button>
        </div>

        <!-- Loading State -->
        <div id="loading-state" class="animate-pulse">
            <div class="h-12 bg-gray-200 rounded mb-4"></div>
            <div class="h-12 bg-gray-200 rounded mb-4"></div>
            <div class="h-12 bg-gray-200 rounded mb-4"></div>
        </div>

        <div class="overflow-x-auto" id="categories-table" style="display: none;">
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
                <tbody class="bg-white divide-y divide-gray-200" id="categories-content">
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Kategori -->
<div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Tambah Kategori Baru</h3>
                <button onclick="hideCreateModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="createCategoryForm" onsubmit="createCategory(event)">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                    <input type="text" name="name" id="name" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="hideCreateModal()"
                            class="px-4 py-2 text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadCategories();
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
                const tableBody = $('#categories-content');
                tableBody.empty();
                
                response.data.forEach(category => {
                    tableBody.append(`
                        <tr>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">${category.name}</div>
                            </td>
                            <td class="px-6 py-4 text-right text-sm font-medium">
                                <button onclick="deleteCategory(${category.id})" 
                                        class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `);
                });
                
                $('#loading-state').hide();
                $('#categories-table').show();
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

function showCreateModal() {
    $('#createModal').removeClass('hidden');
}

function hideCreateModal() {
    $('#createModal').addClass('hidden');
    $('#createCategoryForm')[0].reset();
}

function createCategory(event) {
    event.preventDefault();
    
    const token = localStorage.getItem('token');
    const formData = {
        name: $('#name').val()
    };
    
    $.ajax({
        url: '/api/admin/categories',
        type: 'POST',
        data: JSON.stringify(formData),
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                alert('Kategori berhasil ditambahkan');
                hideCreateModal();
                loadCategories();
            } else {
                alert(response.message || 'Gagal menambahkan kategori');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;
                alert(Object.values(errors).flat().join('\n'));
            } else {
                alert('Terjadi kesalahan saat menambahkan kategori');
            }
        }
    });
}

function deleteCategory(id) {
    if (!confirm('Yakin ingin menghapus kategori ini?')) {
        return;
    }

    const token = localStorage.getItem('token');
    fetch(`/api/admin/categories/${id}`, {
        method: 'DELETE',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Kategori berhasil dihapus');
            loadCategories();
        } else {
            alert(data.message || 'Gagal menghapus kategori');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menghapus kategori');
    });
}
</script>
@endpush
@endsection 