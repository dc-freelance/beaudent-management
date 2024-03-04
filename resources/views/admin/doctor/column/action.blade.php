<div class="lg:flex gap-x-2">
    @can('update_doctor')
        <a href="{{ route('admin.doctor.edit', $data->id) }}"
            class="btn btn-edit">
            Ubah
        </a>
    @endcan
    @can('delete_doctor')
        <button onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
            class="btn btn-delete">
            Hapus
        </button>
    @endcan
</div>
