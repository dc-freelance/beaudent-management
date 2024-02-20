<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Pasien', 'url' => route('admin.customer.index')],
        ['name' => 'Tambah Pasien', 'url' => ''],
    ]" title="Tambah Pasien" />

    <div class="w-full">
        <x-card-container>
            <form action="{{ route('admin.customer.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-6">
                    <x-input id="name" label="Nama Pasien" name="name" value="{{ old('name', $data->name) }}" required />
                    <x-input type="date" id="date_of_birth" label="Tanggal Lahir" name="date_of_birth" value="{{ old('date_of_birth', $data->date_of_birth) }}" required />
                    <x-input id="place_of_birth" label="Tempat Lahir" name="place_of_birth" value="{{ old('place_of_birth', $data->place_of_birth) }}" required />
                    <x-input id="identity_number" label="Nomor Identitas" name="identity_number" value="{{ old('identity_number', $data->identity_number) }}" required />
                    <div>
                        <p>Jenis Kelamin :</p>
                        <div class="mt-2">
                            <select id="gender" name="gender" class="block py-3 pl-3 pr-10 w-full text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="Male" {{ $data->gender == 'Male' ? 'selected' : ''}}>Laki-laki</option>
                                <option value="Female" {{ $data->gender == 'Female' ? 'selected' : ''}}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <x-input id="occupation" label="Pekerjaan" name="occupation" type="text" value="{{ old('occupation', $data->occupation) }}" required />
                    <x-input id="address" label="Alamat" name="address" value="{{ old('address', $data->address) }}" required />
                    <x-input id="phone_number" label="Nomor Telepon" name="phone_number" type="number" value="{{ old('phone_number', $data->phone_number) }}" required />
                    <x-input id="religion" label="Agama" name="religion" type="text" value="{{ old('religion', $data->religion) }}" required />
                    <x-input type="email" id="email" label="Surel" name="email" type="text" value="{{ old('email', $data->email) }}" required />
                    <div>
                        <p>Status Pernikahan :</p>
                        <div class="mt-2">
                            <select id="marrital_status" name="marrital_status" class="block py-3 pl-3 pr-10 w-full text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="Single" {{ $data->marrital_status == 'Single' ? 'selected' : ''}}>Lajang</option>
                                <option value="Married" {{ $data->marrital_status == 'Married' ? 'selected' : ''}}>Menikah</option>
                                <option value="Divorved" {{ $data->marrital_status == 'Divorved' ? 'selected' : ''}}>Cerai</option>
                            </select>
                        </div>
                    </div>
                    <x-input id="instagram" label="Tautan Instagram" name="instagram" type="text" value="{{ old('instagram', $data->instagram) }}" required />
                    <x-input id="youtube" label="Tautan YouTube" name="youtube" type="text" value="{{ old('youtube', $data->youtube) }}" required />
                    <x-input id="facebook" label="Tautan Facebook" name="facebook" type="text" value="{{ old('facebook', $data->facebook) }}" required />
                    <x-input id="source_of_information" label="Informasi Lainnya" name="source_of_information" type="text" value="{{ old('source_of_information', $data->source_of_information) }}" required />
                </div>
                <div class="mt-6">
                    <x-button type="submit">Tambah Pasien</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>