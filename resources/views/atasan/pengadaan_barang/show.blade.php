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
                            <a href="{{ route('cetak-datapengadaanbarang', $datapengadaanbarang->id) }}" type="button" class="btn btn-tool" target="_blank">
                                <i class="fas fa-print"></i> Cetak
                            </a>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <div class="card-body">
                        <form action="{{route('pengadaan-barang-store')}}" method="post">
                            <input type="hidden" name="id" value="{{$datapengadaanbarang->id}}">
                            @csrf
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
                                        @if ($datapengadaanbarang->status_setujuatasan == '0')
                                        <span class="badge bg-dark">Draft</span>
                                        @elseif ($datapengadaanbarang->status_setujuatasan == '1')
                                        <span class="badge bg-info">Diajukan</span>
                                        @elseif ($datapengadaanbarang->status_setujuatasan == '2')
                                        <span class="badge bg-success">Disetujui</span>
                                        @elseif ($datapengadaanbarang->status_setujuatasan == '3')
                                        <span class="badge bg-warning">Ditangguhkan</span>
                                        @elseif ($datapengadaanbarang->status_setujuatasan == '4')
                                        <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            <hr>
                            <div class="form-group row">
                                <label for="barang" class="col-sm-2 col-form-label">Status Pengadaan Barang</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="status" data-status="{{$datapengadaanbarang->status_setujuatasan}}" name="status_setujuatasan" @if($datapengadaanbarang->status_setujuatasan != 1) disabled @endif>
                                        <option value="{{ $datapengadaanbarang->status_setujuatasan }}" selected disabled>
                                            @if($datapengadaanbarang->status_setujuatasan == '0')
                                                Draft
                                            @elseif($datapengadaanbarang->status_setujuatasan == '1')
                                                Diajukan
                                            @elseif($datapengadaanbarang->status_setujuatasan == '2')
                                                Disetujui
                                            @elseif($datapengadaanbarang->status_setujuatasan == '3')
                                                Ditangguhkan
                                            @elseif($datapengadaanbarang->status_setujuatasan == '4')
                                                Ditolak
                                            @endif
                                        </option>
                                        <option value="2">Disetujui</option>
                                        <option value="3">Ditangguhkan</option>
                                        <option value="4">Ditolak</option>
                                    </select>
                                </div>
                            </div>
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
                                @endforelse
                                <tr>
                                        <th colspan="6" style="text-align: right;">Grand Total : </th>
                                        <td class="text-right">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                                    </tr>
                            </table>
                            <div class="form-group mt-4">
                                <textarea name="status_item" cols="30" rows="5" class="form-control" placeholder="@if($datapengadaanbarang->komentar == '') Tidak ada komentar @endif" @if($datapengadaanbarang->status_setujuatasan != 1) disabled @endif>@if($datapengadaanbarang->status_setujuatasan != 1){{ $datapengadaanbarang->komentar }}@endif</textarea>
                            </div>
                            <div class="form-group mt-5">
                                @if($datapengadaanbarang->status_setujuatasan == 1)
                                <input type="submit" id="buttonSave" disabled class="btn btn-danger btn-sm btn-flat" value="Akhiri Pengecekan Data">
                                @endif
                                <a href="/pengadaan-barang" class="btn btn-success btn-sm btn-flat">Kembali</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $("#status").on('click', function(e){
        e.preventDefault();
        var values = $(this).val();
        var button = document.getElementById("buttonSave");
        if(values != null)
        {
            button.removeAttribute("disabled");
        }
    });
</script>
@endsection
