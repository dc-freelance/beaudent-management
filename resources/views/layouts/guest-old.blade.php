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

<body class="font-sans text-gray-900">
    <div class="w-full min-h-screen flex flex-wrap justify-center items-center">
        <div class="w-full lg:h-[60dvh] absolute top-0 left-0 right-0">
            <div class="bg-primary absolute top-0 left-0 right-0 w-full h-full bg-opacity-10">
                <h1 class="text-slate-700 text-center font-bold text-2xl mt-16 z-50 uppercase">selamat datang</h1>
                <p class="text-center text-slate-700 z-50 capitalize">masuk untuk lanjut ke beauDent</p>
            </div>
            <img src="{{ asset('assets/images/bg.jpg') }}" alt="Jepun Image" class="object-cover w-full h-full" />
            <svg class="absolute -bottom-1 left-0 border-none" xmlns="http://www.w3.org/2000/svg" version="1.1"
                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"
                    fill="white">
                </path>
            </svg>
        </div>
        <img src="{{ asset('assets/images/no-pic.png') }}" alt="" width="80" height="80"
            class="rounded-full absolute z-50 top-[24%] max-md:top-[26%] max-md:w-14 max-md:h-14">
        <div
            class=" mx-auto h-[60dvh] pt-9 overflow-hidden rounded-lg max-lg:mx-4 md:w-1/2 lg:w-2/5 mt-16 bg-opacity-90 z-30">
            {{ $slot }}
        </div>
    </div>
    <div id="loadingIndicator"
        class="fixed top-0 left-0 w-full h-full bg-opacity-60 bg-gray-800 flex items-center justify-center z-50">
        <div id="loading" class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12 mb-4">
        </div>
    </div>

    {{-- custom js --}}
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
