<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register | Beauty Dental</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/logo.png') }}">
</head>

<body>
    <section class="bg-gradient-to-r from-red-100 to-red-200 text-inter">
        <div class="container h-screen mx-auto flex justify-center items-center">
            <div class="lg:h[70dvh] mx-auto lg:w-1/2 shadow-xl px-6 rounded-lg bg-white max-md:w-full max-md:mx-4">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="lg:px-14 max-md:px-4 md:px-14 sm:text-xs pb-11 mt-7 text-sm">
                        <div class="flex justify-between">
                            <h1 class="text-lg text-black font-semibold uppercase text-center mt-6">register</h1>
                            <img src="{{ asset('assets/images/logo.png') }}" alt="img" width="150px"
                                height="150px">
                        </div>
                        {{-- <label for="name" class="text-sm font-semibold text-slate-600 capitalize">name</label> --}}
                        <input id="name"
                            class="mt-1 w-full p-2 rounded-xl text-sm border border-slate-200 placeholder:text-xs placeholder:ml-3 focus:ring-1 focus:ring-slate-500 transition duration-300 ease-in-out focus:border-slate-100 placeholder:capitalize"
                            type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                            placeholder="enter your name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />

                        <!-- Email Address -->
                        {{-- <label for="name" class="text-sm font-semibold text-slate-600 capitalize mt-1">email</label> --}}
                        <input id="email"
                            class="mt-3 w-full p-2 rounded-xl text-sm border border-slate-200 placeholder:text-xs placeholder:ml-3 focus:ring-1 focus:ring-slate-500 transition duration-300 ease-in-out focus:border-slate-100 placeholder:capitalize"
                            type="email" name="email" :value="old('email')" required autocomplete="username"
                            placeholder="enter your email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                        <!-- Password -->

                        {{-- <label for="password" class="text-sm font-semibold text-slate-600 capitalize">password</label> --}}

                        <input id="password"
                            class="mt-3 w-full p-2 rounded-xl text-sm border border-slate-200 placeholder:text-xs placeholder:ml-3 focus:ring-1 focus:ring-slate-500 transition duration-300 ease-in-out focus:border-slate-100 placeholder:capitalize"
                            type="password" name="password" required autocomplete="new-password"
                            placeholder="enter your password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

                        <!-- Confirm Password -->

                        {{-- <label for="password_confirmation"
                            class="text-sm font-semibold text-slate-600 capitalize">confirm
                            password</label> --}}

                        <input id="password_confirmation"
                            class="mt-3 w-full p-2 rounded-xl text-sm border border-slate-200 placeholder:text-xs placeholder:ml-3 focus:ring-1 focus:ring-slate-500 transition duration-300 ease-in-out focus:border-slate-100 placeholder:capitalize"
                            type="password" name="password_confirmation" required autocomplete="new-password"
                            placeholder="confirm password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                        <div class="flex justify-between">
                            <button
                                class="bg-primary text-white p-2 rounded-xl w-1/2 mt-3 active:bg-red-800 transition duration-300 ease-in-out">
                                {{ __('Register') }}
                            </button>

                            <a class="underline pt-2 text-sm text-gray-600 mt-3" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>
    <div id="loadingIndicator"
        class="fixed top-0 left-0 w-full h-full bg-opacity-60 bg-gray-800 flex items-center justify-center">
        <div id="loading" class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12 mb-4">
        </div>
    </div>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
