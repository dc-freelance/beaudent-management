<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button"
    class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd"
            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
        </path>
    </svg>
</button>

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen border border-r transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-4 py-8 overflow-y-auto bg-white">
        {{-- Logo --}}
        <a href="#" class="flex items-center justify-center mb-4">
            <img src="{{ asset('assets/images/logo.png') }}" class="mr-3 object-contain h-20" alt="logo"
                class="mix-blend-multiply" />
        </a>
        <ul class="space-y-1">
            <x-sidebar-item name="Dashboard" icon="fas fa-home" route="{{ route('admin.dashboard.index') }}"
                active="{{ request()->routeIs('admin.dashboard.index') }}" />

            @role('admin_pusat')
                <x-sidebar-dropdown title="Manajemen Pengguna" icon="fas fa-users" toggle="master-users"
                    active="{{ request()->routeIs('admin.permission.*') || request()->routeIs('admin.user-management.*') || request()->routeIs('admin.role.*') }}">
                    <x-sidebar-submenu name="Permission" route="{{ route('admin.permission.index') }}"
                        active="{{ request()->routeIs('admin.permission.*') }}" icon="fas fa-key" />
                    <x-sidebar-submenu name="Hak Akses" route="{{ route('admin.role.index') }}"
                        active="{{ request()->routeIs('admin.role.*') }}" icon="fas fa-user-lock" />
                    <x-sidebar-submenu name="Pengguna" route="{{ route('admin.user-management.index') }}"
                        active="{{ request()->routeIs('admin.user-management.*') }}" icon="fas fa-user" />
                </x-sidebar-dropdown>
                <x-sidebar-dropdown title="Manajemen Dokter" icon="fas fa-user-md" toggle="master-doctor"
                    active="{{ request()->routeIs('admin.doctor-category.*') || request()->routeIs('admin.doctor.*') || request()->routeIs('admin.doctor-schedule.*') }}">
                    <x-sidebar-submenu name="Kategori" route="{{ route('admin.doctor-category.index') }}"
                        active="{{ request()->routeIs('admin.doctor-category.*') }}" icon="fas fa-th-list" />
                    <x-sidebar-submenu name="Dokter" route="{{ route('admin.doctor.index') }}"
                        active="{{ request()->routeIs('admin.doctor.*') }}" icon="fas fa-user-doctor" />
                    <x-sidebar-submenu name="Jadwal Dokter" route="{{ route('admin.doctor-schedule.index') }}"
                        active="{{ request()->routeIs('admin.doctor-schedule.*') }}" icon="fas fa-calendar-plus" />
                </x-sidebar-dropdown>
                <x-sidebar-dropdown title="Manajemen Layanan" icon="fas fa-stethoscope" toggle="master-treatment"
                    active="{{ request()->routeIs('admin.treatment-category.*') || request()->routeIs('admin.treatment.*') || request()->routeIs('admin.treatment-bonus.*') || request()->routeIs('admin.discount.*') }}">
                    <x-sidebar-submenu name="Layanan" route="{{ route('admin.treatment.index') }}"
                        active="{{ request()->routeIs('admin.treatment.*') }}" icon="fas fa-band-aid" class=" ms-4" />
                    <x-sidebar-submenu name="Bonus Layanan" route="{{ route('admin.treatment-bonus.index') }}"
                        active="{{ request()->routeIs('admin.treatment-bonus.*') }}" icon="fas fa-gift" class=" ms-4" />
                    <x-sidebar-submenu name="Diskon" route="{{ route('admin.discount.index') }}"
                        active="{{ request()->routeIs('admin.discount.*') }}" icon="fas fa-money-bill-wave"
                        class=" ms-4" />
                    <x-sidebar-item name="Layanan Tambahan" icon="fas fa-cart-plus"
                        route="{{ route('admin.addon.index') }}" active="{{ request()->routeIs('admin.addon.*') }}" />
                </x-sidebar-dropdown>
                <x-sidebar-item name="Manajemen Cabang" icon="fas fa-institution" route="{{ route('admin.branch.index') }}"
                    active="{{ request()->routeIs('admin.branch.*') }}" />
                <x-sidebar-item name="Manajemen Pasien" icon="fas fa-user-plus" route="{{ route('admin.customer.index') }}"
                    active="{{ request()->routeIs('admin.customer.*') }}" />
                <x-sidebar-dropdown title="Manajemen Barang" icon="fas fa-boxes" toggle="master-product"
                    active="{{ request()->routeIs('admin.item-category.*') || request()->routeIs('admin.item.*') || request()->routeIs('admin.item-unit.*') }}">
                    <x-sidebar-submenu name="Kategori" route="{{ route('admin.item-category.index') }}"
                        active="{{ request()->routeIs('admin.item-category.*') }}" icon="fas fa-th-list" />
                    <x-sidebar-submenu name="Satuan" route="{{ route('admin.item-unit.index') }}"
                        active="{{ request()->routeIs('admin.item-unit.*') }}" icon="fas fa-boxes-packing" />
                    <x-sidebar-submenu name="Barang" route="{{ route('admin.item.index') }}"
                        active="{{ request()->routeIs('admin.item.*') }}" icon="fas fa-box" />
                </x-sidebar-dropdown>
                <x-sidebar-item name="Manajemen Pemasok" icon="fas fa-truck" route="{{ route('admin.supplier.index') }}"
                    active="{{ request()->routeIs('admin.supplier.*') }}" />
                <x-sidebar-item name="Konfigurasi Shift" icon="fas fa-clock"
                    route="{{ route('admin.config-shift.index') }}"
                    active="{{ request()->routeIs('admin.config-shift.*') }}" />
            @endrole

            @role('frontoffice')
                <x-sidebar-dropdown title="Manajemen Reservasi" icon="fas fa-calendar" toggle="master-reservasi"
                        active="{{ request()->routeIs('front-office.reservations.wait.*') || request()->routeIs('front-office.reservations.confirm.*') || request()->routeIs('front-office.reservations.cancel.*')}}">
                        <x-sidebar-submenu name="Menunggu Konfirmasi" route="{{ route('front-office.reservations.wait.index') }}"
                            active="{{ request()->routeIs('front-office.reservations.wait.*') }}" icon="fas fa-hourglass-half" />
                        <x-sidebar-submenu name="Reservasi Terkonfirmasi" route="{{ route('front-office.reservations.confirm.index') }}"
                            active="{{ request()->routeIs('front-office.reservations.confirm.*') }}" icon="fas fa-check-circle" />
                        <x-sidebar-submenu name="Reservasi Dibatalkan" route="{{ route('front-office.reservations.cancel.index') }}"
                            active="{{ request()->routeIs('front-office.reservations.cancel.*') }}" icon="fas fa-calendar-times" />
                </x-sidebar-dropdown>
                <x-sidebar-dropdown title="Manajemen Sesi" icon="fas fa-clock" toggle="shift"
                        active="{{ request()->routeIs('front-office.shift-log.*') }}">
                        <x-sidebar-submenu name="Buka Sesi" route="{{ route('front-office.shift-log.open-shift') }}"
                            active="{{ request()->routeIs('front-office.shift-log.open-shift') }}" icon="fas fa-user-clock" />
                        <x-sidebar-submenu name="Tutup Sesi" route="{{ route('front-office.shift-log.close-shift') }}"
                            active="{{ request()->routeIs('front-office.shift-log.close-shift') }}" icon="fas fa-user-clock" />
                </x-sidebar-dropdown>
            @endrole
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="flex w-full items-center p-3 font-normal text-gray-900 rounded-md dark:text-white hover:bg-gray-100">
                        <i
                            class="fas fa-sign-out-alt w-4 h-4 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                        <span class="ml-3">Keluar</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>
