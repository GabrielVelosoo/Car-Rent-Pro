<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rent Pro - Documentation</title>
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
        <h1 class="text-6xl mb-2 font-bold mb-4">Car Rent Pro - Documentation</h1>
        <p class="text-lg">Manage Vehicle Rentals Seamlessly</p>
    </header>

    <main class="p-9">
        <section class="mb-12 text-center">
            <p class="text-lg text-gray-700">
                Welcome to the Car Rent Pro API documentation. This free high-performance web service allows you to efficiently manage vehicle rentals. You can query and manage information on vehicles, customers, and reservations. Ideal for rental companies looking for a scalable solution to integrate into their systems.
            </p>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl text-gray-800 font-bold mb-6">Accessing the webservice</h2>
            
            <!-- /brands -->
            <div class="mb-8">
                <h3 class="text-xl text-gray-700 font-bold mb-6">Car Brands</h3>
                <p class="text-base mb-4 text-gray-700">Use this URL to get car brands from the system.</p>
                <div class="mb-6">
                    <p class="text-gray-700">Brand query example:</p>
                    <a href="{{ route('brands') }}" class="text-blue-700 hover:underline">carrentpro-api.onrender.com/api/brands</a>
                </div>
            </div>
            
            <!-- /car-models -->
            <div class="mb-8">
                <h3 class="text-xl text-gray-700 font-bold mb-6">Car Models</h3>
                <p class="text-base mb-4 text-gray-700">Use this URL to get car models from the system.</p>
                <div class="mb-6">
                    <p class="text-gray-700">Car Models query example:</p>
                    <a href="{{ route('car-models') }}" class="text-blue-700 hover:underline">carrentpro-api.onrender.com/api/car-models</a>
                </div>
            </div>

            <!-- /cars -->
            <div class="mb-8">
                <h3 class="text-xl text-gray-700 font-bold mb-6">Cars</h3>
                <p class="text-base mb-4 text-gray-700">Use this URL to get cars from the system.</p>
                <div class="mb-6">
                    <p class="text-gray-700">Cars query example:</p>
                    <a href="{{ route('cars') }}" class="text-blue-700 hover:underline">carrentpro-api.onrender.com/api/cars</a>
                </div>
            </div>

            <!-- format response -->
            <h2 class="text-2xl text-gray-800 font-bold mb-6">Return Format</h2>
            
            <div class="mb-8">
                <p class="text-base mb-4 text-gray-700">See examples of accessing the webservice and the <strong>json</strong> response:</p>
                
                <!-- car brands response -->
                <div class="mb-6">
                    <h3 class="text-xl text-gray-700 font-bold mb-7">Response Example - Car Brands</h3>
                    <h3 class="text-lg text-gray-600 font-bold mb-5 ml-5">json</h3>
                    <p class="text-gray-700 ml-5">URL: <a href="{{ route('brands') }}" class="text-blue-700 hover:underline">carrentpro-api.onrender.com/brands</a></p>
                    <pre class="text-sm text-gray-700 p-4">
    [
        {
            "id": 3,
            "name": "MERCEDES-BENZ",
            "image": "images/z4uGrgdHHY8fbK1dprKimhctSm6OGRLS0jDajT4Z.png",
            "created_at": "2024-09-27T18:12:21.000000Z",
            "updated_at": "2024-09-27T18:12:21.000000Z",
            "car_models": [
            {
                "id": 2,
                "brand_id": 3,
                "name": "AMG G63",
                "image": "images/car_models/hIpxETzIXZt5ttmEc852ZLMWqL0Dz0vx7bezAy0Q.jpg",
                "number_ports": 4,
                "places": 5,
                "air_bag": 1,
                "abs": 1,
                "created_at": "2024-09-27T18:13:51.000000Z",
                "updated_at": "2024-09-27T18:13:51.000000Z"
            }
            ]
        }
    ]
                    </pre>
                </div>

                <!-- car models response -->
                <div class="mb-6">
                    <h3 class="text-xl text-gray-700 font-bold mb-7">Response Example - Car Models</h3>
                    <h3 class="text-lg text-gray-600 font-bold mb-5 ml-5">json</h3>
                    <p class="text-gray-700 ml-5">URL: <a href="{{ route('brands') }}" class="text-blue-700 hover:underline">carrentpro-api.onrender.com/car-models</a></p>
                    <pre class="text-sm text-gray-700 p-4">
    [
        {
            "id": 2,
            "brand_id": 3,
            "name": "AMG G63",
            "image": "images/car_models/hIpxETzIXZt5ttmEc852ZLMWqL0Dz0vx7bezAy0Q.jpg",
            "number_ports": 4,
            "places": 5,
            "air_bag": 1,
            "abs": 1,
            "created_at": "2024-09-27T18:13:51.000000Z",
            "updated_at": "2024-09-27T18:13:51.000000Z",
            "brand": {
                "id": 3,
                "name": "MERCEDES-BENZ",
                "image": "images/z4uGrgdHHY8fbK1dprKimhctSm6OGRLS0jDajT4Z.png",
                "created_at": "2024-09-27T18:12:21.000000Z",
                "updated_at": "2024-09-27T18:12:21.000000Z"
            }
        }
    ]
                    </pre>
                </div>

                <!-- cars response -->
                <div class="mb-6">
                    <h3 class="text-xl text-gray-700 font-bold mb-7">Response Example - Cars</h3>
                    <h3 class="text-lg text-gray-600 font-bold mb-5 ml-5">json</h3>
                    <p class="text-gray-700 ml-5">URL: <a href="{{ route('brands') }}" class="text-blue-700 hover:underline">carrentpro-api.onrender.com/cars</a></p>
                    <pre class="text-sm text-gray-700 p-4">
    [
        {
            "id": 1,
            "car_model_id": 2,
            "car_plate": "abcd1234",
            "available": 1,
            "km": 12350,
            "created_at": "2024-09-27T18:15:06.000000Z",
            "updated_at": "2024-09-27T18:15:06.000000Z",
            "rental_id": null,
            "car_model": {
                "id": 2,
                "brand_id": 3,
                "name": "AMG G63",
                "image": "images/car_models/hIpxETzIXZt5ttmEc852ZLMWqL0Dz0vx7bezAy0Q.jpg",
                "number_ports": 4,
                "places": 5,
                "air_bag": 1,
                "abs": 1,
                "created_at": "2024-09-27T18:13:51.000000Z",
                "updated_at": "2024-09-27T18:13:51.000000Z"
            },
            "rental": null
        }
    ]
                    </pre>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white p-6 text-center mt-12">
        <p>&copy; 2024 Car Rent Pro. All rights reserved.</p>
    </footer>
</body>
</html>
