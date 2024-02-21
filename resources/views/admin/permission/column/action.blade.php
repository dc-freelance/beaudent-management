<div class="lg:flex gap-x-2">
    <a href="{{ route('admin.permission.edit', $data->id) }}"
        class="text-white bg-blue-500 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center capitalize">
        {{-- <i class="fas fa-pencil fa-sm"></i> --}}
        edit
    </a>
    <label onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
        class="text-white bg-primary hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center cursor-pointer capitalize">
        {{-- <i class="fas fa-trash fa-sm"></i> --}}
        hapus
    </label>
</div>
