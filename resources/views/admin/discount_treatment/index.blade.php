<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Diskon Layanan', 'url' => route('admin.discount_treatment.index')],
    ]" title="Manajemen Diskon Layanan" />

    <x-card-container>
        <div class="text-end mb-4">
            @can('create_discount_treatment')
                <x-link-button route="{{ route('admin.discount_treatment.create') }}" color="gray">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Diskon Layanan
                </x-link-button>
            @endcan
        </div>
        <table id="discountTreatmentTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Diskon</th>
                    <th>Layanan</th>
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
                let url = "{{ route('admin.discount_treatment.delete', ':id') }}".replace(':id', _id);
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Diskon Layanan ${_name} akan dihapus!`,
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
                $('#discountTreatmentTable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    responsive: true,
                    ajax: '{{ route('admin.discount_treatment.index') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'discount_id',
                            name: 'discount_id'
                        },
                        {
                            data: 'treatment_id',
                            name: 'treatment_id'
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
