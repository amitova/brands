<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Top Brands')</title>
    @vite(['resources/css/app.css'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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
{{-- Fixed footer --}}
    <footer class="fixed bottom-0 left-0 right-0 bg-white text-gray-600 text-center py-2 border-t shadow-inner z-50">
        <div class="container mx-auto text-sm text-gray-600">
            &copy; {{ date('Y') }} Top Brands App
        </div>
    </footer>

    {{-- Back to Top button --}}
    <button id="backToTop"
        class="hidden fixed bottom-20 right-4 bg-gray-800 text-white w-10 h-10 rounded-full flex items-center justify-center shadow-lg hover:bg-gray-700 z-50 transition"
        aria-label="Back to Top">
        <i class="bi bi-arrow-up text-white"></i>
    </button>
    @vite(['resources/js/app.js'])
    @stack('scripts')
</body>
</html>
