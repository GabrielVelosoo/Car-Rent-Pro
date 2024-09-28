<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Car Rent Pro API Home: Manage vehicle rentals efficiently with a scalable web service. Find information on car brands, models, and availability.">
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
    @include('site.layouts._partials.header')

    @include('site.layouts._partials.menu')

    <main class="p-6 sm:p-9">
        @component('site.layouts._components.main_home')
        @endcomponent
    </main>

    @include('site.layouts._partials.footer')
</body>
</html>
