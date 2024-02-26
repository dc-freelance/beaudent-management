<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Menunggu Konfirmasi', 'url' => route('front-office.reservations.wait.index')],
    ]" title="Menunggu Konfirmasi" />

    <x-tab-container>
        <div class="flex justify-between items-center mb-4">
            <div>
                <label for="datepicker" class="text-sm font-medium text-gray-500 mr-2">Pilih Tanggal Kunjungan:</label>
                <input type="date" id="datepicker" name="date" class="border border-gray-200 rounded px-2 py-1">
            </div>
        </div>

        <table id="reservationsTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>No Reservasi</th>
                    <th>Nama Pelanggan</th>
                    <th>Cabang</th>
                    <th>Tanggal Kunjungan</th>
                    <th>Waktu Kunjungan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </x-tab-container>

    @push('js-internal')
        <script>
            var today = new Date();

            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;

            document.getElementById('datepicker').value = today;

            function btnDelete(_id, _name) {
                let url = "{{ route('front-office.reservations.delete', ':id') }}".replace(':id', _id);
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Reservasi ${_name} akan dihapus!`,
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
                $('#reservationsTable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    responsive: true,
                    ajax: {
                        url: '{{ route('front-office.reservations.wait.index') }}',
                        data: function(d) {
                            d.date = $('#datepicker').val();
                        }
                    },
                    columns: [{
                            data: 'id',
                            name: 'id'
                        }, {
                            data: 'no',
                            name: 'no'
                        },

                        {
                            data: 'customer_id',
                            name: 'customer_id'
                        },
                        {
                            data: 'branch_id',
                            name: 'branch_id'
                        },
                        {
                            data: 'request_date',
                            name: 'request_date'
                        },
                        {
                            data: 'request_time',
                            name: 'request_time'
                        },
                        {
                            data: 'is_control',
                            name: 'is_control'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ],
                    createdRow: function(row, data, index) {
                        $('td', row).eq(0).html(index + 1);
                    }
                });

                $('#datepicker').change(function() {
                    $('#reservationsTable').DataTable().ajax.reload();
                });
            });

            @include('components.flash-message')
        </script>
    @endpush
</x-app-layout>
