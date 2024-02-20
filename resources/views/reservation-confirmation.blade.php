<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            padding: 24px 28px;
        }

        header {
            margin-bottom: 24px;
            font-size: 24px;
        }

        table {
            widows: 100%;
        }

        td {
            min-width: max-content;
        }

        label,
        th {
            font-weight: 600;
            font-size: 12px;
            text-align: left
        }

        p,
        td {
            padding-right: 32px;
            padding-bottom: 12px;
            line-height: 24px;
            font-size: 14px;
            color: black
        }

        .desc,
        footer {
            text-align: justify;
            max-width: 550px;
            margin-top: 24px;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>Konfirmasi Reservasi</header>
        <div class="content">
            <table>
                <tr>
                    <th>Nomor Identitas</th>
                    <th>Nama</th>
                </tr>
                <tr>
                    <td>{{ $data['identity_number'] }}</td>
                    <td>{{ $data['customer'] }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <th>Nomor Telepon</th>
                </tr>
                <tr>
                    <td>{{ $data['email'] }}</td>
                    <td>{{ $data['phone'] }}</td>
                </tr>
                <tr>
                    <th colspan="2">Alamat</th>
                </tr>
                <tr>
                    <td>{{ $data['address'] }}</td>
                </tr>
            </table>
            <div class="desc">
                <p>
                    Pelanggan yang terhormat,
                    <br>
                    kami telah mengkonfirmasi reservasi anda di Beaudent cabang
                    <b>{{ $data['branch'] }}</b>
                    untuk kunjungan pada tanggal <b>{{ $data['date'] }} {{ $data['time'] }}</b> WIB dengan layanan
                    <b>{{ $data['service'] }}</b>.
                </p>
                <br>
                <p>
                    Jika terdapat kesalahan data reservasi atau perubahan waktu kunjungan harap menghubungi layanan
                    pelanggan
                    Beaudent melalui kontak tertera dibawah ini
                </p>
            </div>
        </div>
        <footer>
            <label>Beaudent {{ $data['branch'] }} </label>
            <p>{{ $data['cs'] }}</p>
        </footer>
    </div>
</body>

</html>
