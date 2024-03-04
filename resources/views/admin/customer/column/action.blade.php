<div class="lg:flex gap-x-2">
    @can('update_customer')
        <a href="{{ route('admin.customer.edit', $data->id) }}"
            class="btn btn-edit">
            Ubah
        </a>
    @endcan
    @can('detail_customer')
        <a href="{{ route('admin.customer.detail', $data->id) }}"
            class="btn btn-primary">
            Detail
        </a>
    @endcan
    @can('delete_customer')
        <label onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
            class="btn btn-delete">
            Hapus
        </label>
    @endcan
</div>
