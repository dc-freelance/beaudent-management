<div class="lg:flex gap-x-2">
    @can('update_user')
        <a href="{{ route('admin.user-management.edit', $data->id) }}"
            class="btn btn-edit">
            Ubah
        </a>
    @endcan
    @can('delete_user')
        <button for="modal" onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
            class="btn btn-delete">
            Hapus
        </button>
    @endcan
</div>
