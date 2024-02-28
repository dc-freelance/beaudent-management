<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Cabang', 'url' => route('admin.branch.index')],
        ['name' => 'Tambah Cabang', 'url' => ''],
    ]" title="Tambah Cabang" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.branch.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <x-input id="code" label="Kode Cabang" name="code" value="{{ $generate_code }}"
                        readonly="readonly" required />
                    <x-input id="name" label="Nama Cabang" name="name" required />
                    <x-input id="phone_number" label="Nomor Telepon" name="phone_number" type="number" required />
                    <x-input id="address" label="Alamat" name="address" required />
                </div>
                <div class="mx-auto mt-6 w-full md:w-1/3 lg:w-1/2">
                    <x-button type="submit">Tambah Cabang</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
