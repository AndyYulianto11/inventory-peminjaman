@extends('admin.layout.main')

@section('title', 'Pengajuan Barang - Pengaju')

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
                                <a href="{{ route('cetak', $datapengaju->id) }}" type="button" class="btn btn-tool" target="_blank">
                                    <i class="fas fa-print"></i> Cetak
                                </a>
                            </div>
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
                            </table>
                            <br><br>
                            <table class="table table-bordered">
                                <tr>
                                    <th class="text-center" width="5">No.</th>
                                    <th class="text-center">Nama Barang</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Status Progress</th>
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