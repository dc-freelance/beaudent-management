<header class="w-full p-1 bg-white border-b">
    <div class="flex justify-between">
        <div class="p-1 w-full"></div>
        <div class="p-1 w-full flex justify-end">
            <div class="flex justify-end gap-4 items-center">
                <span class="ml-3">{{ auth()->user()->email }}</span>
                <button type="button" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                    <img src="https://ui-avatars.com/api/?background=D04848&color=fff&name={{ auth()->user()->name }}" class="w-8 h-8 rounded-full" alt="avatar">
                </button>
            </div>
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow" id="dropdown-user">
                <ul class="py-1" role="none">
                    <li>
                        <a href="{{ route('admin.password.index') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                        role="menuitem">Ubah Password</a>
                    </li>
                </ul>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="flex w-full items-center p-3 font-normal text-gray-900 rounded-md dark:text-white hover:bg-gray-100">
                    <i
                        class="fas fa-sign-out-alt w-4 h-4 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    <span class="ml-3">Keluar</span>
                </button>
            </form>
        </div>
    </div>
</header>