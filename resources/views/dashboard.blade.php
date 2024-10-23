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
    </style>
</head>
<body>

    <!-- Main Content -->
    <main class="dashboard-content">
        <h1>Welcome to the Dashboard1</h1>
        <div class="card-container">
            <div class="card">
                <h2>Community</h2>
                <p>Check your community here.</p>
            </div>
            <div class="card">
                <h2>Consultation</h2>
                <p>Make your consult here.</p>
            </div>
            <div class="card">
                <h2>Marketplace</h2>
                <p>Shop here.</p>
            </div>
        </div>


        <button type="button" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Purple to Blue</button>
        <button type="button" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Cyan to Blue</button>
        <button type="button" class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Green to Blue</button>
        <button type="button" class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Purple to Pink</button>
        <button type="button" class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Pink to Orange</button>
        <button type="button" class="text-gray-900 bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-teal-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Teal to Lime</button>
        <button type="button" class="text-gray-900 bg-gradient-to-r from-red-200 via-red-300 to-yellow-200 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Red to Yellow</button>


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