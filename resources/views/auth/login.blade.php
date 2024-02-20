<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Email Address -->
        <div>
            <x-text-input id="email"
                class="mt-1 w-full p-2 rounded-xl text-sm border border-slate-200 placeholder:text-xs placeholder:ml-3 focus:ring-1 focus:ring-red-300 transition duration-300 ease-in-out focus:border-red-300 placeholder:capitalize"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                placeholder="enter your email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-1">
            <x-text-input id="password"
                class="mt-3 w-full p-2 rounded-xl text-sm border border-slate-200 placeholder:text-xs placeholder:ml-3 focus:ring-1 focus:ring-red-300 transition duration-300 ease-in-out focus:border-red-300 placeholder:capitalize"
                type="password" name="password" required autocomplete="current-password"
                placeholder="enter your password    " />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="mt-4">
            <button class="p-2 text-white w-full rounded-xl bg-primary active:bg-red-800" onclick="performLogin()">
                {{ __('Log in') }}
            </button>
        </div>

        <div class="flex items-center justify-between mt-4" style="gap: 16px">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-primary shadow-sm focus:ring-primary dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-primary text-sm focus:text-red-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>
        {{-- <p class="text-sm text-center mt-3">Don't have an account? <a href="/register"
                class="text-primary font-bold">sign up</a></p> --}}
    </form>
</x-guest-layout>
