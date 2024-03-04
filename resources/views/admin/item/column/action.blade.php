<div class="lg:flex gap-x-2">
    @can('update_item')
        <a href="{{ route('admin.item.edit', $data->id) }}"
            class="btn btn-edit">
            Ubah
        </a>
    @endcan
    @can('delete_item')
        <label onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
            class="btn btn-delete">
            Hapus
        </label>
    @endcan
</div>
