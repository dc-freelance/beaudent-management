<div class="lg:flex gap-x-2">
    @can('update user')
        <a href="{{ route('admin.user-management.edit', $data->id) }}"
            class="text-white bg-orange-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
            Ubah
        </a>
    @endcan
    @can('delete user')
        <label for="modal" onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
            class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center cursor-pointer">
            Hapus
        </label>
    @endcan
</div>
