<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Kategori Layanan', 'url' => route('admin.treatment-categories.index')],
        ['name' => 'Ubah Kategori Layanan', 'url' => ''],
    ]" title="Ubah Kategori Layanan" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.treatment-categories.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <x-input id="category" label="Kategori" name="category" required value="{{ $data->category }}" />
                </div>
                <div class="mt-6">
                    <x-button type="submit">Simpan Perubahan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>

</x-app-layout>
