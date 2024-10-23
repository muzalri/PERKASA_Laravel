<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Link to Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Preconnect and Link to Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">


    <!-- Bootstrap and Custom CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/iconly/bold.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.svg')}}" type="image/x-icon">
    
    <style>
        /* Custom Inline CSS */
        body {
            font-family: 'Nunito', sans-serif;
        }
        .nav-link {
            @apply text-gray-800 hover:bg-blue-500 hover:text-white transition-all px-4 py-2 rounded-lg;
        }
        .nav-link.active {
            @apply bg-blue-500 text-white;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div id="app">
        <!-- Navigation -->
        <nav class="bg-white shadow-md">
            <div class="container mx-auto px-6 py-3">
                <div class="flex justify-between items-center">
                    <!-- Left Side (Logo and Website Name) -->
                    <div class="flex items-center">
                        <img src="/assets/images/logo/logo.png" alt="Logo" class="w-12 h-auto mr-4">
                        <span class="text-2xl font-bold text-gray-800">Perkasa</span>
                    </div>

                    <!-- Navigation Links -->
                    <ul class="flex space-x-4">
                        <li><a class="nav-link" id="dashboardLink" href="{{route('dashboard')}}">Dashboard</a></li>
                        <li><a class="nav-link" id="komunitasLink" href="{{route('komunitas')}}">Komunitas</a></li>
                        <li><a class="nav-link" id="konsulLink" href="{{route('konsultasi.index')}}">Konsultasi</a></li>
                        <li><a class="nav-link" id="marketplaceLink" href="{{route('marketplace')}}">Marketplace</a></li>
                        <li><a class="nav-link" id="profileLink" href="{{route('profile')}}">Profil</a></li>
                        <li><a class="nav-link" id="guideLink" href="{{ route('guide_books.index') }}">Panduan</a></li>
                    </ul>

                    <!-- Right Side (Social Icons) -->
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-600 hover:text-gray-800">
                            <i class="bi bi-whatsapp text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-600 hover:text-gray-800">
                            <i class="bi bi-instagram text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="container mx-auto p-8">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white shadow-md mt-12">
            <div class="container mx-auto px-6 py-4">
                <div class="flex justify-between items-center">
                    <p class="text-gray-600">&copy; 2023 Perkasa. All rights reserved.</p>
                    <p class="text-gray-600">Crafted with <span class="text-red-500"><i class="bi bi-heart-fill"></i></span> by <a href="http://ahmadsaugi.com" class="text-blue-500 hover:underline">A. Saugi</a></p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script>
        // Custom JavaScript for Active Link
        function setActiveLink() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        }

        document.addEventListener("DOMContentLoaded", setActiveLink);
    </script>
</body>

</html>
