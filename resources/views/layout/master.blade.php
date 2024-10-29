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
    
</head>

<body class="min-h-screen flex flex-col">
    <nav class="bg-perkasa-blue text-black py-2 sticky top-0">
        <div class="container mx-auto flex items-center">
            <!-- Logo/Nama Web -->
            <div class="flex items-center w-1/4">
                <span class="w-11 font-bold text-xl text-gray-700">Perkasa</span>
            </div>

            <!-- Navigasi Tengah -->
            <ul class="flex space-x-6 justify-center flex-grow items-center pt-3">
                <li><a href="{{ route('dashboard') }}" class="text-black hover:text-gray-900 transition duration-300 relative group">Dashboard
                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gray-700 transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></span>
                </a></li>
                <li><a href="{{ route('komunitas') }}" class="text-black hover:text-gray-900 transition duration-300 relative group">Komunitas
                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gray-700 transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></span>
                </a></li>
                <li><a href="{{ route('konsultasi.index') }}" class="text-black hover:text-gray-900 transition duration-300 relative group">Konsultasi
                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gray-700 transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></span>
                </a></li>
                <li><a href="{{ route('marketplace') }}" class="text-black hover:text-gray-900 transition duration-300 relative group">Marketplace
                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gray-700 transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></span>
                </a></li>
                <li><a href="{{ route('guide-books.index') }}" class="text-black hover:text-gray-900 transition duration-300 relative group">Panduan
                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gray-700 transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></span>
                </a></li>
            </ul>

            <!-- Navigasi Kanan -->
            <div class="flex items-center justify-end w-1/4 -mt-2">
                <a href="{{ route('profile') }}" class="hover:text-gray-900 transition duration-300">
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

    <footer class="bg-perkasa-blue text-black py-8 w-full">
        <div class="container mx-auto flex justify-between">
            <div>
                <h2 class="font-bold text-lg">Perkasa</h2>
                <p>Platform inovatif yang memberdayakan anak muda Indonesia.</p>
                <div class="flex space-x-4 mt-4">
                    <a href="#" class="text-black"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-black"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-black"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="text-black"><i class="bi bi-pinterest"></i></a>
                </div>
            </div>
            <div class="flex space-x-8">
                <div>
                    <h3 class="font-semibold">Services</h3>
                    <ul>
                        <li><a href="{{ route('dashboard') }}" class="hover:underline text-black">Dashboard</a></li>
                        <li><a href="{{ route('komunitas') }}" class="hover:underline text-black">Komunitas</a></li>
                        <li><a href="{{ route('konsultasi.index') }}" class="hover:underline text-black">Konsultasi</a></li>
                        <li><a href="{{ route('marketplace') }}" class="hover:underline text-black">Marketplace</a></li>
                        <li><a href="{{ route('guide-books.index') }}" class="hover:underline text-black">Panduan</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold">Resources</h3>
                    <ul>
                        <li><a href="#" class="hover:underline text-black">Pricing</a></li>
                        <li><a href="#" class="hover:underline text-black">FAQs</a></li>
                        <li><a href="#" class="hover:underline text-black">Contact Support</a></li>
                        <li><a href="#" class="hover:underline text-black">Privacy Policy</a></li>
                        <li><a href="#" class="hover:underline text-black">Terms</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold">Support</h3>
                    <ul>
                        <li><a href="#" class="hover:underline text-black">Contact</a></li>
                        <li><a href="#" class="hover:underline text-black">Affiliates</a></li>
                        <li><a href="#" class="hover:underline text-black">Sitemap</a></li>
                        <li><a href="#" class="hover:underline text-black">Cancellation Policy</a></li>
                        <li><a href="#" class="hover:underline text-black">Pricing</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>


</html>