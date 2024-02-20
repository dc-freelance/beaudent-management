<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/logo.png') }}">
    <title>Login | Beauty Dental</title>
</head>

<body class="bg-gradient-to-r from-red-100 to-red-200 text-inter">
    <div class="container flex justify-center items-center h-screen mx-auto">
        <div
            class="lg:h-[75dvh] max-lg:mx-4 max-md:w-full md:w-full lg:w-1/2 rounded-lg shadow-[0_25px_60px_-40px_rgba(0,0,0,0.3)] shadow-white bg-white">

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo" width="150px" height="150px"
                class="mx-auto lg:mt-10 max-md:mt-5 md:mt-5">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="lg:px-14 max-md:px-4 md:px-14 sm:text-xs pb-11 mt-7 text-sm">
                    {{-- <label for="email" class="text-sm font-semibold text-slate-500">Email</label> --}}
                    <input id="email"
                        class="text-sm rounded-xl border border-slate-200 focus:ring-1 focus:ring-slate-400 focus:border-slate-100 transition duration-300 ease-in-out w-full placeholder:text-xs placeholder:capitalize"
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                        placeholder="enter your email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    <!-- Password -->
                    <div class="mt-2">
                        {{-- <label for="password" class="text-sm font-semibold text-slate-500">Password</label> --}}
                        <input id="password"
                            class="rounded-xl mt-3 border border-slate-200 w-full text-sm focus:border-slate-400 focus:ring-1 focus:ring-slate-400 transition duration-300 ease-in-out placeholder:text-xs placeholder:capitalize"
                            type="password" name="password" required autocomplete="current-password"
                            placeholder="enter your password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <button
                        class=" bg-primary text-white w-full font-bold text-center rounded-xl p-3 mt-6 active:bg-red-800 transition duration-300 ease-in-out sm:mt-6">
                        {{ __('Log in') }}
                    </button>

                    <div class="flex items-center justify-between mt-4" style="gap: 16px">
                        {{-- remember me --}}
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-pink-500 shadow-sm focus:ring-pink-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800 hover:cursor-pointer"
                                name="remember">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                        </label>

                        {{-- forgot pw --}}
                        @if (Route::has('password.request'))
                            <a class="text-sm text-primary" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                    <p class="text-center mt-3">Dont Have Accont? <a href="/register"
                            class="text-primary font-semibold">Sign Up</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <div id="loadingIndicator"
        class="fixed top-0 left-0 w-full h-full bg-opacity-60 bg-gray-800 flex items-center justify-center">
        <div id="loading" class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12 mb-4">
        </div>
    </div>

    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
