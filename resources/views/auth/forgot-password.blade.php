<x-guest-layout>
    <div
        class="w-full mx-auto lg:h-[40dvh] lg:px-16 max-lg:px-4 bg-white rounded-xl max-lg:pb-4 shadow-sm max-md:shadow-md max-md:pb-5 shadow-slate-300 bg-opacity-85 z-10 relative">
        <div class="pt-6 ">
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 pt-5">
                {{ __('lupa kata sandi Anda? Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami akan mengirimkan email berisi tautan pengaturan ulang kata sandi yang memungkinkan Anda memilih yang baru.') }}
            </div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for=""></label>
                    <input id="email"
                        class="w-full text-sm rounded-lg p-2 border border-slate-200 focus:ring-1 focus:ring-red-200 transition duration-300 ease-in-out focus:border-red-200 placeholder:capitalize placeholder:text-sm"
                        type="email" name="email" :value="old('email')" required autofocus
                        placeholder="enter your email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex items-center justify-start mt-4">
                    <button
                        class="bg-primary text-white p-2 rounded-lg w-1/2 mt-1 active:bg-red-800 transition duration-300 ease-in-out mx-auto">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
