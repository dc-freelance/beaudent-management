<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Metode Pembayaran', 'url' => route('admin.payment-methods.index')],
        ['name' => 'Ubah Metode Pembayaran', 'url' => ''],
    ]" title="Ubah Metode Pembayaran" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.payment-methods.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <x-input id="name" label="Nama" name="name" required value="{{ $data->name }}" />
                </div>
                <div class="max-md:w-full md:w-1/2 lg:w-2/3 xl:w-2/3 pt-5">
                    <x-button type="submit">Simpan Perubahan</x-button>
                </div>
            </form>
        </x-card-container>
    </div>

</x-app-layout>
