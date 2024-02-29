<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div
            class="w-full lg:h-[40dvh] lg:px-16 max-lg:px-4 max-lg:pb-5 bg-white rounded-xl shadow-sm max-md:shadow-md max-md:pb-5 shadow-slate-300 bg-opacity-85 z-10 relative">
            <!-- Email Address -->
            <div class="flex items-center justify-center pt-16">
                <div class="bg-primary w-10 h-9 mt-1 flex justify-center items-center">
                    <svg viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                        <path
                            d="M192 256C262.692 256 320 198.692 320 128C320 57.3075 262.692 0 192 0C121.308 0 64 57.3075 64 128C64 198.692 121.308 256 192 256Z"
                            class="fill-white" />
                        <path
                            d="M192 298.667C86.01 298.785 0.118 384.677 0 490.667C0 502.449 9.551 512 21.333 512H362.666C374.448 512 383.999 502.449 383.999 490.667C383.882 384.677 297.99 298.784 192 298.667Z"
                            class="fill-white" />
                    </svg>
                </div>
                <div class="w-full">
                    <x-text-input id="email"
                        class="mt-1 w-full p-2 text-sm border-none rounded-tl-none rounded-tr-lg rounded-br-lg rounded-bl-none placeholder:text-xs placeholder:ml-3 focus:ring-0 transition focus:border-none placeholder:capitalize"
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                        placeholder="masukkan email anda" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 block" />
                </div>
            </div>

            <!-- Password -->
            <div class="mt-1 flex justify-center items-center">
                <div class="flex justify-center items-center bg-primary w-10 h-9 mt-3">
                    <svg viewBox="0 0 24 24" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M19 10C16.239 10 14 12.239 14 15C14 15.572 14.116 16.112 14.293 16.624L13.978 16.928V19H11.978V21H10V24H12.604L17.016 19.587C17.625 19.851 18.294 20 18.999 20C21.76 20 23.999 17.761 23.999 15C23.999 12.239 21.761 10 19 10ZM20 12.5C20.828 12.5 21.5 13.172 21.5 14C21.5 14.828 20.828 15.5 20 15.5C19.172 15.5 18.5 14.828 18.5 14C18.5 13.172 19.172 12.5 20 12.5ZM3 6C3 2.691 5.691 0 9 0C12.309 0 15 2.691 15 6C15 9.309 12.309 12 9 12C5.691 12 3 9.309 3 6ZM8 24H0V19C0 16.243 2.243 14 5 14H12.08C12.033 14.328 12 14.66 12 15C12 15.328 11.979 17 11.979 17H9.979V19H8V24Z"
                            class="fill-white" />
                    </svg>
                </div>
                <div class="w-full">
                    <x-text-input id="password"
                        class="mt-3 w-full p-2 text-sm rounded-tl-none rounded-tr-lg rounded-br-lg rounded-bl-none border-none placeholder:text-xs placeholder:ml-3 focus:ring-0 transition placeholder:capitalize"
                        type="password" name="password" required autocomplete="current-password"
                        placeholder="masukkan password anda" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
            </div>

            {{-- remember me --}}
            <div class="flex items-center justify-between mt-4" style="gap: 16px">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded dark:bg-gray-900 border-gray-300 text-primary shadow-sm focus:ring-primary hover:cursor-pointer"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Ingat Saya') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-primary text-sm focus:text-red-800 underline" href="{{ route('password.request') }}">
                        {{ __('lupa sandi?') }}
                    </a>
                @endif
            </div>
        </div>
        <div class="mt-1 flex items-center ">
            <button
                class=" w-2/3 max-md:p-2 md:p-2 lg:p-2 text-white rounded-[0_0_15px_15px] bg-primary active:bg-red-800 bg-opacity-90 mx-auto z-20 capitalize"
                onclick="performLogin()">
                {{ __('masuk') }}
            </button>
        </div>

    </form>
</x-guest-layout>
