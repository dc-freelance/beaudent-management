<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Permission', 'url' => route('admin.permission.index')],
        ['name' => 'Tambah Permission', 'url' => ''],
    ]" title="Tambah Permission" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.permission.store') }}" method="POST">
                @csrf
                <x-input id="name" label="Nama" name="name" required />
                <div class="mt-6 w-2/3 max-md:mx-auto md:w-1/3 lg:w-1/4">
                    <x-button type="submit">Simpan</x-button>
                </div>
        </x-card-container>
    </div>
</x-app-layout>
