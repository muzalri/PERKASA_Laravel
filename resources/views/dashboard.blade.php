@extends('layout.master')

@section('title', 'Dashboard')

@section('content')
<title>Dashboard Page</title>
    
</head>
<body>

    <!-- Main Content -->
    <main class="p-12 text-center bg-#f7f7f7 min-h-screen">
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
