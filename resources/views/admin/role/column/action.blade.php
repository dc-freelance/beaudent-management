<div class="lg:flex gap-x-2">
    @can('update_role')
        <a href="{{ route('admin.role.edit', $data->id) }}"
            class="btn btn-edit">
            Ubah
        </a>
    @endcan
    @can('delete_role')
        <button onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
            class="btn btn-delete">
            Hapus
        </button>
    @endcan
</div>
