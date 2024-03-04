<div class="lg:flex gap-x-2">
    @can('update_doctor_schedule')
        <a href="{{ route('admin.doctor-schedule.edit', $data->id) }}"
            class="btn btn-edit">
            Ubah
        </a>
    @endcan
    @can('delete_doctor_schedule')
        <button onclick="btnDelete('{{ $data->id }}', '{{ $data->doctor->name }}')"
            class="btn btn-delete">
            Hapus
        </button>
    @endcan
</div>
