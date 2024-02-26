<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Deposit Terkonfirmasi', 'url' => route('front-office.deposit.confirm.index')],
    ]" title="Deposit Terkonfirmasi" />

    <x-tab-container>
        <div class="flex justify-between items-center mb-4">
            <div>
                <label for="datepicker" class="text-sm font-medium text-gray-500 mr-2">Pilih Tanggal Transfer:</label>
                <input type="date" id="datepicker" name="date" class="border border-gray-200 rounded px-2 py-1">
            </div>
        </div>

        <table id="depositTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>No Reservasi</th>
                    <th>Nama Pelanggan</th>
                    <th>Cabang</th>
                    <th>Tanggal Transfer</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </x-tab-container>

    @push('js-internal')
        <script>
            $(function() {
                $('#depositTable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    responsive: true,
                    ajax: {
                        url: '{{ route('front-office.deposit.confirm.index') }}',
                        data: function(d) {
                            d.date = $('#datepicker').val();
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
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
                            data: 'transfer_date',
                            name: 'transfer_date'
                        },
                        {
                            data: 'deposit',
                            name: 'deposit'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ]
                });

                $('#datepicker').change(function() {
                    $('#depositTable').DataTable().ajax.reload();
                });
            });

            @include('components.flash-message')
        </script>
    @endpush
</x-app-layout>
