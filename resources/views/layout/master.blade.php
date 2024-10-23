<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Link to Tailwind CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> -->
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
    @vite('resources/css/app.css')
    
</head>

<body class="font-sans text-base">
    <div id="app">
        <div class="flex justify-between items-center px-8 py-4 bg-gray-100 shadow-sm">
            <!-- Bagian Kiri (Logo dan Nama Web) -->
            <div class="flex items-center">
                <img src="/assets/images/logo/logo.png" alt="Logo" class="w-10 h-auto mr-3">
                <span class="font-bold text-2xl">Perkasa</span>
            </div>

            <!-- Bagian Tengah (Navigasi) -->
            <ul class="flex justify-center items-center space-x-4 list-none m-0">
                <li class="nav-item">
                    <a class="nav-link text-sm" id="dashboardLink" onclick="toggleActiveState('dashboardLink')" href="{{route('dashboard')}}" aria-controls="dashboard" aria-selected="true">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-sm" id="komunitasLink" onclick="toggleActiveState('komunitasLink')" href="{{route('komunitas')}}" aria-controls="komunitas" aria-selected="false">Komunitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-sm" id="konsulLink" onclick="toggleActiveState('konsulLink')" href="{{route('konsultasi.index')}}" aria-controls="konsultasi" aria-selected="false">Konsultasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-sm" id="marketplaceLink" onclick="toggleActiveState('marketplaceLink')" href="{{route('marketplace')}}" aria-controls="marketplace" aria-selected="false">Marketplace</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-sm" id="profileLink" onclick="toggleActiveState('profileLink')" href="{{route('profile')}}" aria-controls="profile" aria-selected="false">Profil</a>
                </li>
                <a class="nav-link" href="{{ route('guide_books.index') }}">Panduan</a>
            </li>
            </ul>

            <!-- Bagian Kanan (WhatsApp, Instagram) -->
            <div class="flex space-x-3 items-center">
                <a href="#" class="no-underline">
                    <img src="whatsapp-icon.png" alt="WhatsApp" class="w-5 h-auto">
                </a>
                <a href="#" class="no-underline">
                    <img src="instagram-icon.png" alt="Instagram" class="w-5 h-auto">
                </a>
            </div>
        </div>
    </div>





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
    </footer>
</body>

</html>
