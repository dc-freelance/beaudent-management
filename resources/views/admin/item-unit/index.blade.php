<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Satuan Barang', 'url' => route('admin.item-unit.index')],
    ]" title="Manajemen Satuan Barang" />

    <x-card-container>
        <div class="text-end mb-4">
            @can('create item unit')
                <x-link-button route="{{ route('admin.item-unit.create') }}" color="gray">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Satuan Barang
                </x-link-button>
            @endcan
        </div>
        <table id="itemUnitTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </x-card-container>

    @push('js-internal')
        <script>
            function btnDelete(_id, _name) {
                let url = "{{ route('admin.item-unit.delete', ':id') }}".replace(':id', _id);
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Satuan barang "${_name}" akan dihapus!`,
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
                                    );
                                    $('#itemUnitTable').DataTable().ajax.reload();
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
                                    xhr.responseText,
                                    'error'
                                );
                            }
                        });
                    }
                });
            }

            $(function() {
                $('#itemUnitTable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    ajax: '{{ route('admin.item-unit.index') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            });

            @include('components.flash-message')
        </script>
    @endpush
</x-app-layout>
