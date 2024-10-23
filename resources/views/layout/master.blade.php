<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

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

<body>
    <div id="app">
        <div class="nav-container" style="display: flex; justify-content: space-between; align-items: center; padding: 40px 100px; background-color: #f8f9fa;">

            <!-- Bagian Kiri (Logo dan Nama Web) -->
            <div class="navbar-left" style="display: flex; align-items: center; align-items: center;">
                <img src="/assets/images/logo/logo.png" alt="Logo" style="width: 70px; height: auto; margin-right: 20px;">
                <span style="font-weight: bold; font-size: 35px;">Perkasa</span>
            </div>

            <!-- Bagian Tengah (Navigasi) -->
            <ul class="nav nav-tabs" id="myTab" style="display: flex; justify-content: center; align-items: center; gap: 20px; list-style: none; margin: 0;">
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="dashboardLink" onclick="toggleActiveState('dashboardLink')" href="{{route('dashboard')}}" aria-controls="dashboard" aria-selected="true">Dashboard</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="komunitasLink" onclick="toggleActiveState('komunitasLink')" href="{{route('komunitas')}}" aria-controls="komunitas" aria-selected="false">Komunitas</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="konsulLink" onclick="toggleActiveState('konsulLink')" href="{{route('konsultasi.index')}}" aria-controls="konsultasi" aria-selected="false">Konsultasi</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="marketplaceLink" onclick="toggleActiveState('marketplaceLink')" href="{{route('marketplace')}}" aria-controls="marketplace" aria-selected="false">Marketplace</a>
                </li>   
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('guide_books.index') }}">Panduan</a>
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
            }
            event.preventDefault()

            // Panggil fungsi untuk mengatur link aktif saat halaman dimuat


            document.addEventListener("DOMContentLoaded", function() {
                setActiveLinkOnLoad();
            });
        </script>

</body>

</html>
