@props(['header' => '', 'id' => '', 'padding' => true])

<div class="py-2" id="{{ $id }}">
    <div class="mx-auto">
        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200">
            <li class="me-2">
                <a href="{{ route('front-office.reservations.wait.index') }}"
                    class="inline-block p-4 rounded-t-lg {{ request()->routeIs('front-office.reservations.wait.*') ? 'text-red-600 border border-gray-100 border-b-0 shadow-sm bg-white active' : 'hover:text-gray-600 hover:bg-gray-50' }}">Menunggu
                    Konfirmasi</a>
            </li>
            <li class="me-2">
                <a href="{{ route('front-office.deposit.wait_depo.index') }}"
                    class="inline-block p-4 rounded-t-lg {{ request()->routeIs('front-office.deposit.wait_depo.index') ? 'text-red-600 border border-gray-100 border-b-0 shadow-sm bg-white active' : 'hover:text-gray-600 hover:bg-gray-50' }}">Menunggu
                    Deposit</a>
            </li>
            <li class="me-2">
                <a href="{{ route('front-office.deposit.wait.index') }}"
                    class="inline-block p-4 rounded-t-lg {{ request()->routeIs('front-office.deposit.wait.index') ? 'text-red-600 border border-gray-100 border-b-0 shadow-sm bg-white active' : 'hover:text-gray-600 hover:bg-gray-50' }}">Konfirmasi
                    Deposit</a>
            </li>
            <li class="me-2">
                <a href="{{ route('front-office.reservations.confirm.index') }}"
                    class="inline-block p-4 rounded-t-lg {{ request()->routeIs('front-office.reservations.confirm.index') ? 'text-red-600 border border-gray-100 border-b-0 shadow-sm bg-white active' : 'hover:text-gray-600 hover:bg-gray-50' }}">Terkonfirmasi</a>
            </li>
            <li class="me-2">
                <a href="{{ route('front-office.reservations.done.index') }}"
                    class="inline-block p-4 rounded-t-lg {{ request()->routeIs('front-office.reservations.done.index') ? 'text-red-600 border border-gray-100 border-b-0 shadow-sm bg-white active' : 'hover:text-gray-600 hover:bg-gray-50' }}">Selesai</a>
            </li>
            <li class="me-2">
                <a href="{{ route('front-office.reservations.cancel.index') }}"
                    class="inline-block p-4 rounded-t-lg {{ request()->routeIs('front-office.reservations.cancel.index') ? 'text-red-600 border border-gray-100 border-b-0 shadow-sm bg-white active' : 'hover:text-gray-600 hover:bg-gray-50' }}">Dibatalkan</a>
            </li>
        </ul>
        <div class="bg-white border border-gray-100 shadow-sm overflow-hidden sm:rounded-b-lg border-t-0">
            <div class="{{ $padding == true ? 'p-4' : '' }}">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>