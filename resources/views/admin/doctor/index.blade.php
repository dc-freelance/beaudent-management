<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Dokter', 'url' => ''],
    ]" title="Dokter" />

    <x-card-container>
        <div class="text-end mb-4">
            @can('create_doctor')
                <x-link-button route="{{ route('admin.doctor.create') }}" class="tombol hover:opacity-80">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Dokter
                </x-link-button>
            @endcan
        </div>
        <table id="doctorTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Email</th>
                    <th>No. Telp</th>
                    <th>Tgl. Bergabung</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
        </div>
    </x-card-container>

    @push('js-internal')
        <script>
            function btnDelete(_id, _name) {
                let url = "{{ route('admin.doctor.delete', ':id') }}".replace(':id', _id);
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Dokter "${_name}" akan dihapus!`,
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
                                    $('#doctorTable').DataTable().ajax.reload();
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
                $('#doctorTable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    ajax: '{{ route('admin.doctor.index') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'category',
                            name: 'category'
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
                            data: 'join_date',
                            name: 'join_date'
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
