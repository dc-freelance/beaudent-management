<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Hak Akses', 'url' => route('admin.role.index')],
        ['name' => 'Ubah', 'url' => ''],
    ]" title="Ubah Hak Akses" />

    <x-card-container>
        <form action="{{ route('admin.role.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-6">
                <h3 class=" font-medium text-base">Informasi Hak Akses</h3>
                <div class="space-y-6 w-2/3">
                    <x-input id="name" label="Nama" name="name" required value="{{ $role->name }}" />
                    <div class="">
                        <p>Permission</p>
                        <div class="grid max-md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                            @foreach ($permissions as $permission)
                                <div class="flex items-center space-x-2">
                                    <input type="checkbox" name="permissions[]" id="{{ $permission->name }}"
                                        value="{{ $permission->name }}"
                                        class="checkbox checkbox-primary rounded-sm hover:cursor-pointer text-blue-600 focus:ring-blue-600 focus:ring-1"
                                        @if ($role->hasPermissionTo($permission->name)) checked @endif>
                                    <label
                                        for="{{ $permission->name }}">{{ ucwords(str_replace('_', ' ', $permission->name)) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <x-button type="submit" class="mt-6">Ubah Hak Akses</x-button>
                </div>
            </div>
        </form>
    </x-card-container>
</x-app-layout>
