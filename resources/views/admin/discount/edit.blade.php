<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Diskon', 'url' => route('admin.discount.index')],
        ['name' => 'Ubah Diskon', 'url' => ''],
    ]" title="Ubah Diskon" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.discount.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <x-input id="name" label="Nama" name="name" required value="{{ $data->name }}" />
                    <div>
                        <label for="discount_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Tipe Diskon
                        </label>
                        <select id="control_list"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                            name="discount_type">
                            <option value="Percentage" {{ $data->discount_type == 'Percentage' ? 'selected' : '' }}>Persentase</option>
                            <option value="Nominal" {{ $data->discount_type == 'Nominal' ? 'selected' : '' }}>Nominal</option>
                        </select>
                    </div>
                    <x-input id="discount" label="Diskon" name="discount" type="number" required
                        value="{{ $data->discount }}" />
                    <x-input id="start_date" label="Awal Periode Diskon" name="start_date" type="date" required
                        :value="$data->start_date" />
                    <x-input id="end_date" label="Akhir Periode Diskon" name="end_date" type="date" required
                        :value="$data->end_date" />
                        <div>
                            <label for="control_list" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Kontrol
                            </label>
                            <select id="control_list"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                name="is_active">
                                <option value="1" {{ $data->is_active == true ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ $data->is_active == false ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>
                </div>
                <div class="mt-6">
                    <x-button type="submit">Simpan Perubahan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>

</x-app-layout>
