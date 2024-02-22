<div class="lg:flex gap-x-2">
    <a href="{{ route('admin.permission.edit', $data->id) }}"
        class="text-white bg-blue-500 hover:bg-blue-800 transition duration-200 ease-in-out focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
        {{-- <i class="fas fa-pencil fa-sm"></i> --}}
        Edit
    </a>
    <label onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
        class="text-white bg-primary hover:bg-red-800 transition duration-200 ease-in-out focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center cursor-pointer">
        {{-- <i class="fas fa-trash fa-sm"></i> --}}
        Hapus
    </label>
</div>
