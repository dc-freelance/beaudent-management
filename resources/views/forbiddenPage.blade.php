<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    <style>
        @import url(https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css);
    </style>
</head>

<body class="h-full bg-slate-200">
    <div class="min-w-screen min-h-screen bg-red-50 flex items-center p-5 lg:p-20 overflow-hidden relative">
        <div
            class="flex-1 min-h-full min-w-full rounded-3xl bg-white shadow-xl p-10 lg:p-20 text-gray-800 relative md:flex items-center text-center md:text-left">
            <div class="w-full md:w-1/2">
                <div class="mb-10 md:mb-20 text-gray-600 font-light">
                    <h1 class="font-black uppercase text-3xl lg:text-5xl text-orange-400 mb-10">Kesalahan 403. Akses
                        Tidak Diizinkan.
                    </h1>
                    <p>Kamu Tidak Diizinkan Untuk Mengakses Halaman Ini.</p>
                    <p>Kamu Harus Memiliki Izin untuk Mengakses Halaman Ini.</p>
                </div>
                <div class="mb-20 md:mb-0">
                    <button
                        class="text-lg font-light outline-none focus:outline-none transform transition-all hover:scale-110 text-orange-400 hover:text-orange-500 capitalize"><i
                            class="mdi mdi-arrow-left mr-2"></i>kembali</button>
                </div>
            </div>
            <div class="w-full md:w-1/2 text-center">
                <img src="{{ asset('assets/images/error-403.svg') }}" alt="img" class="">
            </div>
        </div>
        <div
            class="w-64 md:w-96 h-96 md:h-full bg-yellow-200 bg-opacity-30 absolute -top-64 md:-top-96 right-20 md:right-32 rounded-full pointer-events-none -rotate-45 transform">
        </div>
        <div
            class="w-96 h-full bg-yellow-200 bg-opacity-20 absolute -bottom-96 right-64 rounded-full pointer-events-none -rotate-45 transform">
        </div>
    </div>

</body>

</html>
