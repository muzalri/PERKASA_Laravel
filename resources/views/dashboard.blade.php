@extends('layout.master')

@section('title', 'Dashboard')

@section('content')
<title>Dashboard Page</title>
    <style>
        /* Reset margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Dashboard Content */
        .dashboard-content {
            padding: 50px 30px;
            text-align: center;
            background-color: #ffffff;
            min-height: 100vh;
        }

        .dashboard-content h1 {
            font-size: 36px;
            margin-bottom: 30px;
        }

        /* Card Container */
        .card-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .card {
            background-color: white;
            border: 1px solid #ddd;
            padding: 20px;
            width: 250px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h2 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .card p {
            font-size: 16px;
        }

        .btn-gradient {
            @apply text-white bg-gradient-to-r hover:bg-gradient-to-bl focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 transition duration-300 ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Main Content -->
    <main class="container mx-auto p-8 text-center">
        <h1 class="text-4xl font-bold mb-8 text-gray-800">Selamat datang di Dashboard</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg shadow-md p-6 transition duration-300 ease-in-out hover:-translate-y-1 hover:shadow-lg">
                <h2 class="text-2xl font-semibold mb-4 text-gray-700">Komunitas</h2>
                <p class="text-gray-600">Periksa komunitas Anda di sini.</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 transition duration-300 ease-in-out hover:-translate-y-1 hover:shadow-lg">
                <h2 class="text-2xl font-semibold mb-4 text-gray-700">Konsultasi</h2>
                <p class="text-gray-600">Buat konsultasi Anda di sini.</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 transition duration-300 ease-in-out hover:-translate-y-1 hover:shadow-lg">
                <h2 class="text-2xl font-semibold mb-4 text-gray-700">Marketplace</h2>
                <p class="text-gray-600">Belanja di sini.</p>
            </div>
        </div>

        <div class="mt-12 space-y-4">
            <button class="btn-gradient from-purple-600 to-blue-500">Ungu ke Biru</button>
            <button class="btn-gradient from-cyan-500 to-blue-500">Cyan ke Biru</button>
            <button class="btn-gradient from-green-400 to-blue-600">Hijau ke Biru</button>
            <button class="btn-gradient from-purple-500 to-pink-500">Ungu ke Merah Muda</button>
            <button class="btn-gradient from-pink-500 to-orange-400">Merah Muda ke Oranye</button>
            <button class="btn-gradient from-teal-200 to-lime-200 text-gray-900">Teal ke Lime</button>
            <button class="btn-gradient from-red-200 via-red-300 to-yellow-200 text-gray-900">Merah ke Kuning</button>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            console.log("Dashboard Page Loaded");
            
            // Example JS functionality
            const cards = document.querySelectorAll('.bg-white');

            cards.forEach(card => {
                card.addEventListener('click', function() {
                    alert(`Anda mengklik ${card.querySelector('h2').innerText}`);
                });
            });
        });
    </script>

</body>

@endsection
