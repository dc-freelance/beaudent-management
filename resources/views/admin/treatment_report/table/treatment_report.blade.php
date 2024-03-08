<x-card-container>
    <table id="treatmentReportTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Layanan</th>
                <th>Jumlah Transaksi</th>
                <th>Total Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->treatment->name }}</td>
                    <td>{{ $data->total_qty }}</td>
                    <td>{{ number_format($data->total_sub_total) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-card-container>
