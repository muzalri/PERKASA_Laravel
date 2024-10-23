<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

<<<<<<< Updated upstream
    <!-- Link to Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
=======
    <!-- Preconnect and Link to Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Bootstrap and Custom CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/iconly/bold.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.svg')}}" type="image/x-icon">
>>>>>>> Stashed changes
    
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
<<<<<<< Updated upstream
                <li>
                    <a class="text-gray-800 hover:bg-blue-500 hover:text-white transition-all px-4 py-2 rounded-lg" href="{{route('konsul')}}">Konsultasi</a>
=======
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="konsulLink" onclick="toggleActiveState('konsulLink')" href="{{route('konsultasi.index')}}" aria-controls="konsultasi" aria-selected="false">Konsultasi</a>
>>>>>>> Stashed changes
                </li>
                <li>
                    <a class="text-gray-800 hover:bg-blue-500 hover:text-white transition-all px-4 py-2 rounded-lg" href="{{route('marketplace')}}">Marketplace</a>
                </li>
                <!-- Tambahkan pilihan profil di sini -->
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profileLink" onclick="toggleActiveState('profileLink')" href="{{route('profile')}}" aria-controls="profile" aria-selected="false">Profil</a>
                </li>
                <li class="nav-item">
    <a class="nav-link" href="{{ route('guide_books.index') }}">Panduan</a>
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

<<<<<<< Updated upstream
        <!-- Main Content -->
        <div class="container mx-auto p-8">
            @yield('content')
=======
     



        @yield('content')


                <footer>
                    <div class="footer clearfix mb-0 text-muted" style="text-align: center; padding-left: 30px; padding-right: 30px;">
                        <div class="float-start">
                            <p>2021 &copy; Mazer</p>
                        </div>
                        <div class="float-end">
                            <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                    href="http://ahmadsaugi.com">A. Saugi</a></p>
                        </div>
                    </div>
                </footer>
            </div>
>>>>>>> Stashed changes
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
