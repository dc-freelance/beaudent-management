<x-card-container>
    <table id="examinationHistoryTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pasien</th>
                <th>Dokter</th>
                <th>Cabang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->created_at->format('d F Y') }}</td>
                    <td>{{ $data->customer->name }}</td>
                    <td>{{ $data->doctor->name }}</td>
                    <td>{{ $data->reservation->branch->name }}</td>
                    <td>
                        <a href="{{ route('admin.examination-history.show', $data->id) }}"
                            class="text-white bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-600 font-medium rounded-md text-sm p-2 text-center inline-flex items-center px-3 hover:bg-blue-600 transition duration-300 ease-in-out">
                            Lihat
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-card-container>
