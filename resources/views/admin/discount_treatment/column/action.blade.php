<div class="lg:flex gap-x-2">
    @can('update_discount_treatment')
        <a href="{{ route('admin.discount_treatment.edit', $data->id) }}"
            class="btn btn-edit">
            Ubah
        </a>
    @endcan
    @can('delete_discount_treatment')
        <label onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
            class="btn btn-delete">
            Hapus
        </label>
    @endcan
</div>
