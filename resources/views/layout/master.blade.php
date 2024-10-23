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

            <!-- Bagian Kanan (WhatsApp, Instagram) -->
            <div class="navbar-right" style="display: flex; gap: 20px; align-items: center;">
            <a href="#" style="text-decoration: none;">
                <img src="whatsapp-icon.png" alt="WhatsApp" style="width: 25px; height: auto;">
            </a>
            <a href="#" style="text-decoration: none;">
                <img src="instagram-icon.png" alt="Instagram" style="width: 25px; height: auto;">
            </a>
            </div>
        </div>
    </div>

            <!-- <div id="header-sidebar"> -->
                <!-- <div class="sidebar-wrapper active">
                    <div class="sidebar-header">
                        <div class="d-flex justify-content-between">
                            <div class="logo">
                                <a href="{{route('profile')}}"><img src="{{asset('assets/images/logo/logo.png')}}" alt="Logo"></a>
                            </div>
                            <div class="toggler">
                                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-menu">
                        <ul class="menu">
                            <li class="sidebar-title">Menu</li>
                
                <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class='sidebar-link'>
                    <svg class="bi" width="0.5em" height="1em" fill="currentColor">
                                        <use xlink:href="{{asset('assets/vendors/bootstrap-icons/bootstrap-icons.svg#menu-down')}}"></use>
                                    </svg>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::is('marketplace') ? 'active' : '' }}">
                    <a href="{{ route('marketplace') }}" class='sidebar-link'>
                    <svg class="bi" width="1em" height="1em" fill="currentColor">
                                        <use xlink:href="{{asset('assets/vendors/bootstrap-icons/bootstrap-icons.svg#shop')}}"></use>
                                    </svg>
                        <span>marketplace</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::is('komunitas') ? 'active' : '' }}">
                    <a href="{{ route('komunitas') }}" class='sidebar-link'>
                    <svg class="bi" width="1em" height="1em" fill="currentColor">
                                        <use xlink:href="{{asset('assets/vendors/bootstrap-icons/bootstrap-icons.svg#people-fill')}}"></use>
                                    </svg>
                        <span>Komunitas</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::is('konsul') ? 'active' : '' }}">
                    <a href="{{ route('konsul') }}" class='sidebar-link'>
                    <svg class="bi" width="1em" height="1em" fill="currentColor">
                                        <use xlink:href="{{asset('assets/vendors/bootstrap-icons/bootstrap-icons.svg#chat-left-dots-fill')}}"></use>
                                    </svg>
                        <span>Konsultasi</span>
                    </a>
                </li>
            
                <li
                    class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                    <svg class="bi" width="1em" height="1em" fill="currentColor">
                                        <use xlink:href="{{asset('assets/vendors/bootstrap-icons/bootstrap-icons.svg#align-bottom')}}"></use>
                                    </svg>
                        <span>Components</span>
                    
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
            </div>
            <div id="main">
                <header class="mb-3">
                    <a href="#" class="burger-btn d-block d-xl-none">
                        <i class="bi bi-justify fs-3"></i>
                    </a>
                </header> -->
                




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
        </div>
        <script src="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
        
        <script src="{{asset('assets/vendors/apexcharts/apexcharts.js')}}"></script>
        <script src="{{asset('assets/js/pages/dashboard.js')}}"></script>

        <script src="{{asset('assets/js/mazer.js')}}"></script>
        <script>
            // Fungsi untuk mengubah status aktif berdasarkan ID link
            function toggleActiveState(linkId) {
                // Simpan ID dari link yang diklik ke localStorage
                localStorage.setItem('activeLink', linkId);
            }

            // Fungsi untuk mengatur link aktif saat halaman dimuat
            function setActiveLinkOnLoad() {
                // Ambil ID link yang disimpan dari localStorage
                var activeLinkId = localStorage.getItem('activeLink');

                if (activeLinkId) {
                    // Jika ada link yang disimpan, tambahkan kelas 'active' ke elemen tersebut
                    document.getElementById(activeLinkId).classList.add('active');
                }
            });
        }

        document.addEventListener("DOMContentLoaded", setActiveLink);
    </script>
</body>

</html>
