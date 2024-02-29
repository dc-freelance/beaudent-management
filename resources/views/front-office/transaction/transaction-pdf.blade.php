<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Rekap</title>
</head>
<body>
    <div style="width:360px;">
        =======================================                                                                                                                         <br>
        Transaksi                                                                                                                                                       <br>
        Cabang : {{ $detailTransaction->branch->name }}                                                                                                                 <br>
        Nama Kasir : {{ $detailTransaction->cashier->name }}                                                                                                            <br>
        Waktu Transaksi : {{ $dateTransaction }}                                                                                                                        <br>
        =======================================                                                                                                                         <br>
        <p>Ringkasan Transaksi</p>
        Total Biaya Pelayanan : <span style="float: right; clear: both;">{{ "Rp. ".number_format($detailExaminationTreatment->sum('sub_total'), 0, ',', '.') }} </span>              <br>
        Total Biaya Obat dan BMHP : <span style="float: right; clear: both;"> {{ "Rp. ".number_format($detailExaminationItem->sum('sub_total'), 0, ',', '.') }} </span>              <br>
        Total Biaya Layanan Tambahan : <span style="float: right; clear: both;"> {{ "Rp. ".number_format($detailAddonTransaction->sum('addon.price'), 0, ',', '.') }} </span>        <br>
        <p></p>
        Total : <span style="float: right; clear: both;"> {{ "Rp. ".number_format($detailTransaction->total, 0, ',', '.') }} </span>                                                 <br>
        Diskon : <span style="float: right; clear: both;"> {{ "Rp. ".number_format($detailTransaction->discount, 0, ',', '.') }} </span>                                             <br>
        PPN (10%) : <span style="float: right; clear: both;"> {{ "Rp. ".number_format($detailTransaction->total_ppn, 0, ',', '.') }} </span>                                         <br>
        Grand Total : <span style="float: right; clear: both;"> {{ "Rp. ".number_format($detailTransaction->grand_total, 0, ',', '.') }} </span>                                     <br>
        =======================================                                                                                                                         <br>
        Dicetak Pada : {{ now() }}                                                                                                                                      <br>
        =======================================                                                                                                                         <br>
    </div>
</body>
</html>