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
            <img src="{{ asset('assets/images/logo.webp') }}" class="mr-3 object-contain h-20" alt="logo"
                class="mix-blend-multiply" />
        </a>
        <ul class="space-y-1">
            <x-sidebar-item name="Dashboard" icon="fas fa-home" route="{{ route('admin.dashboard.index') }}"
                active="{{ request()->routeIs('admin.dashboard.index') }}" />

            {{-- @role('admin_pusat') --}}
            @canany(['read_permission', 'read_user', 'read_role'])
                <x-sidebar-dropdown title="Manajemen Pengguna" icon="fas fa-users" toggle="master-users"
                    active="{{ request()->routeIs('admin.permission.*') || request()->routeIs('admin.user-management.*') || request()->routeIs('admin.role.*') }}">
                    @can('read_permission')
                        <x-sidebar-submenu name="Permission" route="{{ route('admin.permission.index') }}"
                            active="{{ request()->routeIs('admin.permission.*') }}" icon="fas fa-key" />
                    @endcan
                    @can('read_role')
                        <x-sidebar-submenu name="Hak Akses" route="{{ route('admin.role.index') }}"
                            active="{{ request()->routeIs('admin.role.*') }}" icon="fas fa-user-lock" />
                    @endcan
                    @can('read_user')
                        <x-sidebar-submenu name="Pengguna" route="{{ route('admin.user-management.index') }}"
                            active="{{ request()->routeIs('admin.user-management.*') }}" icon="fas fa-user" />
                    @endcan
                </x-sidebar-dropdown>
            @endcanany

            @canany(['read_doctor_category', 'read_doctor', 'read_doctor_schedule'])
                <x-sidebar-dropdown title="Manajemen Dokter" icon="fas fa-user-md" toggle="master-doctor"
                    active="{{ request()->routeIs('admin.doctor-category.*') || request()->routeIs('admin.doctor.*') || request()->routeIs('admin.doctor-schedule.*') }}">
                    @can('read_doctor_category')
                        <x-sidebar-submenu name="Kategori" route="{{ route('admin.doctor-category.index') }}"
                            active="{{ request()->routeIs('admin.doctor-category.*') }}" icon="fas fa-th-list" />
                    @endcan
                    @can('read_doctor')
                        <x-sidebar-submenu name="Dokter" route="{{ route('admin.doctor.index') }}"
                            active="{{ request()->routeIs('admin.doctor.*') }}" icon="fas fa-user-doctor" />
                    @endcan
                    @can('read_doctor_schedule')
                        <x-sidebar-submenu name="Jadwal Dokter" route="{{ route('admin.doctor-schedule.index') }}"
                            active="{{ request()->routeIs('admin.doctor-schedule.*') }}" icon="fas fa-calendar-plus" />
                    @endcan
                </x-sidebar-dropdown>
            @endcanany

            @canany(['read_treatment', 'read_treatment_bonus', 'read_treatment_category', 'read_addon'])
                <x-sidebar-dropdown title="Manajemen Layanan" icon="fas fa-stethoscope" toggle="master-treatment"
                    active="{{ request()->routeIs('admin.treatment-categories.*') || request()->routeIs('admin.treatment.*') || request()->routeIs('admin.treatment-bonus.*') || request()->routeIs('admin.addon.*') }}">
                    @can('read_treatment')
                        <x-sidebar-submenu name="Layanan" route="{{ route('admin.treatment.index') }}"
                            active="{{ request()->routeIs('admin.treatment.*') }}" icon="fas fa-band-aid" class=" ms-4" />
                    @endcan
                    @can('read_treatment_bonus')
                        <x-sidebar-submenu name="Bonus Layanan" route="{{ route('admin.treatment-bonus.index') }}"
                            active="{{ request()->routeIs('admin.treatment-bonus.*') }}" icon="fas fa-gift" class=" ms-4" />
                    @endcan
                    @can('read_treatment_category')
                        <x-sidebar-submenu name="Kategori" route="{{ route('admin.treatment-categories.index') }}"
                            active="{{ request()->routeIs('admin.treatment-categories.*') }}" icon="fas fa-th-list" />
                    @endcan
                    @can('read_addon')
                        <x-sidebar-submenu name="Layanan Tambahan" icon="fas fa-cart-plus"
                            route="{{ route('admin.addon.index') }}" active="{{ request()->routeIs('admin.addon.*') }}" />
                    @endcan
                </x-sidebar-dropdown>
            @endcanany

            @canany(['read_discount', 'read_discount_treatment', 'read_discount_item'])
                <x-sidebar-dropdown title="Manajemen Diskon" icon="fas fa-money-bill-wave" toggle="master-discount"
                    active="{{ request()->routeIs('admin.discount.*') || request()->routeIs('admin.discount_treatment.*') || request()->routeIs('admin.discount_item.*') }}">
                    @can('read_discount')
                        <x-sidebar-submenu name="Diskon" route="{{ route('admin.discount.index') }}"
                            active="{{ request()->routeIs('admin.discount.*') }}" icon="fas fa-money-bill-wave"
                            class=" ms-4" />
                    @endcan
                    @can('read_discount_treatment')
                        <x-sidebar-submenu name="Diskon Layanan" route="{{ route('admin.discount_treatment.index') }}"
                            active="{{ request()->routeIs('admin.discount_treatment.*') }}" icon="fas fa-band-aid"
                            class=" ms-4" />
                    @endcan
                    @can('read_discount_item')
                        <x-sidebar-submenu name="Diskon Barang" route="{{ route('admin.discount_item.index') }}"
                            active="{{ request()->routeIs('admin.discount_item.*') }}" icon="fas fa-box" class=" ms-4" />
                    @endcan
                </x-sidebar-dropdown>
            @endcanany

            @can('read_branch')
                <x-sidebar-item name="Manajemen Cabang" icon="fas fa-institution"
                    route="{{ route('admin.branch.index') }}" active="{{ request()->routeIs('admin.branch.*') }}" />
            @endcan

            @can('read_customer')
                <x-sidebar-item name="Manajemen Pasien" icon="fas fa-user-plus"
                    route="{{ route('admin.customer.index') }}" active="{{ request()->routeIs('admin.customer.*') }}" />
            @endcan

            @canany(['read_item_category', 'read_item_unit', 'read_item'])
                <x-sidebar-dropdown title="Manajemen Barang" icon="fas fa-boxes" toggle="master-product"
                    active="{{ request()->routeIs('admin.item-category.*') || request()->routeIs('admin.item.*') || request()->routeIs('admin.item-unit.*') }}">
                    @can('read_item_category')
                        <x-sidebar-submenu name="Kategori" route="{{ route('admin.item-category.index') }}"
                            active="{{ request()->routeIs('admin.item-category.*') }}" icon="fas fa-th-list" />
                    @endcan
                    @can('read_item_unit')
                        <x-sidebar-submenu name="Satuan" route="{{ route('admin.item-unit.index') }}"
                            active="{{ request()->routeIs('admin.item-unit.*') }}" icon="fas fa-boxes-packing" />
                    @endcan
                    @can('read_item')
                        <x-sidebar-submenu name="Barang" route="{{ route('admin.item.index') }}"
                            active="{{ request()->routeIs('admin.item.*') }}" icon="fas fa-box" />
                    @endcan
                </x-sidebar-dropdown>
            @endcanany

            @can('read_supplier')
                <x-sidebar-item name="Manajemen Pemasok" icon="fas fa-truck" route="{{ route('admin.supplier.index') }}"
                    active="{{ request()->routeIs('admin.supplier.*') }}" />
            @endcan

            @can('read_config_shift')
                <x-sidebar-item name="Konfigurasi Shift" icon="fas fa-clock"
                    route="{{ route('admin.config-shift.index') }}"
                    active="{{ request()->routeIs('admin.config-shift.*') }}" />
            @endcan

            @can('read_payment_method')
                <x-sidebar-item name="Manajemen Metode Pembayaran" icon="fab fa-cc-mastercard"
                    route="{{ route('admin.payment-methods.index') }}"
                    active="{{ request()->routeIs('admin.payment-methods.*') }}" />
            @endcan
            {{-- @endrole --}}

            {{-- @role('frontoffice') --}}
            @canany(['read_wait_reservation', 'read_confirm_reservation', 'read_done_reservation',
                'read_cancel_reservation', 'read_wait_deposit', 'read_confirm_deposit'])
                <x-sidebar-item name="Manajemen Reservasi" icon="fas fa-calendar"
                    route="{{ route('front-office.reservations.confirm.index') }}"
                    active="{{ request()->routeIs('front-office.reservations.wait.*') || request()->routeIs('front-office.reservations.confirm.*') || request()->routeIs('front-office.reservations.cancel.*') || request()->routeIs('front-office.deposit.wait.*') || request()->routeIs('front-office.deposit.confirm.*') }}" />
            @endcanany
            {{-- @endrole --}}

            @canany(['read_open_shift_log', 'read_close_shift_log', 'read_recap_shift_log'])
                <x-sidebar-dropdown title="Manajemen Sesi" icon="fas fa-clock" toggle="shift"
                    active="{{ request()->routeIs('front-office.shift-log.*') }}">
                    @can('read_open_shift_log')
                        <x-sidebar-submenu name="Buka Sesi" route="{{ route('front-office.shift-log.open-shift') }}"
                            active="{{ request()->routeIs('front-office.shift-log.open-shift') }}"
                            icon="fas fa-user-clock" />
                    @endcan
                    @can('read_close_shift_log')
                        <x-sidebar-submenu name="Tutup Sesi" route="{{ route('front-office.shift-log.close-shift') }}"
                            active="{{ request()->routeIs('front-office.shift-log.close-shift') }}"
                            icon="fas fa-user-clock" />
                    @endcan
                    @can('read_recap_shift_log')
                        <x-sidebar-submenu name="Rekap Sesi" route="{{ route('front-office.shift-log.recap-shift') }}"
                            active="{{ request()->routeIs('front-office.shift-log.recap-shift') }}"
                            icon="fas fa-clipboard-list" />
                    @endcan
                </x-sidebar-dropdown>
            @endcanany

            @canany(['read_income_report_general', 'export_income_report_general', 'read_patient_visit_report_general'])
                <x-sidebar-dropdown title="Laporan" icon="fas fa-file-alt" toggle="report"
                    active="{{ request()->routeIs('admin.income-report.general') ||
                        request()->routeIs('admin.income-report.doctor') ||
                        request()->routeIs('admin.treatment-report.general') ||
                        request()->routeIs('admin.patient_visit_report.general') ||
                        request()->routeIs('admin.shift_report.general') }}">
                    @can('read_income_report_general')
                        <x-sidebar-submenu name="Pemasukan" route="{{ route('admin.income-report.general') }}"
                            active="{{ request()->routeIs('admin.income-report.general') }}" icon="fas fa-file" />
                    @endcan
                    @can('export_income_report_general')
                        <x-sidebar-submenu name="Presentase Dokter" route="{{ route('admin.income-report.doctor') }}"
                            active="{{ request()->routeIs('admin.income-report.doctor') }}" icon="fas fa-file" />
                    @endcan
                    @can(['read_treatment_report_general'])
                        <x-sidebar-submenu name="Laporan Layanan" icon="fas fa-file"
                            route="{{ route('admin.treatment-report.general') }}"
                            active="{{ request()->routeIs('admin.treatment-report.general') }}" />
                    @endcan
                    @can(['read_patient_visit_report_general'])
                        <x-sidebar-submenu name="Laporan Kunjungan Pasien" icon="fas fa-file"
                            route="{{ route('admin.patient_visit_report.general') }}"
                            active="{{ request()->routeIs('admin.patient_visit_report.general') }}" />
                    @endcan
                    @can('read_shift_report_general')
                        <x-sidebar-submenu name="Laporan Shift" icon="fas fa-file"
                            route="{{ route('admin.shift_report.general') }}"
                            active="{{ request()->routeIs('admin.shift_report.general') }}" />
                    @endcan
                </x-sidebar-dropdown>
            @endcanany

            @can('read_examination_history')
                <x-sidebar-item name="Daftar Pemeriksaan" icon="fas fa-file-medical"
                    route="{{ route('admin.examination-history.index') }}"
                    active="{{ request()->routeIs('admin.examination-history.*') }}" />
            @endcan

            @role('frontoffice')
                @canany(['read_queue_transaction', 'read_list_transaction'])
                    <x-sidebar-dropdown title="Pembayaran" icon="fas fa-money-bill-wave" toggle="transaction"
                        active="{{ request()->routeIs('front-office.transaction.*') }}">
                        @can('read_queue_transaction')
                            <x-sidebar-submenu name="Antrian Pembayaran"
                                route="{{ route('front-office.transaction.list-billing') }}"
                                active="{{ request()->routeIs('front-office.transaction.list-billing') || request()->routeIs('front-office.transaction.payment') }}"
                                icon="fas fa-list-ol" />
                        @endcan
                        @can('read_list_transaction')
                            <x-sidebar-submenu name="Riwayat Transaksi"
                                route="{{ route('front-office.transaction.list-transaction') }}"
                                active="{{ request()->routeIs('front-office.transaction.list-transaction') || request()->routeIs('front-office.transaction.detail-transaction') }}"
                                icon="fas fa-list-ul" />
                        @endcan
                    </x-sidebar-dropdown>
                @endcanany
            @endrole
        </ul>
    </div>
</aside>
