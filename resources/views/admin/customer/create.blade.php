<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Pasien', 'url' => route('admin.customer.index')],
        ['name' => 'Tambah Pasien', 'url' => ''],
    ]" title="Tambah Pasien" />

    <div class="w-full">
        <x-card-container>
            <form action="{{ route('admin.customer.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-6">
                    <x-input id="name" label="Nama Pasien" name="name" value="{{ old('name') }}" required />
                    <x-input type="date" id="date_of_birth" label="Tanggal Lahir" name="date_of_birth"
                        value="{{ old('date_of_birth') }}" required />
                    <x-input id="place_of_birth" label="Tempat Lahir" name="place_of_birth"
                        value="{{ old('place_of_birth') }}" required />
                    <x-input id="identity_number" label="Nomor Identitas" name="identity_number"
                        value="{{ old('identity_number') }}" required />
                    <div>
                        <p>Jenis Kelamin :</p>
                        <div class="mt-2">
                            <select id="gender" name="gender"
                                class="block py-3 pl-3 pr-10 w-full text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="Male">Laki-laki</option>
                                <option value="Female">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <x-input id="occupation" label="Pekerjaan" name="occupation" type="text" required />
                    <x-input id="address" label="Alamat" name="address" required />
                    <x-input id="phone_number" label="Nomor Telepon" name="phone_number" type="number" required />
                    <x-input id="religion" label="Agama" name="religion" type="text" required />
                    <x-input type="email" id="email" label="Surel" name="email" type="text" required />
                    <div>
                        <p>Status Pernikahan :</p>
                        <div class="mt-2">
                            <select id="marrital_status" name="marrital_status"
                                class="block py-3 pl-3 pr-10 w-full text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="Single">Lajang</option>
                                <option value="Married">Menikah</option>
                                <option value="Divorved">Cerai</option>
                            </select>
                        </div>
                    </div>
                    <x-input id="instagram" label="Tautan Instagram" name="instagram" type="text" required />
                    <x-input id="youtube" label="Tautan YouTube" name="youtube" type="text" required />
                    <x-input id="facebook" label="Tautan Facebook" name="facebook" type="text" required />
                    <x-input id="source_of_information" label="Informasi Lainnya" name="source_of_information"
                        type="text" required />
                </div>
                <div class="mx-auto mt-6 w-full md:w-1/3 lg:w-1/2">
                    <x-button type="submit">Tambah Pasien</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
