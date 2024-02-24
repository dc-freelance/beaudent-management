<div class="lg:flex gap-x-2">
    <a href="{{ route('admin.doctor-schedule.edit', $data->id) }}"
        class="text-white bg-blue-500 focus:ring-4 hover:bg-blue-800 transition duration-200 focus:outline-none focus:ring-blue-600 font-medium rounded-md text-sm p-2 text-center inline-flex items-center capitalize px-4">
        edit
    </a>
    <label onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
        class="text-white bg-primary hover:bg-red-800 transition duration-200 focus:ring-4 focus:outline-none focus:ring-red-500 font-medium rounded-md text-sm p-2 text-center inline-flex items-center cursor-pointer capitalize">
        hapus
    </label>
</div>
