<div class="lg:flex gap-x-2">
    @can('update_doctor_category')
        <a href="{{ route('admin.doctor-category.edit', $data->id) }}"
            class="btn btn-edit">
            Ubah
        </a>
    @endcan
    @can('delete_doctor_category')
        <label onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
            class="btn btn-delete">
            Hapus
        </label>
    @endcan
</div>
