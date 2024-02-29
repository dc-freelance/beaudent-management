<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Metode Pembayaran', 'url' => route('admin.payment-methods.index')],
        ['name' => 'Tambah Metode Pembayaran', 'url' => ''],
    ]" title="Tambah Metode Pembayaran" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.payment-methods.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <x-input id="name" label="Nama" name="name" required />
                </div>
                <div class="max-md:w-2/3 max-md:mx-auto md:w-1/2 lg:w-1/2 xl:w-1/2 pt-5">
                    <x-button type="submit">Tambah Metode Pembayaran</x-button>
                </div>
            </form>
        </x-card-container>
    </div>

</x-app-layout>
