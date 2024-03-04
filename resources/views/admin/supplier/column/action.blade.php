<div class="lg:flex gap-x-2">
    @can('update_supplier')
        <a href="{{ route('admin.supplier.edit', $data->id) }}"
            class="btn btn-edit">
            Ubah
        </a>
    @endcan
    @can('delete_supplier')
        <button onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
            class="btn btn-delete">
            Hapus
        </button>
    @endcan
</div>
