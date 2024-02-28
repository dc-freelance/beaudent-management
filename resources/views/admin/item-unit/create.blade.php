<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Satuan Barang', 'url' => route('admin.item-unit.index')],
        ['name' => 'Tambah Satuan Barang', 'url' => ''],
    ]" title="Tambah Satuan Barang" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.item-unit.store') }}" method="POST" class="space-y-6">
                @csrf
                <x-input id="name" label="Nama" name="name" required />
                <div class="mt-6">
                    <x-button type="submit" class="mt-6">Tambah Satuan Barang</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
