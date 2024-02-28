<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Kategori Barang', 'url' => route('admin.item-category.index')],
        ['name' => 'Tambah Kategori Barang', 'url' => ''],
    ]" title="Tambah Kategori Barang" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.item-category.store') }}" method="POST" class="space-y-6">
                @csrf
                <x-input id="name" label="Nama" name="name" required />
                <div class="mt-6 w-full md:w-1/3 lg:w-1/2">
                    <x-button type="submit" class="mt-6">Tambah Kategori Barang</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
