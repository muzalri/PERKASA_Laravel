<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Link to Tailwind CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> -->
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

<body class="font-sans text-base">
    <div id="app">
    <nav class="bg-[#C7D9E4] text-gray-700 py-3">
        <div class="container mx-auto flex items-center">
            <!-- Logo/Nama Web -->
            <div class="flex items-center w-1/4">
                <img src="/assets/images/logo/logo.png" alt="Logo" class="w-12 h-auto mr-2">
                <span class="w-11 font-bold text-xl text-gray-700">Perkasa</span>
            </div>

            <!-- Navigasi Tengah -->
            <ul class="flex space-x-6 justify-center flex-grow items-center py-4">
                <li><a href="{{ route('dashboard') }}" class="hover:text-gray-900 transition duration-300 relative group">Dashboard
                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gray-700 transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></span>
                </a></li>
                <li><a href="{{ route('komunitas') }}" class="hover:text-gray-900 transition duration-300 relative group">Komunitas
                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gray-700 transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></span>
                </a></li>
                <li><a href="{{ route('konsultasi.index') }}" class="hover:text-gray-900 transition duration-300 relative group">Konsultasi
                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gray-700 transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></span>
                </a></li>
                <li><a href="{{ route('marketplace') }}" class="hover:text-gray-900 transition duration-300 relative group">Marketplace
                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gray-700 transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></span>
                </a></li>
                <li><a href="{{ route('guide-books.index') }}" class="hover:text-gray-900 transition duration-300 relative group">Panduan
                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gray-700 transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></span>
                </a></li>
            </ul>

            <!-- Navigasi Kanan -->
            <div class="flex items-center justify-end w-1/4">
                <a href="{{ route('profile') }}" class="hover:text-gray-900 transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </a>
            </div>
        </div>
    </nav>

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
