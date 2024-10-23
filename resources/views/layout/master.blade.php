<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Link to Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <style>
        /* Custom Inline CSS */
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div id="app">
        <!-- Navigation -->
        <div class="flex justify-between items-center px-24 py-10 bg-gray-200">
            <!-- Left Side (Logo and Website Name) -->
            <div class="flex items-center">
                <img src="/assets/images/logo/logo.png" alt="Logo" class="w-16 h-auto mr-4">
                <span class="text-3xl font-bold">Perkasa</span>
            </div>

            <!-- Navigation Links -->
            <ul class="flex space-x-8">
                <li>
                    <a class="text-gray-800 hover:bg-blue-500 hover:text-white transition-all px-4 py-2 rounded-lg" href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li>
                    <a class="text-gray-800 hover:bg-blue-500 hover:text-white transition-all px-4 py-2 rounded-lg" href="{{route('komunitas')}}">Komunitas</a>
                </li>
                <li>
                    <a class="text-gray-800 hover:bg-blue-500 hover:text-white transition-all px-4 py-2 rounded-lg" href="{{route('konsul')}}">Konsultasi</a>
                </li>
                <li>
                    <a class="text-gray-800 hover:bg-blue-500 hover:text-white transition-all px-4 py-2 rounded-lg" href="{{route('marketplace')}}">Marketplace</a>
                </li>
            </ul>

            <!-- Right Side (Social Icons) -->
            <div class="flex space-x-4">
                <a href="#" class="hover:opacity-75">
                    <img src="whatsapp-icon.png" alt="WhatsApp" class="w-6 h-auto">
                </a>
                <a href="#" class="hover:opacity-75">
                    <img src="instagram-icon.png" alt="Instagram" class="w-6 h-auto">
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto p-8">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="text-center py-6 bg-gray-200">
            <p>2021 &copy; Mazer</p>
            <p>Crafted with <span class="text-red-500"><i class="bi bi-heart"></i></span> by <a href="http://ahmadsaugi.com" class="text-blue-500">A. Saugi</a></p>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script>
        // Custom JavaScript for Active Link
        function toggleActiveState(linkId) {
            localStorage.setItem('activeLink', linkId);
        }

        function setActiveLinkOnLoad() {
            var activeLinkId = localStorage.getItem('activeLink');
            if (activeLinkId) {
                document.getElementById(activeLinkId).classList.add('active');
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            setActiveLinkOnLoad();
        });
    </script>
</body>

</html>
