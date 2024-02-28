<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Satuan Barang', 'url' => route('admin.item-unit.index')],
        ['name' => 'Ubah Satuan Barang', 'url' => ''],
    ]" title="Ubah Satuan Barang" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.item-unit.update', $data->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <x-input id="name" label="Nama" name="name" required value="{{ $data->name }}" />
                <div class="mt-6 w-full md:w-1/3 lg:w-1/2">
                    <x-button type="submit" class="mt-6">Simpan Perubahan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
