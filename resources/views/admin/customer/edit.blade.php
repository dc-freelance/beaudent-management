<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Pasien', 'url' => route('admin.customer.index')],
        ['name' => 'Edit Pasien', 'url' => ''],
    ]" title="Edit Pasien" />

    <div class="w-full">
        <x-card-container>
            <form action="{{ route('admin.customer.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-6">
                    <x-input id="name" label="Nama Pasien" name="name" value="{{ old('name', $data->name) }}"
                        required />
                    <x-input type="date" id="date_of_birth" label="Tanggal Lahir" name="date_of_birth"
                        value="{{ old('date_of_birth', $data->date_of_birth) }}" required />
                    <x-input id="place_of_birth" label="Tempat Lahir" name="place_of_birth"
                        value="{{ old('place_of_birth', $data->place_of_birth) }}" required />
                    <x-input id="identity_number" label="Nomor Identitas" name="identity_number"
                        value="{{ old('identity_number', $data->identity_number) }}" required />
                    {{-- <div>
                        <p>Jenis Kelamin :</p>
                        <div class="mt-2">
                            <select id="gender" name="gender"
                                class="block py-3 pl-3 pr-10 w-full text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="Male" {{ $data->gender == 'Male' ? 'selected' : '' }}>Laki-laki
                                </option>
                                <option value="Female" {{ $data->gender == 'Female' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                        </div>
                    </div> --}}
                    <x-select id="gender" label="Jenis Kelamin" name="gender" required>
                        <option value="Male" {{ $data->gender == 'Male' ? 'selected' : '' }}>Laki-laki
                        </option>
                        <option value="Female" {{ $data->gender == 'Female' ? 'selected' : '' }}>Perempuan
                        </option>
                    </x-select>
                    <x-input id="occupation" label="Pekerjaan" name="occupation" type="text"
                        value="{{ old('occupation', $data->occupation) }}" required />
                    <x-input id="address" label="Alamat" name="address" value="{{ old('address', $data->address) }}"
                        required />
                    <x-input id="phone_number" label="Nomor Telepon" name="phone_number" type="number"
                        value="{{ old('phone_number', $data->phone_number) }}" required />
                    {{-- <x-input id="religion" label="Agama" name="religion" type="text" value="{{ old('religion', $data->religion) }}" required /> --}}
                    {{-- <div>
                        <p>Agama <span class="text-red-600">*</span></p>
                        <div class="mt-2">
                            <select id="religion" name="religion"
                                class="py-3 pl-3 pr-10 w-full text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option {{ $data->religion == 'Islam' ? 'selected' : '' }} value="Islam">Islam
                                </option>
                                <option {{ $data->religion == 'Kristen' ? 'selected' : '' }} value="Kristen">Kristen
                                </option>
                                <option {{ $data->religion == 'Hindu' ? 'selected' : '' }} value="Hindu">Hindu
                                </option>
                                <option {{ $data->religion == 'Budha' ? 'selected' : '' }} value="Budha">Budha
                                </option>
                                <option {{ $data->religion == 'Katolik' ? 'selected' : '' }} value="Katolik">Katolik
                                </option>
                                <option {{ $data->religion == 'Protestan' ? 'selected' : '' }} value="Protestan">
                                    Protestan</option>
                                <option {{ $data->religion == 'Konghucu' ? 'selected' : '' }} value="Konghucu">Konghucu
                                </option>
                            </select>
                        </div>
                    </div> --}}
                    <x-select id="religion" label="Agama" name="religion" required>
                        <option {{ $data->religion == 'Islam' ? 'selected' : '' }} value="Islam">Islam
                        </option>
                        <option {{ $data->religion == 'Kristen' ? 'selected' : '' }} value="Kristen">Kristen
                        </option>
                        <option {{ $data->religion == 'Hindu' ? 'selected' : '' }} value="Hindu">Hindu
                        </option>
                        <option {{ $data->religion == 'Budha' ? 'selected' : '' }} value="Budha">Budha
                        </option>
                        <option {{ $data->religion == 'Katolik' ? 'selected' : '' }} value="Katolik">Katolik
                        </option>
                        <option {{ $data->religion == 'Protestan' ? 'selected' : '' }} value="Protestan">
                            Protestan</option>
                        <option {{ $data->religion == 'Konghucu' ? 'selected' : '' }} value="Konghucu">Konghucu
                        </option>
                    </x-select>
                    <x-input type="email" id="email" label="Surel" name="email" type="text"
                        value="{{ old('email', $data->email) }}" required />
                    {{-- <div>
                        <p>Status Pernikahan :</p>
                        <div class="mt-2">
                            <select id="marrital_status" name="marrital_status"
                                class="block py-3 pl-3 pr-10 w-full text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="Single" {{ $data->marrital_status == 'Single' ? 'selected' : '' }}>
                                    Lajang</option>
                                <option value="Married" {{ $data->marrital_status == 'Married' ? 'selected' : '' }}>
                                    Menikah</option>
                                <option value="Divorved" {{ $data->marrital_status == 'Divorved' ? 'selected' : '' }}>
                                    Cerai</option>
                            </select>
                        </div>
                    </div> --}}
                    <x-select id="marrital_status" label="Status Pernikahan" name="marrital_status" required>
                        <option value="Single" {{ $data->marrital_status == 'Single' ? 'selected' : '' }}>
                            Lajang</option>
                        <option value="Married" {{ $data->marrital_status == 'Married' ? 'selected' : '' }}>
                            Menikah</option>
                        <option value="Divorved" {{ $data->marrital_status == 'Divorved' ? 'selected' : '' }}>
                            Cerai</option>
                    </x-select>
                    <x-input id="instagram" label="Tautan Instagram" name="instagram" type="text"
                        value="{{ old('instagram', $data->instagram) }}" />
                    <x-input id="youtube" label="Tautan YouTube" name="youtube" type="text"
                        value="{{ old('youtube', $data->youtube) }}" />
                    <x-input id="facebook" label="Tautan Facebook" name="facebook" type="text"
                        value="{{ old('facebook', $data->facebook) }}" />
                    <x-input id="source_of_information" label="Informasi Lainnya" name="source_of_information"
                        type="text" value="{{ old('source_of_information', $data->source_of_information) }}" />
                </div>
                <div class="max-md:w-2/3 max-md:mx-auto md:w-1/3 lg:w-1/6 xl:w-1/6 ml-auto pt-5">
                    <x-button type="submit">Edit Pasien</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
