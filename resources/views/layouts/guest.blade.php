<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Beauty Dental') }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/logo.png') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-poppins text-gray-900">
    <div class="w-full">
        <div class="flex justify-center gap-5 w-full lg:p-5 p-3">
            <div class="lg:w-[30%] w-full text-center h-screen">
                {{ $slot }}
            </div>
        </div>
    </div>
    {{--  <div id="loadingIndicator"
        class="fixed top-0 left-0 w-full h-full bg-opacity-60 bg-gray-800 flex items-center justify-center z-50">
        <div id="loading" class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12 mb-4">
        </div>
    </div>  --}}

    {{-- custom js --}}
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
