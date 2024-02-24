<x-app-layout>
    @php
        $breadcrumb = [['name' => 'Dashboard', 'url' => route('admin.dashboard.index')], ['name' => 'Detail Deposit', 'url' => '']];

        if ($data->status === 'Reservations') {
            $breadcrumb[1]['name'] = 'Menunggu Konfirmasi';
            $breadcrumb[1]['url'] = route('front-office.deposit.wait.index');
        } elseif ($data->status === 'Cancel') {
            $breadcrumb[1]['name'] = 'Deposit Dibatalkan';
            $breadcrumb[1]['url'] = 'front-office.deposit.cancel.index';
        } else {
            $breadcrumb[1]['name'] = 'Deposit Terkonfirmasi';
            $breadcrumb[1]['url'] = 'front-office.deposit.confirm.index';
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
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Layanan yang dipilih</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->treatments->name }}</td>
                </tr>
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
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Status Deposit</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->deposit_status ? 'Sudah Bayar' : 'Belum Bayar' }}</td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Bukti Pembayaran</th>
                    <td class="border px-8 py-4 w-3/4">
                        <img src="{{ asset($data->deposit_receipt) }}" alt="Bukti Pembayaran">
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

            @if ($data->deposit_status === 'Waiting')
                <div class="flex justify-center mt-4">
                    <x-button-action route="{{ route('front-office.deposit.detail.cancel', $data->id) }}"
                        color="red">
                        Batalkan Pembayaran
                    </x-button-action>
                    <x-button-action route="{{ route('front-office.deposit.detail.confirm', $data->id) }}"
                        color="green">
                        Konfirmasi Pembayaran
                    </x-button-action>
                </div>
            @endif
        </x-card-container>
    </div>
</x-app-layout>
