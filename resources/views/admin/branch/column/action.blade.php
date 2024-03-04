<div class="lg:flex gap-x-2">
    @can('update_branch')
        <a href="{{ route('admin.branch.edit', $data->id) }}"
            class="btn btn-edit">
            Ubah
        </a>
    @endcan
    @can('delete_branch')
        <button onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
            class="btn btn-delete">
            Hapus
        </button>
    @endcan
</div>
