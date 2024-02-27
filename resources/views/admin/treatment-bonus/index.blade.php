<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Bonus Layanan', 'url' => ''],
    ]" title="Bonus Layanan" />

    <x-card-container>
        <div class="text-end mb-4">
            @can('create_treatment_bonus')
                <x-link-button route="{{ route('admin.treatment-bonus.create') }}" color="gray">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Bonus Layanan
                </x-link-button>
            @endcan
        </div>
        <table id="treatmentBonusTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Layanan</th>
                    <th>Kategori Dokter</th>
                    <th>Tipe Bonus</th>
                    <th>Bonus</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </x-card-container>

    @push('js-internal')
        <script>
            function btnDelete(_id, _name) {
                let url = "{{ route('admin.treatment-bonus.delete', ':id') }}".replace(':id', _id);
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Bonus layanan ${_name} akan dihapus!`,
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
                                    $('#treatmentBonusTable').DataTable().ajax.reload();
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
                $('#treatmentBonusTable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    ajax: '{{ route('admin.treatment-bonus.index') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'treatment',
                            name: 'treatment'
                        },
                        {
                            data: 'doctor_category',
                            name: 'doctor_category'
                        },
                        {
                            data: 'bonus_type',
                            name: 'bonus_type'
                        },
                        {
                            data: 'bonus_rate',
                            name: 'bonus_rate'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                });
            });

            @include('components.flash-message')
        </script>
    @endpush
</x-app-layout>
