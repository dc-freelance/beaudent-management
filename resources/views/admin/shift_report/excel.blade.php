<table>
    <thead>
        <tr>
            <th rowspan="2" align="center" style="width: 30px; vertical-align: center;">No</th>
            <th rowspan="2" align="center" style="width: 180px; vertical-align: center;">Tanggal</th>
            <th rowspan="2" align="center" style="width: 180px; vertical-align: center;">Shift</th>
            <th rowspan="2" align="center" style="width: 180px; vertical-align: center;">Cabang</th>
            <th rowspan="2" align="center" style="width: 180px; vertical-align: center;">User</th>
            <th rowspan="2" align="center" style="width: 180px; vertical-align: center;">Sub Total</th>
        </tr>
        <tr>
            <th></th>
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
            <td align="center">{{$item->tanggal}}</td>
            <td align="center">{{$item->config_shift->name}}</td>
            <td align="center">{{$item->user->name}}</td>
            <td align="center">{{$item->branch->name}}</td>
            <td align="right">{{$item->sub_total}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
