<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Deposit Dibatalkan', 'url' => route('front-office.deposit.cancel.index')],
    ]" title="Deposit Dibatalkan" />

    <x-card-container>
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
    </x-card-container>

    @push('js-internal')
        <script>
            $(function() {
                $('#depositTable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    responsive: true,
                    ajax: '{{ route('front-office.deposit.cancel.index') }}',
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
            });

            @include('components.flash-message')
        </script>
    @endpush
</x-app-layout>
