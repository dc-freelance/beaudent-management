<div class="lg:flex gap-x-2">
    @can('update_item_unit')
        <a href="{{ route('admin.item-unit.edit', $data->id) }}"
            class="btn btn-edit">
            Ubah
        </a>
    @endcan
    @can('delete_item_unit')
        <label onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
            class="btn btn-delete">
            Hapus
        </label>
    @endcan
</div>
