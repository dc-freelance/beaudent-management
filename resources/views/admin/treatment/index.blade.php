<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Layanan', 'url' => route('admin.treatment.index')],
    ]" title="Manajemen Layanan" />

    <x-card-container>
        <div class="text-end mb-4">
            <x-link-button route="{{ route('admin.treatment.create') }}"
                class="tombol hover:opacity-80 ring-0 focus:border-none focus:ring-0">
                <i class="fas fa-plus mr-2"></i>
                Tambah Layanan
            </x-link-button>
        </div>
        <table id="treatmentTable" class="hover stripe">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Layanan Utama</th>
                    <th>Kontrol</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </x-card-container>

    @push('js-internal')
        <script>
            function btnDelete(_id, _name) {
                let url = "{{ route('admin.treatment.delete', ':id') }}".replace(':id', _id);
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Layanan ${_name} akan dihapus!`,
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
                $('#treatmentTable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    // responsive: true,   
                    scrollX: true,
                    ajax: '{{ route('admin.treatment.index') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'parent_id',
                            name: 'parent_id'
                        },
                        {
                            data: 'is_control',
                            name: 'is_control'
                        },
                        {
                            data: 'price',
                            name: 'price'
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
