<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Hak Akses', 'url' => route('admin.role.index')],
        ['name' => 'Tambah', 'url' => ''],
    ]" title="Tambah Hak Akses" />

    <x-card-container>
        <form action="{{ route('admin.role.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-6">
                <h3 class=" font-medium text-base">Informasi Hak Akses</h3>
                <div class="space-y-6">
                    <x-input id="name" label="Nama" name="name" required />
                    <div>
                        <p>Permission</p>
                        <div class="grid grid-cols-2 gap-6 mt-6">
                            @foreach ($permissions as $permission)
                                {{-- checkbox --}}
                                <div class="flex items-center space-x-2">
                                    <input type="checkbox" name="permissions[]" id="{{ $permission->name }}"
                                        value="{{ $permission->name }}" class="checkbox checkbox-primary">
                                    <label
                                        for="{{ $permission->name }}">{{ ucwords(str_replace('_', ' ', $permission->name)) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <x-button type="submit" class="mt-6">Tambah Hak Akses</x-button>
                </div>
            </div>
        </form>
    </x-card-container>
</x-app-layout>
