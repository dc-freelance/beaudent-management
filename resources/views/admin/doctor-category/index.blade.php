<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Kategori Dokter', 'url' => ''],
    ]" title="Kategori Dokter" />

    <x-card-container>
        <div class="text-end mb-4">
            @can('create_doctor_category')
                <x-link-button route="{{ route('admin.doctor-category.create') }}"
                    class="tombol hover:opacity-80 ring-0 focus:border-none focus:ring-0">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Kategori Dokter
                </x-link-button>
            @endcan
        </div>
        <table id="doctorCategoryTable">
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
                let url = "{{ route('admin.doctor-category.delete', ':id') }}".replace(':id', _id);
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Kategori dokter "${_name}" akan dihapus!`,
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
                                    $('#doctorCategoryTable').DataTable().ajax.reload();
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
                $('#doctorCategoryTable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    scrollX: true,
                    ajax: '{{ route('admin.doctor-category.index') }}',
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
                        }
                    ]
                });
            });

            @include('components.flash-message')
        </script>
    @endpush

</x-app-layout>
