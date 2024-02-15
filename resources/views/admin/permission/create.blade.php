<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Permission', 'url' => route('admin.permission.index')],
        ['name' => 'Tambah Permission', 'url' => ''],
    ]" title="Tambah Permission" />

    <div class="w-1/2">
        <x-card-container>
            <form action="{{ route('admin.permission.store') }}" method="POST">
                @csrf
                <x-input id="name" label="Nama" name="name" required />
                <div class="mt-6">
                    <x-button type="submit">Simpan</x-button>
                </div>
        </x-card-container>
    </div>
</x-app-layout>
