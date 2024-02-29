<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Pembayaran', 'url' => route('front-office.transaction.list-billing')],
        ['name' => 'Antrian Pembayaran', 'url' => ''],
    ]" title="Antrian Pembayaran - ({{auth()->user()->branch->code}}) {{ auth()->user()->branch->name }}" />

    <x-card-container>
        <table id="transactionTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode Transaksi</th>
                    <th>Nama Pasien</th>
                    <th>Nama Dokter</th>
                    <th>Pengajuan Tanggal Pemeriksaan</th>
                    <th>Pengajuan Waktu Pemeriksaan</th>
                    <th>Total Deposit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </x-card-container>

    @push('js-internal')
        <script>
            $(function() {
                $('#transactionTable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    responsive: true,
                    ajax: '{{ route('front-office.transaction.list-billing') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'code',
                            name: 'code'
                        },
                        {
                            data: 'customer',
                            name: 'customer'
                        },
                        {
                            data: 'doctor',
                            name: 'doctor'
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
                            data: 'deposit',
                            name: 'deposit'
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
