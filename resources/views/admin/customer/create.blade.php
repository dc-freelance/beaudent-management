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
                    {{-- <div>
                        <p>Jenis Kelamin :</p>
                        <div class="mt-2">
                            <select id="gender" name="gender"
                                class="block py-3 pl-3 pr-10 w-full text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md select-input">
                                <option {{ old('gender') == 'Male' ? 'selected' : '' }} value="Male">Laki-laki
                                </option>
                                <option {{ old('gender') == 'Female' ? 'selected' : '' }} value="Female">Perempuan
                                </option>
                            </select>
                        </div>
                    </div> --}}
                    <x-select id="gender" label="Jenis Kelamin" name="gender" required>
                        <option {{ old('gender') == 'Male' ? 'selected' : '' }} value="Male">Laki-laki
                        </option>
                        <option {{ old('gender') == 'Female' ? 'selected' : '' }} value="Female">Perempuan
                        </option>
                    </x-select>
                    <x-input id="occupation" label="Pekerjaan" name="occupation" type="text" required />
                    <x-input id="address" label="Alamat" name="address" required />
                    <x-input id="phone_number" label="Nomor Telepon" name="phone_number" type="number" required />
                    {{-- <x-input id="religion" label="Agama" name="religion" type="text" required /> --}}
                    {{-- <div>
                        <p>Agama <span class="text-red-600">*</span></p>
                        <div class="mt-2">
                            <select id="religion" name="religion"
                                class="py-3 pl-3 pr-10 w-full text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md select-input">
                                <option {{ old('religion') == 'Islam' ? 'selected' : '' }} value="Islam">Islam</option>
                                <option {{ old('religion') == 'Kristen' ? 'selected' : '' }} value="Kristen">Kristen
                                </option>
                                <option {{ old('religion') == 'Hindu' ? 'selected' : '' }} value="Hindu">Hindu</option>
                                <option {{ old('religion') == 'Budha' ? 'selected' : '' }} value="Budha">Budha
                                </option>
                                <option {{ old('religion') == 'Katolik' ? 'selected' : '' }} value="Katolik">Katolik
                                </option>
                                <option {{ old('religion') == 'Protestan' ? 'selected' : '' }} value="Protestan">
                                    Protestan</option>
                                <option {{ old('religion') == 'Konghucu' ? 'selected' : '' }} value="Konghucu">Konghucu
                                </option>
                            </select>
                        </div>
                    </div> --}}
                    <x-select id="religion" label="Agama" name="religion" required>
                        <option {{ old('religion') == 'Islam' ? 'selected' : '' }} value="Islam">Islam</option>
                        <option {{ old('religion') == 'Kristen' ? 'selected' : '' }} value="Kristen">Kristen
                        </option>
                        <option {{ old('religion') == 'Hindu' ? 'selected' : '' }} value="Hindu">Hindu</option>
                        <option {{ old('religion') == 'Budha' ? 'selected' : '' }} value="Budha">Budha
                        </option>
                        <option {{ old('religion') == 'Katolik' ? 'selected' : '' }} value="Katolik">Katolik
                        </option>
                        <option {{ old('religion') == 'Protestan' ? 'selected' : '' }} value="Protestan">
                            Protestan</option>
                        <option {{ old('religion') == 'Konghucu' ? 'selected' : '' }} value="Konghucu">Konghucu
                        </option>
                    </x-select>
                    <x-input type="email" id="email" label="Surel" name="email" type="text" required />
                    {{-- <div>
                        <p>Status Pernikahan :</p>
                        <div class="mt-2">
                            <select id="marrital_status" name="marrital_status"
                                class="block py-3 pl-3 pr-10 w-full text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md select-input">
                                <option {{ old('marrital_status') == 'Single' ? 'selected' : '' }} value="Single">
                                    Lajang</option>
                                <option {{ old('marrital_status') == 'Married' ? 'selected' : '' }} value="Married">
                                    Menikah</option>
                                <option {{ old('marrital_status') == 'Divorved' ? 'selected' : '' }} value="Divorved">
                                    Cerai</option>
                            </select>
                        </div>
                    </div> --}}
                    <x-select id="marrital_status" label="Status Pernikahan" name="marrital_status" required>
                        <option {{ old('marrital_status') == 'Single' ? 'selected' : '' }} value="Single">
                            Lajang</option>
                        <option {{ old('marrital_status') == 'Married' ? 'selected' : '' }} value="Married">
                            Menikah</option>
                        <option {{ old('marrital_status') == 'Divorved' ? 'selected' : '' }} value="Divorved">
                            Cerai</option>
                    </x-select>
                    <x-input id="instagram" label="Tautan Instagram" name="instagram" value="{{ old('instagram') }}"
                        type="text" />
                    <x-input id="youtube" label="Tautan YouTube" name="youtube" value="{{ old('youtube') }}"
                        type="text" />
                    <x-input id="facebook" label="Tautan Facebook" name="facebook" value="{{ old('facebook') }}"
                        type="text" />
                    <x-input id="source_of_information" label="Informasi Lainnya" name="source_of_information"
                        value="{{ old('source_of_information') }}" type="text" />
                </div>
                <div class="max-md:w-2/3 max-md:mx-auto md:w-1/3 lg:w-1/6 xl:w-1/6 ml-auto pt-5">
                    <x-button type="submit">Tambah Pasien</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
