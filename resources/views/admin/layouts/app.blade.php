<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - @yield('title')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    @stack('scripts')
</head>
<body class="bg-gray-100">
    <script>
    // Cek token saat halaman dimuat
    $(document).ready(function() {
        const token = localStorage.getItem('token');
        if (!token) {
            window.location.replace('/login');
            return;
        }

        // Verifikasi token
        $.ajax({
            url: '/api/admin/verify-token',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            },
            success: function(response) {
                if (!response.success) {
                    localStorage.removeItem('token');
                    localStorage.removeItem('user');
                    window.location.replace('/login');
                }
            },
            error: function() {
                localStorage.removeItem('token');
                localStorage.removeItem('user');
                window.location.replace('/login');
            }
        });
    });
    </script>

    <!-- Navbar -->
    <nav class="bg-gray-800">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="text-white text-xl font-bold">Admin Panel</a>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('admin.articles.index') }}" class="text-gray-300 hover:text-white px-3 py-2">Artikel</a>
                    <a href="{{ route('admin.categories.index') }}" class="text-gray-300 hover:text-white px-3 py-2">Kategori</a>
                    <a href="{{ route('admin.guide-books.index') }}" class="text-gray-300 hover:text-white px-3 py-2">Panduan</a>
                    <button onclick="logout()" class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Logout
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="max-w-7xl mx-auto py-6 px-4">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <script>
    // Handle logout
    function logout() {
        if (!confirm('Yakin ingin keluar?')) {
            return;
        }

        const token = localStorage.getItem('token');
        
        fetch('/api/admin/logout', {
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
                localStorage.removeItem('token');
                window.location.href = '/login';
            } else {
                alert(data.message || 'Gagal logout');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat logout');
        });
    }
    </script>
</body>
</html>