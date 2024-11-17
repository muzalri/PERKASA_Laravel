<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-gray-800">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <span class="text-white text-xl font-bold">Admin Panel</span>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('admin.articles.index') }}" class="text-gray-300 hover:text-white px-3 py-2">Artikel</a>
                    <a href="{{ route('admin.categories.index') }}" class="text-gray-300 hover:text-white px-3 py-2">Kategori</a>
                    <a href="{{ route('admin.guide-books.index') }}" class="text-gray-300 hover:text-white px-3 py-2">Panduan</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-300 hover:text-white px-3 py-2">Logout</button>
                    </form>
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
</body>
</html>