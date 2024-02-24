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
                <div class="mt-6">
                    <x-button type="submit">Tambah Metode Pembayaran</x-button>
                </div>
            </form>
        </x-card-container>
    </div>

</x-app-layout>
