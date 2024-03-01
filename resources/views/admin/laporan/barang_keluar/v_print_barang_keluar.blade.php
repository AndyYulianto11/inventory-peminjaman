<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Barang Masuk</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <style>
        @page {
            size: A4
        }
    </style>
</head>

<body class="A4">
    <section class="sheet padding-10mm">
        <table style="width: 100%">
            <thead>
                <tr>
                    <th style="width: 10%">
                        <img src="{{ asset('adminlte/dist/img/logouniba.png') }}" height="70">
                    </th>
                    <th>
                        LAPORAN BARANG MASUK <br>UNIVERSITAS BAHAUDIN MUDHARY MADURA<br>
                        <small>Jl. Raya Lenteng No. 10, Batuan, Kabupaten Sumenep, Jawa Timur 69451<br>E-Mail : <a href="mailto:uniba@unibamadura.ac.id">uniba@unibamadura.ac.id</a>,&nbsp;Whatsapp : <a href="#">082 181 66 1010</a> </small>
                    </th>
                </tr>
                <tr>
                    <td colspan="2">
                        <hr>
                    </td>
                </tr>
            </thead>
        </table>

        <table style="width: 100%">
            <tr>
                <th style="width: 60%"></th>
                <th style="text-align: right">Sumenep, <?php echo date('d-m-Y'); ?></th>
            </tr>
        </table>

        <br>

        <table style="width: 100%;" border="1">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>ID Transaksi</th>
                    <th>Tanggal Pembelian</th>
                    <th>Grand Total</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1 @endphp
                @foreach ($cetaklaporan as $item)
                <tr class="text-center">
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->kode_nota }}</td>
                    <td style="text-align: center">{{ $item->tanggal_pembelian }}</td>
                    <td style="text-align: center">Rp. {{ number_format($item->total_bayar) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</body>

</html>

<script>
    window.print()
</script>