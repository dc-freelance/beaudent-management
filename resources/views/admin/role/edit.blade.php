<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Hak Akses', 'url' => route('admin.role.index')],
        ['name' => 'Ubah', 'url' => ''],
    ]" title="Ubah Hak Akses" />

    <x-card-container>
        <form action="{{ route('admin.role.update', $role->id) }}" method="POST" class="px-5">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-6">
                <h3 class=" font-medium text-base">Informasi Hak Akses</h3>
                <div class="space-y-6">
                    <div class="w-1/3">
                        <x-input id="name" label="Nama" name="name" required value="{{ $role->name }}" />
                    </div>
                    <div>
                        <p>Permission</p>
                        <div class="grid grid-cols-2 gap-6 mt-6">
                            @foreach ($permissions as $permission)
                                {{-- checkbox --}}
                                <div class="flex items-center space-x-2">
                                    <input type="checkbox" name="permissions[]" id="{{ $permission->name }}"
                                        value="{{ $permission->name }}" class="checkbox checkbox-primary"
                                        @if ($role->hasPermissionTo($permission->name)) checked @endif>
                                    <label
                                        for="{{ $permission->name }}">{{ ucwords(str_replace('_', ' ', $permission->name)) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="max-md:w-full md:w-1/2 lg:w-1/3 mx-auto pt-5"><x-button type="submit"
                            class="px-10">Ubah Hak
                            Akses</x-button>
                    </div>
                </div>
            </div>
        </form>
    </x-card-container>
</x-app-layout>
