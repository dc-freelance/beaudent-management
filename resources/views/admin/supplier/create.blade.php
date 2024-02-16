<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Pemasok', 'url' => route('admin.supplier.index')],
        ['name' => 'Tambah Pemasok'],
    ]" title="Tambah Pemasok" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.supplier.store') }}" method="POST" class="space-y-6">
                @csrf
                <x-input id="name" label="Nama" name="name" required />
                <x-input id="phone_number" label="No. Telepon" name="phone_number" required />
                <x-textarea id="address" label="Alamat" name="address" required />
                <x-input id="debt" label="Hutang" name="debt" type="number" required />
                <div class="mt-6">
                    <x-button type="submit">Tambah Pemasok</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
