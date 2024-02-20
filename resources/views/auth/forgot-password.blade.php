<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <section class="bg-gradient-to-r from-red-100 to-red-200 text-inter">
        <div class=" container h-screen mx-auto flex justify-center items-center">
            <div
                class="lg:h[70dvh] mx-auto lg:w-1/2 shadow-xl px-9 pb-9 rounded-lg bg-white max-md:w-full max-md:mx-4 md:w-1/2">
                <img src="{{ asset('assets/images/logo.png') }}" alt="img" height="150" width="150"
                    class="mx-auto">
                <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for=""></label>
                        <input id="email"
                            class="w-full text-sm rounded-xl p-2 border border-slate-200 focus:ring-1 focus:ring-slate-500 transition duration-300 ease-in-out focus:border-slate-100 placeholder:capitalize placeholder:text-sm"
                            type="email" name="email" :value="old('email')" required autofocus
                            placeholder="enter your email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-start mt-4">
                        <button
                            class="bg-primary text-white p-2 rounded-xl max-lg:w-full lg:w-1/2 mt-1 active:bg-red-800 transition duration-300 ease-in-out mx-auto">
                            {{ __('Reset Password') }}
                        </button>
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
