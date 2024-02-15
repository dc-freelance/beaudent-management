<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Permission', 'url' => route('admin.permission.index')],
        ['name' => 'Ubah Permission', 'url' => ''],
    ]" title="Ubah Permission" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.permission.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <x-input id="name" label="Nama" name="name" required value="{{ $data->name }}" />
                <div class="mt-6">
                    <x-button type="submit">Simpan</x-button>
                </div>
        </x-card-container>
    </div>
</x-app-layout>
