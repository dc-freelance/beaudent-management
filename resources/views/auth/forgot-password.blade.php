<x-guest-layout>
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
                class="w-full text-sm rounded-xl p-2 border border-slate-200 focus:ring-1 focus:ring-red-200 transition duration-300 ease-in-out focus:border-red-200 placeholder:capitalize placeholder:text-sm"
                type="email" name="email" :value="old('email')" required autofocus placeholder="enter your email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-start mt-4">
            <button
                class="bg-primary text-white p-2 rounded-xl max-lg:w-full lg:w-1/2 mt-1 active:bg-red-800 transition duration-300 ease-in-out mx-auto">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
</x-guest-layout>
