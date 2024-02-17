<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Layanan Tambahan', 'url' => route('admin.addon.index')],
        ['name' => 'Ubah Layanan Tambahan', 'url' => ''],
    ]" title="Ubah Layanan Tambahan" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.addon.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <x-input id="name" label="Nama Layanan Tambahan" name="name" value="{{ old('name', $data->name) }}" required />
                    <x-input id="price" label="Harga" name="price" type="number"  value="{{ old('price', $data->price) }}" required />
                    <x-input id="fee_percentage" label="Persentase Biaya" name="fee_percentage" type="number" value="{{ old('fee_percentage', $data->fee_percentage) }}" required />
                </div>
                <div class="mt-6">
                    <x-button type="submit">Simpan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>