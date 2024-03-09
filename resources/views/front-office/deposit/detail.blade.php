<x-app-layout>
    @php
        $breadcrumb = [
            ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
            ['name' => 'Detail Deposit', 'url' => ''],
        ];

        if ($data->status === 'Waiting Deposit') {
            $breadcrumb[1]['name'] = 'Menunggu Pembayaran Deposit';
            $breadcrumb[1]['url'] = route('front-office.deposit.wait_depo.index');
        } elseif ($data->status === 'Pending Deposit') {
            $breadcrumb[1]['name'] = 'Menunggu Konfirmasi Pembayaran';
            $breadcrumb[1]['url'] = route('front-office.deposit.wait.index');
        }
    @endphp

    <x-breadcrumb :links="$breadcrumb" title="Detail Deposit" />

    <div class="w-full">
        <x-card-container>
            <table class="shadow-lg w-full bg-white border-separate">
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">No. Reservasi</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->no }}</td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Nama Pelanggan</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->customers->name }}</td>
                </tr>
                {{-- <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Status</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->is_control ? 'Kontrol' : 'Perawatan' }}</td>
                </tr> --}}
                {{-- @if ($data->treatments != null)
                    <tr>
                        <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Layanan yang dipilih</th>
                        <td class="border px-8 py-4 w-3/4">{{ $data->treatments->name }}</td>
                    </tr>
                @endif --}}
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Status Reservasi</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->status }}</td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Tanggal Kunjungan</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->tanggal_reservasi_text }}</td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Waktu Kunjungan</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->waktu_reservasi_text }}</td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Cabang</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->branches->name }}</td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Anamesis</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->anamnesis }}</td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Deposit</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->deposit }}</td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Bukti Pembayaran</th>
                    <td class="border px-8 py-4 w-3/4">
                        @if (!empty($data->deposit_receipt))
                            <img src="{{ asset($data->deposit_receipt) }}" alt="Bukti Pembayaran">
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Akun Bank</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->customer_bank_account }}</td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Bank</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->customer_bank }}</td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Nama Akun Bank</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->customer_bank_account_name }}</td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Tanggal Transfer</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->tanggal_transfer_text }}</td>
                </tr>
            </table>

            @if ($data->status === 'Pending Deposit')
                @role('frontoffice')
                    <div></div>
                @else
                    <div id="popup-modal" tabindex="-1"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button"
                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="popup-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Tutup</span>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal">Apakah anda yakin
                                        akan membatalkan reservasi ini?</h3>
                                    <button data-modal-hide="popup-modal" type="button"
                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Tidak</button>
                                    <x-button-action
                                        route="{{ route('front-office.reservations.detail.cancel', $data->id) }}"
                                        color="red">
                                        Ya, Batalkan
                                    </x-button-action>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center mt-4">
                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                            class="focus:outline-none text-white font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 bg-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                            type="button">
                            Batalkan Reservasi
                        </button>
                        <x-button-action route="{{ route('front-office.deposit.detail.confirm', $data->id) }}"
                            color="green">
                            Konfirmasi Pembayaran
                        </x-button-action>
                    </div>
                @endrole
            @endif
        </x-card-container>
    </div>
</x-app-layout>
