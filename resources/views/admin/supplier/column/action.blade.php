<div class="lg:flex gap-x-2">
    <a href="{{ route('admin.supplier.edit', $data->id) }}"
        class="text-white bg-orange-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
        <i class="fas fa-pencil fa-sm"></i>
    </a>
    <label onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
        class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center cursor-pointer">
        <i class="fas fa-trash fa-sm"></i>
    </label>
</div>
