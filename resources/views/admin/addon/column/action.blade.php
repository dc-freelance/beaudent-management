<div class="lg:flex gap-x-2">
    @can('update_addon')
        <a href="{{ route('admin.addon.edit', $data->id) }}"
            class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-600 transition duration-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
            Ubah
        </a>
    @endcan
    @can('delete_addon')
        <label onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
            class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-600 transition duration-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center cursor-pointer">
            Hapus
        </label>
    @endcan
</div>
