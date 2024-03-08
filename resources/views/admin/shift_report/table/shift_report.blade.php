<x-card-container>
    <table id="shiftReportTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Shift</th>
                <th>Cabang</th>
                <th>User</th>
                <th>Uang cash yang diterima</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ date('Y-m-d', strtotime($data->tanggal)) }}</td>
                    <td>{{ $data->config_shift->name }}</td>
                    <td>{{ $data->branch->name }}</td>
                    <td>{{ $data->user->name }}</td>
                    <td>{{ number_format($data->sub_total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-card-container>
