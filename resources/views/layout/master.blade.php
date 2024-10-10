<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">

    

    
<link rel="stylesheet" href="{{asset('assets/vendors/iconly/bold.css')}}">

    <link rel="stylesheet" href="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.svg" type="image/x-icon')}}">
</head>



<body>
<div id="app">
    <div class="nav-container" style="display: flex; justify-content: space-between; align-items: center; padding: 10px 100px;">

        <!-- Bagian Kiri (Logo dan Nama Web) -->
        <div class="navbar-left" style="display: flex; align-items: center;">
            <img src="/assets/images/logo/logo.png" alt="Logo" style="width: 70px; height: auto; margin-right: 20px;">
            <span style="font-weight: bold; font-size: 18px;">Perkasa</span>
        </div>

        <!-- Bagian Tengah (Navigasi) -->
       <ul class="nav nav-tabs" id="myTab" role="tablist" style="display: flex; justify-content: center; align-items: center; gap: 20px; list-style: none; margin: 0;">
            <li class="nav-item" role="presentation">
                <a  class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="true">Dashboard</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#komunitas" role="tab" aria-controls="komunitas" aria-selected="false">Komunitas</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#konsultasi" role="tab" aria-controls="konsultasi" aria-selected="false">Konsultasi</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#marketplace" role="tab" aria-controls="marketplace" aria-selected="false">Marketplace</a>
            </li>
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


            <!-- <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div>
                </div>
            </footer> -->
        </div>
    </div>
    <script src="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    
<script src="{{asset('assets/vendors/apexcharts/apexcharts.js')}}"></script>
<script src="{{asset('assets/js/pages/dashboard.js')}}"></script>

    <script src="{{asset('assets/js/mazer.js')}}"></script>
</body>

</html>
