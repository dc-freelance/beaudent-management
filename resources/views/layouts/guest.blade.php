<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Beauty Dental') }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-gradient-to-r from-red-100 to-red-200">
    <div class="container mx-auto min-h-screen flex justify-center items-center pt-6 dark:bg-gray-900">
        <div
            class="w-full  px-6 mx-auto pb-14 pt-9 bg-white dark:bg-gray-800 shadow-xl overflow-hidden rounded-lg md:w-1/2 lg:w-1/2 max-lg:mx-4 lg:px-16">
            <a href="/">
                <img src="{{ asset('assets/images/logo.png') }}" class="fill-current mx-auto text-gray-500 mb-3"
                    width="150" height="150" />
            </a>
            {{ $slot }}
        </div>
    </div>
    <div id="loadingIndicator"
        class="fixed top-0 left-0 w-full h-full bg-opacity-60 bg-gray-800 flex items-center justify-center">
        <div id="loading" class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12 mb-4">
        </div>
    </div>

    {{-- custom js --}}
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
