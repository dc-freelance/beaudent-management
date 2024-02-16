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
                <div>
                    <p>Kategori</p>
                    <div class="mt-1">
                        <select id="category_id" name="category_id"
                            class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if ($category->id == $data->category_id) selected @endif>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <x-input id="email" label="Email" name="email" type="email" required :value="$data->email" />
                <x-input id="phone_number" label="No. Telp" name="phone_number" required :value="$data->phone_number" />
                <x-input id="join_date" label="Tgl. Bergabung" name="join_date" type="date" required
                    :value="$data->join_date" />
                <div class="mt-6">
                    <x-button type="submit">Simpan Perubahan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
