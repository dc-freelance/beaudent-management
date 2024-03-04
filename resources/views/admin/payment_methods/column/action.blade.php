<div class="lg:flex gap-x-2">
    @can('update_payment_method')
        <a href="{{ route('admin.payment-methods.edit', $data->id) }}"
            class="btn btn-edit">
            Ubah
        </a>
    @endcan
    @can('delete_payment_method')
        <button onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
            class="btn btn-delete">
            Hapus
        </button>
    @endcan
</div>
