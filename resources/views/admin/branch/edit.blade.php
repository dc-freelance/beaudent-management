<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Cabang', 'url' => route('admin.branch.index')],
        ['name' => 'Ubah Cabang', 'url' => ''],
    ]" title="Ubah Cabang" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.branch.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <x-input id="code" label="Kode Cabang" name="code" value="{{ $data->code }}" readonly="readonly" required/>
                    <x-input id="name" label="Nama Cabang" name="name" value="{{ $data->name }}" required />
                    <x-input id="phone_number" label="Nomor Telepon" name="phone_number" type="number" value="{{ $data->phone_number }}" required />
                    <x-input id="address" label="Alamat" name="address" value="{{ $data->address }}" required />
                </div>
                <div class="mt-6">
                    <x-button type="submit">Simpan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>