<div class="lg:flex gap-x-2">
    @can('update_payment_method')
        <a href="{{ route('admin.payment-methods.edit', $data->id) }}"
            class="text-white bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-600 font-medium rounded-md text-sm p-2 text-center inline-flex items-center px-3 hover:bg-blue-600 transition duration-300 ease-in-out">
            Ubah
        </a>
    @endcan
    @can('delete_payment_method')
        <label onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
            class="text-white bg-red-500 hover:bg-red-600 transition duration-300 ease-in-out focus:ring-4 focus:outline-none focus:ring-red-600 font-medium rounded-md text-sm p-2 text-center inline-flex items-center cursor-pointer">
            Hapus
        </label>
    @endcan
</div>
