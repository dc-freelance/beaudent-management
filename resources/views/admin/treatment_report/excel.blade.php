<table>
    <thead>
        <tr>
            <th rowspan="2" align="center" style="width: 30px; vertical-align: center;">No</th>
            <th rowspan="2" align="center" style="width: 200px; vertical-align: center;">Nama Layanan</th>
            <th rowspan="2" align="center" style="width: 150px; vertical-align: center;">Jumlah Transaksi</th>
            <th rowspan="2" align="center" style="width: 250px; vertical-align: center;">Total Transaksi</th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td align="center">{{$loop->iteration}}</td>
            <td align="center">{{$item['nama_layanan']}}</td>
            <td align="center">{{$item['jumlah_transaksi']}}</td>
            <td align="right">{{$item['total_transaksi']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
