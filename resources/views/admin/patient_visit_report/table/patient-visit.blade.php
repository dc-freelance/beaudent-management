<x-card-container>
    <table id="patientVisitTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>No Wa / HP</th>
                <th>Email</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $result)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $result->customer->name }}</td>
                    <td>{{ $result->customer->phone_number }}</td>
                    <td>{{ $result->customer->email }}</td>
                    <td>{{ $result->total_data }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-card-container>
