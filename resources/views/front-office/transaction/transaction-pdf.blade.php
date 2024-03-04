<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Rekap</title>
</head>
<body>
    {{-- <div style="width:360px;">
        =======================================                                                                                                                         <br>
        Transaksi                                                                                                                                                       <br>
        Cabang : {{ $detailTransaction->branch->name }}                                                                                                                 <br>
        Nama Kasir : {{ $detailTransaction->cashier->name }}                                                                                                            <br>
        Waktu Transaksi : {{ $dateTransaction }}                                                                                                                        <br>
        =======================================                                                                                                                         <br>
        <p>Ringkasan Transaksi</p>
        Total Biaya Pelayanan : <span style="float: right; clear: both;">{{ "Rp. ".number_format($detailExaminationTreatment->sum('sub_total'), 0, ',', '.') }} </span>              <br>
        Total Biaya Obat dan BMHP : <span style="float: right; clear: both;"> {{ "Rp. ".number_format($detailExaminationItem->sum('sub_total'), 0, ',', '.') }} </span>              <br>
        Total Biaya Layanan Tambahan : <span style="float: right; clear: both;"> {{ "Rp. ".number_format($detailAddonExamination->sum('sub_total'), 0, ',', '.') }} </span>        <br>
        <p></p>
        Total : <span style="float: right; clear: both;"> {{ "Rp. ".number_format($detailTransaction->total, 0, ',', '.') }} </span>                                                 <br>
        Diskon : <span style="float: right; clear: both;"> {{ "Rp. ".number_format($detailTransaction->discount, 0, ',', '.') }} </span>                                             <br>
        PPN (10%) : <span style="float: right; clear: both;"> {{ "Rp. ".number_format($detailTransaction->total_ppn, 0, ',', '.') }} </span>                                         <br>
        Grand Total : <span style="float: right; clear: both;"> {{ "Rp. ".number_format($detailTransaction->grand_total, 0, ',', '.') }} </span>                                     <br>
        =======================================                                                                                                                         <br>
        Dicetak Pada : {{ now() }}                                                                                                                                      <br>
        =======================================                                                                                                                         <br>
    </div> --}}

    {{-- <div style="border: 1px solid black; width: 1000px;"> --}}
    <div>
        <div style="display: flex; align-items: center;">
            <div>
                <img src="{{ public_path('assets/images/logo.png') }}" style="width: 100px; position: absolute;">
            </div>
            <div style="width: 100%; text-align: center;">
                <p>
                    <span style="font-size: 18pt;"><b>{{ $detailTransaction->branch->name }}</b></span>         <br>
                    <span>{{ $detailTransaction->branch->address }}</span>      <br>
                    <span>+{{ $detailTransaction->branch->phone_number }}</span>
                </p>
            </div>
        </div>
        <div>
            <hr style="border: 2px solid black;">
        </div>
        <div style="text-align: center;">
            <p>
                <span style="font-size: 16pt;"><b>KUITANSI</b></span>
            </p>
        </div>
        <div>
            <table style="width: 100%;">
                <tr>
                    <td colspan="3">Telah diterima pembayaran atas pasien berikut :</td>
                </tr>
                <tr>
                    <td style="width: 10%;">Nama</td>
                    <td style="width: 5%; text-align: center;">:</td>
                    <td style="width: 85%;">{{ $detailTransaction->customer->name }}</td>
                </tr>
                <tr>
                    <td style="width: 10%;">Alamat</td>
                    <td style="width: 5%; text-align: center;">:</td>
                    <td style="width: 85%;">{{ $detailTransaction->customer->address }}</td>
                </tr>
                <tr>
                    <td style="width: 10%;">Usia</td>
                    <td style="width: 5%; text-align: center;">:</td>
                    <td style="width: 85%;">
                        {{-- {{ \Carbon\Carbon::parse($detailTransaction->customer->date_of_birth)->locale('id')->isoFormat('LL') }} -  --}}
                        {{ \Carbon\Carbon::now()->diffInYears($detailTransaction->customer->date_of_birth) }} Tahun 
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%;">No. Hp</td>
                    <td style="width: 5%; text-align: center;">:</td>
                    <td style="width: 85%;">{{ $detailTransaction->customer->phone_number }}</td>
                </tr>
            </table>
        </div>
        <div style="margin-top: 5px;">
            <table style="width: 100%; border: 1px solid black; border-collapse: collapse;">
                <tr style="background-color: lightgray;">
                    <td style="border: 1px solid black; padding: 5px;"><b><center>No</center></b></td>
                    <td style="border: 1px solid black; padding: 5px;"><b><center>Nama Treatment / Obat / Layanan Tambahan</center></b></td>
                    <td style="border: 1px solid black; padding: 5px;"><b><center>Qty</center></b></td>
                    <td style="border: 1px solid black; padding: 5px;"><b><center>Harga</center></b></td>
                    <td style="border: 1px solid black; padding: 5px;"><b><center>Sub Total</center></b></td>
                </tr>
                @php
                    $no = 0;
                @endphp
                @foreach ($detailExaminationTreatment as $item)
                <tr>
                    <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $no += 1 }}</td>
                    <td style="border: 1px solid black; padding: 5px;">{{ $item->treatment->name }}</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $item->qty }}</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: right;">{{ "Rp. ".number_format( $item->treatment->price, 0, ',', '.') }}</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: right;">{{ "Rp. ".number_format( $item->sub_total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
                @foreach ($detailExaminationItem as $item)
                <tr>
                    <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $no += 1 }}</td>
                    <td style="border: 1px solid black; padding: 5px;">{{ $item->item->name }}</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $item->qty }}</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: right;">{{ "Rp. ".number_format( $item->item ? $item->item->price : 0, 0, ',', '.') }}</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: right;">{{ "Rp. ".number_format( $item->sub_total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
                @foreach ($detailAddonExamination as $item)
                <tr>
                    <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $no += 1 }}</td>
                    <td style="border: 1px solid black; padding: 5px;">{{ $item->addon->name }}</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $item->qty }}</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: right;">{{ "Rp. ".number_format( $item->addon ? $item->addon->price : 0, 0, ',', '.') }}</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: right;">{{ "Rp. ".number_format( $item->sub_total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
                <tr>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;" colspan="2"><b>Total</b></td>
                    <td style="border: 1px solid black; padding: 5px; text-align: right;" colspan="3"><b>{{ "Rp. ".number_format( $detailTransaction->total, 0, ',', '.') }}</b></td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;" colspan="2"><b>Diskon</b></td>
                    <td style="border: 1px solid black; padding: 5px; text-align: right;" colspan="3"><b>{{ "Rp. ".number_format( $detailTransaction->discount, 0, ',', '.') }}</b></td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;" colspan="2"><b>PPN</b></td>
                    <td style="border: 1px solid black; padding: 5px; text-align: right;" colspan="3"><b>{{ "Rp. ".number_format( $detailTransaction->total_ppn, 0, ',', '.') }}</b></td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;" colspan="2"><b>Grand Total</b></td>
                    <td style="border: 1px solid black; padding: 5px; text-align: right;" colspan="3"><b>{{ "Rp. ".number_format( $detailTransaction->grand_total, 0, ',', '.') }}</b></td>
                </tr>
            </table>
        </div>
        <div>
            <p>
                <span> - DP yang telah dibayarkan tidak dapat dipindah kuasakan/ dialihkan untuk orang lain</span> <br>
                <span> - Segala bentuk pembayaran tidak dapat dikembalikan dalam keadaan apapun.</span>
            </p>
        </div>
        <div style="text-align: right;">
            <span> {{ $detailTransaction->branch->name }}, {{ \Carbon\Carbon::parse($detailTransaction->updated_at)->locale('id')->isoFormat('LL') }} </span> <br>
            <img src="{{ public_path('assets/images/logo.png') }}" style="width: 100px;"> <br>
            <span> {{ $detailTransaction->cashier->name }} </span>
        </div>
    </div>
</body>
</html>