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
                <x-input id="phone_number" label="No. Telepon" name="phone_number" type="number" required />
                <x-textarea id="address" label="Alamat" name="address" required />
                <div class="max-md:w-2/3 max-md:mx-auto md:w-1/3 lg:w-1/3 xl:w-1/3 pt-5">
                    <x-button type="submit">Tambah Pemasok</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
