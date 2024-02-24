<div class="lg:flex gap-x-2">
    <a href="{{ route('admin.user-management.edit', $data->id) }}"
        class="text-white capitalize px-4 bg-blue-500 hover:bg-blue-800 transition duration-200 focus:ring-4 focus:outline-none focus:ring-blue-600 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
        edit
    </a>
    <label for="modal" onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
        class="text-white capitalize bg-primary hover:bg-red-800 focus:ring-4 transition duration-200 focus:outline-none focus:ring-red-500 font-medium rounded-md text-sm p-2 text-center inline-flex items-center cursor-pointer">
        hapus
    </label>
</div>
