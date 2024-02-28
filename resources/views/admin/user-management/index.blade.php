<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Pengguna', 'url' => '#'],
    ]" title="Manajemen Pengguna" />

    <x-card-container>
        <div class="text-end mb-4">
            <x-link-button route="{{ route('admin.user-management.create') }}"
                class="tombol hover:opacity-80 ring-0 focus:border-none focus:ring-0">
                <i class="fas fa-plus mr-2"></i>
                Tambah Pengguna
            </x-link-button>
        </div>
        <table id="userTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Hak Akses</th>
                    <th>Cabang</th>
                    <th>Tgl. Bergabung</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </x-card-container>

    @push('js-internal')
        <script>
            function btnDelete(_id, _name) {
                let url = '{{ route('admin.user-management.delete', ':id') }}'.replace(':id', _id);
                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: `Pengguna ${_name} akan dihapus!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
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
                                Swal.fire(
                                    'Berhasil!',
                                    'Pengguna berhasil dihapus.',
                                    'success'
                                ).then(() => {
                                    $('#userTable').DataTable().ajax.reload(null, false);
                                });
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Gagal!',
                                    'Pengguna gagal dihapus.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            }

            $(function() {
                $('#userTable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    ajax: '{{ route('admin.user-management.index') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'phone_number',
                            name: 'phone_number'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        {
                            data: 'branch',
                            name: 'branch'
                        },
                        {
                            data: 'join_date',
                            name: 'join_date'
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
