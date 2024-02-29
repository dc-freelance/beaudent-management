<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Kategori Layanan', 'url' => route('admin.treatment-categories.index')],
        ['name' => 'Tambah Kategori Layanan', 'url' => ''],
    ]" title="Tambah Kategori Layanan" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.treatment-categories.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <x-input id="category" label="Kategori" name="category" required />
                </div>
                <div class="max-md:w-full md:w-1/2 lg:w-1/3 xl:w-1/3 pt-5">
                    <x-button type="submit">Tambah Kategori Layanan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>

</x-app-layout>
