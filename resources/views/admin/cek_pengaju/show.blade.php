@extends('admin.layout.main')

@section('title', 'Detail Pengajuan - Administrator')

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
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <div class="card-body">
                        <table>
                            <tr>
                                <td width="200">Kode Pengajuan</td>
                                <td width="50">:</td>
                                <td>{{ $datapengaju->code_pengajuan }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Pengajuan</td>
                                <td>:</td>
                                <td>{{ date('d-m-Y', strtotime($datapengaju->tgl_pengajuan)) }}</td>
                            </tr>
                            <tr>
                                <td>Nama Pengaju</td>
                                <td>:</td>
                                <td>{{ $datapengaju->user->name }}</td>
                            </tr>
                            <tr>
                                <td>Unit</td>
                                <td>:</td>
                                <td>{{ $datapengaju->user->unit->nama_unit }}</td>
                            </tr>
                            <tr>
                                <td>Status Admin</td>
                                <td>:</td>
                                <td>
                                    @if($datapengaju->status_setujuadmin == 0)
                                        <span class="badge bg-dark">Draf</span>
                                    @elseif($datapengaju->status_setujuadmin == 1)
                                        <span class="badge bg-info">Diajukan</span>
                                    @elseif($datapengaju->status_setujuadmin == 2)
                                        <span class="badge bg-secondary">Diproses</span>
                                    @elseif($datapengaju->status_setujuadmin == 3)
                                        <span class="badge bg-success">Disetujui</span>
                                    @elseif($datapengaju->status_setujuadmin == 4)
                                        <span class="badge bg-danger">Ditolak</span>
                                    @elseif($datapengaju->status_setujuadmin == 5)
                                        <span class="badge bg-warning">Direvisi</span>
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
                                <th class="text-center">Nama Barang</th>
                                <th class="text-center">Jumlah <br>Peminjaman</th>
                                <th class="text-center">Stok</th>
                                <th class="text-center">Selisih</th>
                                <th class="text-center">Satuan</th>
                                <th class="text-center">Status Atasan</th>
                                <th class="text-center">Status Admin</th>
                                <th class="text-center">Keterangan</th>
                            </tr>
                            @php $no = 1 @endphp
                            @forelse ($itemDatapengaju as $item)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td>{{ $item->barang->nama_barang }}</td>
                                <td class="text-center">{{ $item->qty }}</td>
                                <td class="text-center">{{ $item->barang->stok }}</td>
                                @if ($item->barang->stok > $item->qty)
                                <td class="text-center">
                                    0
                                </td>
                                @elseif ($item->barang->stok < $item->qty)
                                    <td class="text-center">
                                        {{ $item->qty - $item->barang->stok }}
                                    </td>
                                    @endif
                                    <td class="text-center">{{ $item->barang->satuan->satuan }}</td>
                                    <td class="text-center">
                                        @if($datapengaju->status_setujuatasan == 0)
                                            <span class="badge bg-dark">Draf</span>
                                        @elseif($datapengaju->status_setujuatasan == 1)
                                            <span class="badge bg-info">Diajukan</span>
                                        @elseif($datapengaju->status_setujuatasan == 2)
                                            <span class="badge bg-secondary">Diproses</span>
                                        @elseif($datapengaju->status_setujuatasan == 3)
                                            <span class="badge bg-success">Disetujui</span>
                                        @elseif($datapengaju->status_setujuatasan == 4)
                                            <span class="badge bg-danger">Ditolak</span>
                                        @elseif($datapengaju->status_setujuatasan == 5)
                                            <span class="badge bg-warning">Direvisi</span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($datapengaju->status_setujuadmin == 0)
                                            <span class="badge bg-dark">Draf</span>
                                        @elseif($datapengaju->status_setujuadmin == 1)
                                            <span class="badge bg-info">Diajukan</span>
                                        @elseif($datapengaju->status_setujuadmin == 2)
                                            <span class="badge bg-secondary">Diproses</span>
                                        @elseif($datapengaju->status_setujuadmin == 3)
                                            <span class="badge bg-success">Disetujui</span>
                                        @elseif($datapengaju->status_setujuadmin == 4)
                                            <span class="badge bg-danger">Ditolak</span>
                                        @elseif($datapengaju->status_setujuadmin == 5)
                                            <span class="badge bg-warning">Direvisi</span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <textarea cols="20" rows="1" class="form-control">{{ $item->keterangan }}</textarea>
                                    </td>
                            </tr>
                            @empty
                            <tr>Kosong.</tr>
                            @endforelse
                        </table>
                        <br><br>
                        <div class="form-group">
                            <a href="/cek-pengaju" class="btn btn-success btn-sm btn-flat">Kembali</a>
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
