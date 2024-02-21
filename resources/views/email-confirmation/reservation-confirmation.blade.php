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

        header span {
            font-weight: 800;
            font-size: 18px;
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
        .footer {
            text-align: justify;
            max-width: 550px;
            margin-top: 24px;
        }

        .as-btn {
            display: block;
            width: max-content;
            margin: 16px auto 54px;
            padding: 14px 24px;
            background: #D04848;
            text-decoration: none;
            font-weight: 500;
            font-size: 13px;
            color: rgb(255, 255, 255);
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            {{ $data['title'] }}
            <br>
            <span>#{{ $data['no'] }}</span>
        </header>
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
                    kami telah {{ $data['action'] }} reservasi anda di Beaudent cabang
                    <b>{{ $data['branch'] }}</b>
                    untuk kunjungan pada tanggal <b>{{ $data['date'] }} {{ $data['time'] }}</b> WIB dengan layanan
                    <b>{{ $data['service'] }}</b>.
                </p>
                <br>
                <p>
                    {{ $data['note'] }}
                </p>
                <br>
                {!! $data['cta'] !!}
            </div>
        </div>
        <footer>
            <label>Beaudent {{ $data['branch'] }} </label>
            <p>+62 {{ str_split($data['cs'])[0] == '0' ? substr($data['cs'], 1) : $data['cs'] }}</p>
        </footer>
    </div>
</body>

</html>
