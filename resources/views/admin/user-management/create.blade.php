<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Pengguna', 'url' => route('admin.user-management.index')],
        ['name' => 'Tambah', 'url' => '#'],
    ]" title="Tambah Pengguna" />

    <x-card-container>

        <form action="{{ route('admin.user-management.store') }}" method="post">
            @csrf
            <div class="grid grid-cols-2 gap-6">
                <h3 class=" font-medium text-base">Informasi Pengguna</h3>
                <div class="space-y-6">
                    <x-input id="name" label="Nama" name="name" required />
                    <x-input id="email" label="Email" name="email" required />
                    <div>
                        <p>Role</p>
                        <div class="flex flex-wrap gap-6 mt-6">
                            @foreach ($roles as $role)
                                {{-- radio --}}
                                <div class="flex items-center space-x-2">
                                    <input type="radio" name="role" id="{{ $role->name }}"
                                        value="{{ $role->name }}" class="radio radio-primary">
                                    <label
                                        for="{{ $role->name }}">{{ ucwords(str_replace('_', ' ', $role->name)) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-6 mt-6">
                <h3 class=" font-medium text-base">Permission</h3>
                <div class="grid grid-cols-2 gap-6">
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
                <div></div>
                <div>
                    <x-button type="submit" class="mt-6">Tambah Pengguna</x-button>
                </div>
            </div>

        </form>
    </x-card-container>
</x-app-layout>
