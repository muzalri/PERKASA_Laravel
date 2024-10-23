<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

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
    
    <style>
        /* CSS Inline untuk Font dan Navigasi */
        body {
            font-family: 'Nunito', sans-serif; /* Penerapan font Nunito di seluruh body */
            font-size: 20px; /* Ukuran font default */
        }

        .nav-link {
            transition: background-color 0.3s ease, color 0.3s ease, border-bottom 0.3s ease; /* Animasi transisi */
        }

        .nav-link.active {
            background-color: #007bff;
            color: white;
            border-bottom: 3px solid green; /* Garis hijau di bawah link yang aktif */
        }

        .underline-btn {
            background-color: #28a745; /* Warna hijau cerah */
            color: white;              /* Warna teks putih */
            border: none;              /* Hilangkan border */
            padding: 10px 20px;        /* Padding yang proporsional */
            font-size: 16px;           /* Ukuran teks yang pas */
            font-weight: bold;         /* Teks yang tebal */
            border-radius: 5px;        /* Sudut tombol membulat */
            cursor: pointer;           /* Mengubah kursor jadi pointer */
            transition: background-color 0.3s ease, transform 0.2s ease; /* Animasi hover */
        }

        .underline-btn:hover {
            background-color: #218838; /* Warna hijau lebih gelap saat di-hover */
            transform: scale(1.05);    /* Efek zoom saat di-hover */
        }

        .underline-btn:active{
            background-color: #1e7e34; /* Warna hijau lebih gelap saat diklik */
            transform: scale(1);       /* Kembali ke ukuran semula saat diklik */
        }
        
    </style>
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
        <div class="text-center px-8 py-4 text-gray-600">
            <div class="float-left">
                <p>2021 &copy; Mazer</p>
            </div>
            <div class="float-right">
                <p>Crafted with <span class="text-red-500"><i class="bi bi-heart"></i></span> by <a href="http://ahmadsaugi.com" class="text-blue-500 hover:underline">A. Saugi</a></p>
            </div>
        </div>
    </footer>
</body>

</html>
