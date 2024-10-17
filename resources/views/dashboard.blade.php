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
        <h1>Welcome to the Dashboard</h1>
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