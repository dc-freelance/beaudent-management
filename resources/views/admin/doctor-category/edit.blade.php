<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Kategori Dokter', 'url' => route('admin.doctor-category.index')],
        ['name' => 'Edit Kategori', 'url' => ''],
    ]" title="Edit Kategori Dokter" />

    <div class="w-1/2">
        <x-card-container>
            <form action="{{ route('admin.doctor-category.update', $data->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <x-input id="name" label="Nama" name="name" required value="{{ $data->name }}" />
                <div class="max-md:w-full md:w-1/2 lg:w-1/2 xl:w-1/2 pt-5">
                    <x-button type="submit">Simpan Perubahan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
