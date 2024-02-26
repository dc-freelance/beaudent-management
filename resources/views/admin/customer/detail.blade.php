<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Pasien', 'url' => route('admin.customer.index')],
        ['name' => 'Detail Pasien', 'url' => ''],
    ]" title="Detail Pasien" />

    <div class="w-full">
        <x-card-container>
            <table class="shadow-lg w-full bg-white border-separate">
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Nama</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->name }}</td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Tempat Lahir</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->place_of_birth }}</td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Tanggal Lahir</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->date_of_birth }}</td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Nomor Identitas</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->identity_number }}</td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Jenis Kelamin</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->gender == 'Male' ? 'Laki-laki' : 'Perempuan' }}</td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Pekerjaan</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->occupation }}</td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Alamat</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->address }}</td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Nomor Telepon</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->phone_number }}</td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Agama</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->religion }}</td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Surel</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->email }}</td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Status Pernikahan</th>
                    <td class="border px-8 py-4 w-3/4">
                        @if ($data->marrital_status == 'Married')
                            Menikah
                        @elseif ($data->marrital_status == 'Single')
                            Lajang
                        @else
                            Cerai
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Tautan Instagram</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->instagram }}</td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Tautan YouTube</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->youtube }}</td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Tautan Facebook</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->facebook }}</td>
                </tr>
                <tr>
                    <th class="bg-red-100 border text-left px-8 py-4 w-1/4">Sumber Informasi Lainnya</th>
                    <td class="border px-8 py-4 w-3/4">{{ $data->source_of_information }}</td>
                </tr>
            </table>
        </x-card-container>
    </div>
</x-app-layout>