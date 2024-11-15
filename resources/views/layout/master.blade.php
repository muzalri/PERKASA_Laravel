<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Link to Tailwind CSS -->
    @vite('resources/css/app.css')
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
    
    <!-- Tambahkan ini di bagian head -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- CSS lainnya -->
    @stack('styles')
</head>

<body class="min-h-screen flex flex-col">
    <nav class="bg-gradient-to-r from-perkasa-blue to-sky-600 text-black py-2 sticky top-0 z-50 border-b-8 border-white">
        <div class="container mx-auto flex items-center">
            <!-- Logo/Nama Web -->
            <div class="flex items-center w-1/4">
                <span class="w-11 font-bold text-xl text-white">Perkasa</span>
            </div>

            <!-- Navigasi Tengah -->
            <ul class="flex space-x-6 justify-center flex-grow items-center pt-3">
                <li><a href="{{ route('dashboard') }}" class="text-white hover:text-gray-200 transition duration-300 relative group">Dashboard
                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-white transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></span>
                </a></li>
                <li><a href="{{ route('komunitas') }}" class="text-white hover:text-gray-200 transition duration-300 relative group">Komunitas
                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-white transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></span>
                </a></li>
                <li><a href="{{ route('konsultasi.index') }}" class="text-white hover:text-gray-200 transition duration-300 relative group">Konsultasi
                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-white transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></span>
                </a></li>
                <li><a href="{{ route('marketplace') }}" class="text-white hover:text-gray-200 transition duration-300 relative group">Marketplace
                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-white transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></span>
                </a></li>
                <li><a href="{{ route('guide-books.index') }}" class="text-white hover:text-gray-200 transition duration-300 relative group">Panduan
                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-white transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></span>
                </a></li>
            </ul>

            <!-- Navigasi Kanan -->
            <div class="flex items-center justify-end w-1/4 -mt-2">
                <a href="{{ route('profile') }}" class="text-white hover:text-gray-200 transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </a>
            </div>
        </div>
    </nav>

    <div class="flex-grow">
        @yield('content')
    </div>

    <footer class="bg-gradient-to-r from-perkasa-blue to-sky-600 text-white py-8 w-full">
        <div class="container mx-auto flex justify-between">
            <div>
                <h2 class="font-bold text-lg text-white">Perkasa</h2>
                <p class="text-sky-100">Platform inovatif yang memberdayakan anak muda Indonesia.</p>
                <div class="flex space-x-4 mt-4">
                    <a href="#" class="text-white hover:text-gray-200 transition-colors"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white hover:text-gray-200 transition-colors"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-white hover:text-gray-200 transition-colors"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="text-white hover:text-gray-200 transition-colors"><i class="bi bi-pinterest"></i></a>
                </div>
            </div>
            <div class="flex space-x-8">
                <div>
                    <h3 class="font-semibold text-white">Services</h3>
                    <ul>
                        <li><a href="{{ route('dashboard') }}" class="text-sky-100 hover:text-white transition-colors">Dashboard</a></li>
                        <li><a href="{{ route('komunitas') }}" class="text-sky-100 hover:text-white transition-colors">Komunitas</a></li>
                        <li><a href="{{ route('konsultasi.index') }}" class="text-sky-100 hover:text-white transition-colors">Konsultasi</a></li>
                        <li><a href="{{ route('marketplace') }}" class="text-sky-100 hover:text-white transition-colors">Marketplace</a></li>
                        <li><a href="{{ route('guide-books.index') }}" class="text-sky-100 hover:text-white transition-colors">Panduan</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-white">Resources</h3>
                    <ul>
                        <li><a href="#" class="text-sky-100 hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="text-sky-100 hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="#" class="text-sky-100 hover:text-white transition-colors">Support</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>


</html>