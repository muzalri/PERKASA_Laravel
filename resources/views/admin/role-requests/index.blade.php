@extends('admin.layouts.app')

@section('title', 'Permintaan Perubahan Role')
@section('header', 'Manajemen Permintaan Role')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6">
        <!-- Loading State -->
        <div id="loading-state" class="animate-pulse">
            <div class="h-12 bg-gray-200 rounded mb-4"></div>
            <div class="h-12 bg-gray-200 rounded mb-4"></div>
            <div class="h-12 bg-gray-200 rounded mb-4"></div>
        </div>

        <div class="overflow-x-auto" id="role-requests-table" style="display: none;">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Pengguna
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Role yang Diminta
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal Permintaan
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="role-requests-content">
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadRoleRequests();
});

function loadRoleRequests() {
    const token = localStorage.getItem('token');
    
    $.ajax({
        url: '/api/admin/role-change-requests',
        type: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        },
        success: function(response) {
            if (response.success) {
                const tableBody = $('#role-requests-table tbody');
                tableBody.empty();
                
                response.data.forEach(request => {
                    tableBody.append(`
                        <tr>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">${request.user.name}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">${request.user.email}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">${request.requested_role}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">
                                    ${new Date(request.created_at).toLocaleDateString('id-ID')}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right text-sm font-medium">
                                <button onclick="acceptRequest(${request.id})" 
                                        class="text-green-600 hover:text-green-900 mr-3">
                                    <i class="fas fa-check"></i> Terima
                                </button>
                            </td>
                        </tr>
                    `);
                });
                
                $('#loading-state').hide();
                $('#role-requests-table').show();
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

function acceptRequest(id) {
    if (!confirm('Yakin ingin menerima permintaan perubahan role ini?')) {
        return;
    }

    const token = localStorage.getItem('token');
    fetch(`/api/admin/role-change-requests/${id}`, {
        method: 'POST',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Permintaan perubahan role berhasil diterima');
            loadRoleRequests();
        } else {
            alert(data.message || 'Gagal menerima permintaan perubahan role');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memproses permintaan');
    });
}
</script>
@endpush
@endsection