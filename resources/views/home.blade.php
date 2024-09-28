<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rent Pro - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
        }
    </style>
</head>
<body class="bg-gray-100">
    <header class="bg-gray-800 text-white p-9 text-center">
        <h1 class="text-6xl mb-2 font-bold mb-4">Car Rent Pro</h1>
        <p class="text-lg">Manage Vehicle Rentals Seamlessly</p>
    </header>
    <main class="p-9">
        <section class="mb-12 text-center">
            <p class="text-xl text-gray-700">
                Free high-performance web service for vehicle rental management. Our API allows you to quickly and efficiently query and manage information on vehicles, customers, and reservations. Ideal for rental companies that need a practical and scalable solution to integrate into their systems.
            </p>
        </section>

        <section class="bg-white rounded-lg shadow-md p-8 mb-12">
            <h2 class="text-4xl font-semibold text-center text-gray-800 mb-8">Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="feature bg-gray-50 p-6 rounded-lg shadow-sm">
                    <h3 class="text-2xl font-bold mb-4">Vehicle Management</h3>
                    <p class="text-gray-600">Effortlessly add, edit, and manage vehicles available for rent.</p>
                </div>
                <div class="feature bg-gray-50 p-6 rounded-lg shadow-sm">
                    <h3 class="text-2xl font-bold mb-4">Customer Database</h3>
                    <p class="text-gray-600">Maintain a comprehensive customer database with detailed information.</p>
                </div>
                <div class="feature bg-gray-50 p-6 rounded-lg shadow-sm">
                    <h3 class="text-2xl font-bold mb-4">Reservation Tracking</h3>
                    <p class="text-gray-600">Track and manage all reservations in real-time, ensuring smooth operations.</p>
                </div>
            </div>
        </section>

        <section class="bg-gray-700 text-white p-12 rounded-lg text-center">
            <h2 class="text-3xl font-bold mb-4">Get Started with Car Rent Pro</h2>
            <p class="text-lg mb-8">Integrate our API into your system and streamline your vehicle rental management process.</p>
            <a href="{{ route('documentation') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-full transition">
                Explore the Documentation
            </a>
        </section>
    </main>

    <footer class="bg-gray-800 text-white p-6 text-center mt-12">
        <p>&copy; 2024 Car Rent Pro. All rights reserved.</p>
    </footer>
</body>
</html>
