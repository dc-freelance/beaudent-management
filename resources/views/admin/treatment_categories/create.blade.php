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
                <div class="mt-6">
                    <x-button type="submit">Tambah Metode Pembayaran</x-button>
                </div>
            </form>
        </x-card-container>
    </div>

</x-app-layout>
