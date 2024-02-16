<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Pemasok', 'url' => route('admin.supplier.index')],
        ['name' => 'Ubah Pemasok'],
    ]" title="Ubah Pemasok" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.supplier.update', $data->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <x-input id="name" label="Nama" name="name" required value="{{ $data->name }}" />
                <x-input id="phone_number" label="No. Telepon" name="phone_number" required
                    value="{{ $data->phone_number }}" />
                <x-textarea id="address" label="Alamat" name="address" required value="{{ $data->address }}" />
                <x-input id="debt" label="Hutang" name="debt" type="number" required
                    value="{{ number_format($data->debt, 0, ',', '') }}" />
                <div class="mt-6">
                    <x-button type="submit">Simpan Perubahan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
