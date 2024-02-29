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

        .st0 {
            fill: #fff
        }

        .st1 {
            fill: #b5dfea
        }

        .st2 {
            opacity: .55;
            fill: #90cedd
        }

        .st3 {
            fill: #d7f0f9
        }

        .st4 {
            fill: #0582c1
        }

        .st5 {
            fill: #79c9e8
        }

        .st6 {
            fill: #ffbf4d
        }

        .st7 {
            fill: #00668e
        }

        .st8 {
            fill: #05556d
        }

        .st9 {
            fill: #f98d3d
        }

        .st10 {
            fill: #ed701b
        }

        .st11 {
            fill: none
        }

        .st12 {
            fill: #efaa3a
        }

        .st13 {
            opacity: .29;
            fill: #f98d2b
        }

        .st14 {
            fill: #49b4d6
        }

        .st15 {
            fill: #ff9f50
        }

        .st16 {
            fill: #f77e2d
        }

        .st17 {
            opacity: .55;
            fill: url(#SVGID_1_)
        }
    </style>
</head>

<body class="h-full bg-slate-200">
    <div class="min-w-screen min-h-screen bg-red-50 flex items-center p-5 lg:p-20 overflow-hidden relative">
        <div
            class="flex-1 min-h-full min-w-full rounded-3xl bg-white shadow-xl p-10 lg:p-20 text-gray-800 relative md:flex items-center text-center md:text-left">
            <div class="w-full md:w-1/2">
                <div class="mb-10 md:mb-20 text-gray-600 font-light">
                    <h1 class="font-black uppercase text-3xl lg:text-5xl text-red-400 mb-10">Kesalahan 403. Akses
                        Tidak Diizinkan.
                    </h1>
                    <p>Kamu Tidak Diizinkan Untuk Mengakses Halaman Ini.</p>
                    <p>Kamu Harus Memiliki Izin untuk Mengakses Halaman Ini.</p>
                </div>
                <div class="mb-20 md:mb-0">
                    <button
                        class="text-lg font-light outline-none focus:outline-none transform transition-all hover:scale-110 text-red-400 hover:text-red-500 capitalize"><i
                            class="mdi mdi-arrow-left mr-2"></i>kembali</button>
                </div>
            </div>
            <div class="w-full md:w-1/2 text-center">
                <img src="{{ asset('assets/images/error-403.svg') }}" alt="img">
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
