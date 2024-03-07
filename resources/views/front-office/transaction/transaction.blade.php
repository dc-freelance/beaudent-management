<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Transaksi', 'url' => route('front-office.transaction.list-transaction')],
        ['name' => 'Riwayat Transaksi', 'url' => ''],
    ]" title="Riwayat Pembayaran - ({{auth()->user()->branch->code}}) {{ auth()->user()->branch->name }}" />

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
                    ajax: '{{ route('front-office.transaction.list-transaction') }}',
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

            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ Session::get('success') }}',
                    showCancelButton: true,
                    confirmButtonText: 'Oke',
                    cancelButtonText: 'Cetak',
                    cancelButtonColor: '#3085d6',
                    confirmButtonColor: '#d33',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('front-office.transaction.list-transaction') }}";
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        window.location.href = "{{ route('front-office.transaction.print-transaction', session('transaction')) }}";
                    }
                });
            @endif
        </script>
    @endpush
</x-app-layout>
