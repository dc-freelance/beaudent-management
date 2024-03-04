<div class="lg:flex gap-x-2">
    @can('update_config_shift')
        <a href="{{ route('admin.config-shift.edit', $data->id) }}"
            class="btn btn-edit">
            Ubah
        </a>
    @endcan
    @can('delete_config_shift')
        <label onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
            class="btn btn-delete">
            Hapus
        </label>
    @endcan
</div>
