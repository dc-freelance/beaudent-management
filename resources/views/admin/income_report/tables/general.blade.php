<x-card-container>
    <table id="incomeReportTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Tanggal</th>
                <th>Cabang</th>
                <th>Pasien</th>
                <th>Metode Pembayaran</th>
                <th>Total</th>
                <th>Diskon</th>
                <th>Total PPN</th>
                <th>Grand Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->code }}</td>
                    <td>{{ date('Y-m-d', strtotime($data->date_time)) }}</td>
                    <td>{{ $data->branch->name }}</td>
                    <td>{{ $data->customer->name }}</td>
                    <td>{{ $data->payment_method->name ?? '-' }}</td>
                    <td>{{ number_format($data->total, 0, ',', '.') }}</td>
                    <td>{{ number_format($data->discount, 0, ',', '.') }}</td>
                    <td>{{ number_format($data->total_ppn, 0, ',', '.') }}</td>
                    <td>{{ number_format($data->grand_total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="9" class="text-right">
                    Total Pemasukan:
                </th>
                <th>
                    {{ number_format($results->sum('grand_total'), 0, ',', '.') }}
                </th>
            </tr>
        </tfoot>
    </table>
</x-card-container>
