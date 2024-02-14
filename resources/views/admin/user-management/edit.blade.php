<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Pengguna', 'url' => route('admin.user-management.index')],
        ['name' => $user->name, 'url' => route('admin.user-management.edit', $user->id)],
    ]" title="Edit Pengguna" />

    <x-card-container>
        <form action="{{ route('admin.user-management.update', $user->id) }}" method="post" class="">
            @csrf
            @method('put')
            <div class="grid grid-cols-2">
                <h3 class=" font-medium text-base">Informasi Pengguna</h3>
                <div class="space-y-6">
                    <x-input id="name" label="Nama" name="name" required value="{{ $user->name }}" />
                    <x-input id="email" label="Email" name="email" required value="{{ $user->email }}" />
                    <x-button type="submit">
                        Simpan Perubahan
                    </x-button>
                </div>
            </div>
        </form>
        <form action="{{ route('admin.user-management.update-permission', $user->id) }}" method="post" class="mt-8">
            @csrf
            @method('put')
            <div class="grid grid-cols-2">
                <h3 class="font-medium text-base">Permission</h3>
                <div class="space-y-6">
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($permissions as $permission)
                            <div>
                                <input type="checkbox" class="rounded-sm" name="permission[]"
                                    id="{{ $permission->name }}" value="{{ $permission->name }}"
                                    @if ($user->hasPermissionTo($permission->name)) checked @endif>
                                <label for="{{ $permission->name }}">{{ $permission->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    <x-button type="submit">
                        Ubah Permission
                    </x-button>
                </div>
            </div>
        </form>
    </x-card-container>
</x-app-layout>
