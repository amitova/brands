<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Top Brands')</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen flex flex-col">
    <header class="bg-gray-800 text-white py-4">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold px-4 py-2">@yield('title', 'Top Brands')</h1>
        </div>
    </header>
    <div class="flex-grow pt-12 pb-12 px-4">
        @yield('content')
    </div>

     <footer class="bg-white text-gray-600 text-center py-4 border-t">
        <div class="container mx-auto text-sm text-gray-600">
            &copy; {{ date('Y') }} Top Brands App
        </div>
    </footer>

    @vite(['resources/js/app.js'])
    @stack('scripts')
</body>
</html>
