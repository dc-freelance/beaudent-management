<div class="lg:flex gap-x-2">
    @can('update_treatment_category')
        <a href="{{ route('admin.treatment-categories.edit', $data->id) }}"
            class="btn btn-edit">
            Ubah
        </a>
    @endcan
    @can('delete_treatment_category')
        <button onclick="btnDelete('{{ $data->id }}', '{{ $data->category }}')"
            class="btn btn-delete">
            Hapus
        </button>
    @endcan
</div>
