<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Pengajuan Barang</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <style>
        @page {
            size: A4
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th {
            padding: 8px 8px;
            border: 1px solid #000000;
            text-align: center;
        }

        .table td {
            padding: 3px 3px;
            border: 1px solid #000000;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            width: 100%;
        }

        #customers th,
        td {}

        #customers tr:nth-child(even) {}

        #customers tr:hover {}
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
                        BUKTI PENGAJUAN BARANG <br>UNIVERSITAS BAHAUDIN MUDHARY MADURA<br>
                        <small>Jl. Raya Lenteng No. 10, Batuan, Kabupaten Sumenep, Jawa Timur 69451<br>E-Mail : <a
                                href="mailto:uniba@unibamadura.ac.id">uniba@unibamadura.ac.id</a>,&nbsp;Whatsapp : <a
                                href="#">082 181 66 1010</a> </small>
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
        <br><br>
        <table id="customers" style="width: 100%;">
            <tr>
                <th colspan="3"><u>CETAK DATA PENGAJUAN BARANG</u></th>
            </tr>
            <tr>
                <td style="width: 35%; text-align: left">Kode Pengajuan</td>
                <td style="width: 1%">:</td>
                <td style="text-align: left">{{ $datapengaju->code_pengajuan }}</td>
            </tr>
            <tr>
                <td style="width: 30%; text-align: left">Tanggal Pengajuan</td>
                <td style="width: 1%">:</td>
                <td style="text-align: left">{{ $datapengaju->tgl_pengajuan }}</td>
            </tr>
            <tr>
                <td style="width: 35%; text-align: left">Nama Pengaju</td>
                <td style="width: 1%">:</td>
                <td style="text-align: left">{{ $datapengaju->user->name }}</td>
            </tr>
        </table>

        <br>
        <table style="width: 100%;" class="table">
            <tr style="border: 1px solid #000000;">
                <th class="text-center" width="5">No.</th>
                <th class="text-center">Nama Barang</th>
                <th class="text-center">Qty</th>
                <th class="text-center">Status</th>
            </tr>
            @php $no = 1 @endphp
            @forelse ($itemDatapengaju as $item)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $item->barang->nama_barang }}</td>
                    <td class="text-center">{{ $item->qty }}</td>
                    <td class="text-center">
                        @if ($item->status == 'diajukan')
                            <span class="badge bg-warning">Diajukan</span>
                        @elseif ($item->status == 'proses')
                            <span class="badge bg-secondary">Proses</span>
                        @elseif ($item->status == 'pending')
                            <span class="badge bg-danger">Pending</span>
                        @elseif ($item->status == 'sebagian sudah diserahkan')
                            <span class="badge bg-info">Sebagian Sudah Diserahkan</span>
                        @else
                            <span class="badge bg-success">Serah Terima</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>Kosong.</tr>
            @endforelse
        </table>

        <br>
        <hr style="border-bottom: 1px dotted">
        <table style="width: 100%">
            <tr>
                <td colspan="3" style="text-align: right; padding-right:70px;">Sumenep, </td>
            </tr>
            <tr>
                <td style="text-align: center;width: 50%">Pengaju</td>
                <td style="text-align: center;width: 20%"></td>
                <td style="text-align: center;width: 0%">BAU-IT UNIBA MADURA</td>
            </tr>
            <tr>
                <th style="height: 40px"></th>
                <th style="height: 40px"></th>
            </tr>
            <tr>
                <th style="text-align: center;width: 50%">{{ $datapengaju->user->name }}</th>
                <th style="text-align: center;width: 20%"></th>
                <th style="text-align: center;width: 50%">{{ Auth::user()->name }}</th>
            </tr>
        </table>
    </section>
</body>

<script>
    window.print()
</script>

</html>