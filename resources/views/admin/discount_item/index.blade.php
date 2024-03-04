<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Diskon Barang', 'url' => route('admin.discount_item.index')],
    ]" title="Manajemen Diskon Barang" />

    <x-card-container>
        <div class="text-end mb-4">
            @can('create_discount_treatment')
                <x-link-button route="{{ route('admin.discount_item.create') }}" class="btn btn-success">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Diskon Barang
                </x-link-button>
            @endcan
        </div>
        <table id="discountItemTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Diskon</th>
                    <th>Barang</th>
                    <th>Tipe Diskon</th>
                    <th>Diskon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </x-card-container>

    @push('js-internal')
        <script>
            function btnDelete(_id, _name) {
                let url = "{{ route('admin.discount_item.delete', ':id') }}".replace(':id', _id);
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Diskon Barang ${_name} akan dihapus!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.status) {
                                    Swal.fire(
                                        'Berhasil!',
                                        response.message,
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Gagal!',
                                        response.message,
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Gagal!',
                                    xhr.responseJSON.message,
                                    'error'
                                );
                            }
                        });
                    }
                });
            }

            $(function() {
                $('#discountItemTable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    responsive: true,
                    ajax: '{{ route('admin.discount_item.index') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'discount_id',
                            name: 'discount_id'
                        },
                        {
                            data: 'item_id',
                            name: 'item_id'
                        },
                        {
                            data: 'discount_type',
                            name: 'discount_type'
                        },
                        {
                            data: 'discount',
                            name: 'discount'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ]
                });
            });

            @include('components.flash-message')
        </script>
    @endpush
</x-app-layout>
