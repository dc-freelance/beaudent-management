<div class="lg:flex gap-x-2">
    @can('update_treatment_bonus')
        <a href="{{ route('admin.treatment-bonus.edit', $data->id) }}"
            class="btn btn-edit">
            Ubah
        </a>
    @endcan
    @can('delete_treatment_bonus')
        <label onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
            class="btn btn-delete">
            Hapus
        </label>
    @endcan
</div>
