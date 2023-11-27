@extends('admin.layout.main')

@section('title', 'Detail Data Pengadaan Barang - Administrator')

@section('css')

@endsection

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{ $data['submenu'] }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ $data['subjudul'] }}</h3>

                        <div class="card-tools">
                            <a href="{{ route('cetak-dataasetunit', $datapengadaanbarang->id) }}" type="button" class="btn btn-tool" target="_blank">
                                <i class="fas fa-print"></i> Cetak
                            </a>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <div class="card-body">
                        <table>
                            <tr>
                                <td width="200">Kode Transaksi</td>
                                <td width="50">:</td>
                                <td>{{ $datapengadaanbarang->kode_transaksi }}</td>
                            </tr>
                            <tr>
                                <td>Nama Transaksi</td>
                                <td>:</td>
                                <td>{{ $datapengadaanbarang->nama_transaksi }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td>{{ date('d-m-Y', strtotime($datapengadaanbarang->tgl_transaksi)) }}</td>
                            </tr>
                            <tr>
                                <td>Admin</td>
                                <td>:</td>
                                <td>{{ $datapengadaanbarang->user->name }}</td>
                            </tr>
                            <tr>
                                <td>Unit</td>
                                <td>:</td>
                                <td>{{ $datapengadaanbarang->user->unit->nama_unit }}</td>
                            </tr>
                            <tr>
                                <td>Status Transaksi</td>
                                <td>:</td>
                                <td>
                                    @if ($datapengadaanbarang->status_transaksi == '0')
                                    <span class="badge bg-primary">Diajukan</span>
                                    @elseif ($datapengadaanbarang->status_transaksi == '1')
                                    <span class="badge bg-warning">Draft</span>
                                    @elseif ($datapengadaanbarang->status_transaksi == '2')
                                    <span class="badge bg-success">Disetujui</span>
                                    @elseif ($datapengadaanbarang->status_transaksi == '3')
                                    <span class="badge bg-danger">Direvisi</span>
                                    @elseif ($datapengadaanbarang->status_transaksi == '4')
                                    <span class="badge bg-danger">Ditolak</span>
                                    @elseif ($datapengadaanbarang->status_transaksi == '5')
                                    <span class="badge bg-secondary">Dipending</span>
                                    @else
                                    -
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <br><br>

                        <table class="table table-bordered">
                            <tr>
                                <th class="text-center" width="5">No.</th>
                                <th class="text-center">Kode Barang</th>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-center">Qty</th>
                                <th class="text-center">Satuan</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Jumlah</th>
                            </tr>
                            @php $no = 1 @endphp
                            @php
                                $grandTotal = 0; // Inisialisasi grand total
                            @endphp
                            @forelse ($itemDatapengadaanbarang as $item)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td>{{ $item->barang->code_barang }}</td>
                                <td>{{ $item->barang->nama_barang }}</td>
                                <td class="text-center">{{ $item->qty }}</td>
                                <td class="text-center">{{ $item->barang->satuan->satuan }}</td>
                                <td class="text-center">Rp {{ number_format($item->barang->harga, 0, ',', '.') }}</td>
                                <td class="text-center">Rp {{ number_format($item->qty * $item->barang->harga, 0, ',', '.') }}</td>
                            </tr>
                            <!-- Hitung grand total -->
                            @php
                                $grandTotal += $item->qty * $item->barang->harga;
                            @endphp
                            @empty
                            <tr>Kosong.</tr>
                            @endforelse
                            <tr>
                                    <th colspan="6" style="text-align: right;">Grand Total : </th>
                                    <td class="text-right">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                                </tr>
                        </table>
                        <br><br>
                        <div class="form-group">
                            <a href="/cek-datapengadaanbarang" class="btn btn-success btn-sm btn-flat">Kembali</a>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@section('js')

@endsection