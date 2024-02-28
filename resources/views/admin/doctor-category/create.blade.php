<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Kategori Dokter', 'url' => ''],
        ['name' => 'Tambah Kategori', 'url' => ''],
    ]" title="Tambah Kategori Dokter" />

    <div class="w-1/2">
        <x-card-container>
            <form action="{{ route('admin.doctor-category.store') }}" method="POST" class="space-y-6">
                @csrf
                <x-input id="name" label="Nama" name="name" required />
                <div class="max-md:w-full md:w-1/2 lg:w-1/2">
                    <x-button type="submit">Tambah Kategori</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
