<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Cabang', 'url' => route('admin.branch.index')],
    ]" title="Manajemen Cabang" />

    <x-card-container>
        <div class="text-end mb-4">
            @can('create_branch')
                <x-link-button route="{{ route('admin.branch.create') }}" color="gray">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Cabang
                </x-link-button>
            @endcan
        </div>
        <table id="shiftLogTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sesi</th>
                    <th>Sesi Dibuka Pada</th>
                    <th>Sesi Ditutup Pada</th>
                    <th>Pengguna</th>
                    <th>Cabang</th>
                    <th>Total Uang Yang Harus Dibayarkan</th>
                    <th>Total Uang Yang Diterima</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </x-card-container>

    @push('js-internal')
        <script>
            function btnDelete(_id, _name) {
                let url = "{{ route('admin.branch.delete', ':id') }}".replace(':id', _id);
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
                $('#shiftLogTable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    responsive: true,
                    ajax: '{{ route('front-office.shift-log.recap-shift') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'config_shift',
                            name: 'config_shift'
                        },
                        {
                            data: 'start_time',
                            name: 'start_time'
                        },
                        {
                            data: 'end_time',
                            name: 'end_time'
                        },
                        {
                            data: 'user',
                            name: 'user'
                        },
                        {
                            data: 'branch',
                            name: 'branch'
                        },
                        {
                            data: 'total_cash_payment',
                            name: 'total_cash_payment'
                        },
                        {
                            data: 'total_cash_received',
                            name: 'total_cash_received'
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
