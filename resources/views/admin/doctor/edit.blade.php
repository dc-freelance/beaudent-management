<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Dokter', 'url' => route('admin.doctor.index')],
        ['name' => 'Ubah Dokter', 'url' => ''],
    ]" title="Ubah" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.doctor.update', $data->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <x-input id="name" label="Nama Lengkap" name="name" required :value="$data->name" />
                <x-select id="category_id" label="Kategori" name="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $data->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </x-select>
                <div class="grid grid-cols-2 gap-3">
                    <x-input id="email" label="Email" name="email" type="email" required :value="$data->email" />
                    <x-input id="phone_number" label="No. Telp" name="phone_number" type="number" required
                        :value="$data->phone_number" />
                </div>
                <x-input id="join_date" label="Tgl. Bergabung" name="join_date" type="date" required
                    :value="$data->join_date" />
                <div class="max-md:w-full md:w-1/2 lg:w-1/2 xl:w-1/2 pt-5">
                    <x-button type="submit">Simpan Perubahan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
