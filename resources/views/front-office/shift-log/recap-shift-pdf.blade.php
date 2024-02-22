<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Rekap</title>
</head>
<body>
    <div>
        ===========================                                                             <br>
        Rekap Shift                                                                             <br>
        Cabang : {{ $pdf->branch->name }}                                                       <br>
        ===========================                                                             <br>
        <p>Ringkasan Pemasukan</p>
        Tunai : Rp. {{ number_format($cash, 0, ',', '.') }}                                     <br>
        Transfer : Rp. {{ number_format($transfer, 0, ',', '.') }}                              <br>
        Kartu : Rp. {{ number_format($card, 0, ',', '.') }}                                     <br>
        <p></p>
        Total Pemasukan : Rp. {{ number_format($cash + $transfer + $card, 0, ',', '.') }}       <br>
        ===========================                                                             <br>
        Dicetak Pada : {{ now() }}                                                              <br>
        ===========================                                                             <br>
    </div>
</body>
</html>