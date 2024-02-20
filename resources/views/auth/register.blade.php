<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>

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
</x-guest-layout>
