<table>
    <thead>
        <tr>
            <th rowspan="2" align="center" style="width: 30px; vertical-align: center;">No</th>
            <th rowspan="2" align="center" style="width: 200px; vertical-align: center;">Nama Pasien</th>
            <th rowspan="2" align="center" style="width: 150px; vertical-align: center;">No Wa / HP</th>
            <th rowspan="2" align="center" style="width: 250px; vertical-align: center;">email</th>
            <th rowspan="2" align="center" style="width: 130px; vertical-align: center;">Total</th>
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
            <td align="center">{{$item->customer->name}}</td>
            <td align="center">{{$item->customer->phone_number}}</td>
            <td align="center">{{$item->customer->email}}</td>
            <td align="center">{{$item->total_data}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
