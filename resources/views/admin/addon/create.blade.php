<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Layanan Tambahan', 'url' => route('admin.addon.index')],
        ['name' => 'Tambah Layanan Tambahan', 'url' => ''],
    ]" title="Tambah Layanan Tambahan" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.addon.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <x-input id="name" label="Nama Layanan Tambahan" name="name" required />
                    <x-input id="price" label="Harga" name="price" type="number" required />
                    <x-input id="fee_percentage" label="Persentase Biaya" type="number" name="fee_percentage" required />
                </div>
                <div class="mt-6">
                    <x-button type="submit">Tambah Layanan Tambahan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>