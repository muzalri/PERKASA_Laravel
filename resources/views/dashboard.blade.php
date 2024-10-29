@extends('layout.master')

@section('title', 'Dashboard')

@section('content')
<title>Dashboard Page</title>
    
</head>
<body>

    <!-- Main Content -->
    <main class="p-12 text-center bg-white min-h-screen">
        <h1 class="text-4xl mb-8">Selamat datang di Dashboard.</h1>
        <div class="flex justify-center flex-wrap gap-8">
            <a href="{{ route('komunitas') }}" class="bg-white border border-gray-200 p-6 w-64 rounded-lg shadow-md transition duration-300 ease-in-out hover:-translate-y-2 hover:shadow-lg">
                <h2 class="text-2xl mb-4">Komunitas</h2>
                <p class="text-base">Periksa komunitas Anda di sini.</p>
            </a>
            <a href="{{ route('konsultasi.index') }}" class="bg-white border border-gray-200 p-6 w-64 rounded-lg shadow-md transition duration-300 ease-in-out hover:-translate-y-2 hover:shadow-lg">
                <h2 class="text-2xl mb-4">Konsultasi</h2>
                <p class="text-base">Buat konsultasi Anda di sini.</p>
            </a>
            <a href="{{ route('guide-books.index') }}" class="bg-white border border-gray-200 p-6 w-64 rounded-lg shadow-md transition duration-300 ease-in-out hover:-translate-y-2 hover:shadow-lg">
                <h2 class="text-2xl mb-4">Panduan</h2>
                <p class="text-base">Lihat panduan di sini.</p>
            </a>
        </div>

        <div class="mt-8">
            <button type="button" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Ungu ke Biru</button>
            <button type="button" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Cyan ke Biru</button>
            <button type="button" class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Hijau ke Biru</button>
            <button type="button" class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Ungu ke Merah Muda</button>
            <button type="button" class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Merah Muda ke Oranye</button>
            <button type="button" class="text-gray-900 bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-teal-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Teal ke Lime</button>
            <button type="button" class="text-gray-900 bg-gradient-to-r from-red-200 via-red-300 to-yellow-200 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Merah ke Kuning</button>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            console.log("Dashboard Page Loaded");
            
            // Example JS functionality
            const cards = document.querySelectorAll('.card');

            cards.forEach(card => {
                card.addEventListener('click', function() {
                    alert(`You clicked on ${card.querySelector('h2').innerText}`);
                });
            });
        });
    </script>

</body>
</html>


@endsection
