@extends('admin.layout.main')

@section('title', 'Edit Pengajuan - Administrator')

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
                            <form action="{{ route('update-cek-pengaju', $datapengaju->id) }}" method="POST">
                                @csrf
                                @method('PUT')

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
                                        <th class="text-center">Status</th>
                                    </tr>
                                    @php $no = 1 @endphp
                                    @forelse ($itemDatapengaju as $item)
                                        <tr>
                                            <input type="hidden" class="form-control" name="datapengaju_id[]" value="{{ $item->datapengaju_id }}">

                                            <td class="text-center">{{ $no++ }}</td>
                                            <td>{{ $item->barang->nama_barang }}</td>
                                            <td class="text-center">{{ $item->qty }}</td>
                                            <td class="text-center">
                                                <select name="status" id="status" class="form-control">
                                                    <option value="diajukan"
                                                        {{ 'diajukan' == $item->status ? 'selected' : '' }}>Diajukan
                                                    </option>
                                                    <option value="proses"
                                                        {{ 'proses' == $item->status ? 'selected' : '' }}>Proses</option>
                                                    <option value="pending"
                                                        {{ 'pending' == $item->status ? 'selected' : '' }}>Pending</option>
                                                    <option value="sebagian sudah diserahkan"
                                                        {{ 'sebagian sudah diserahkan' == $item->status ? 'selected' : '' }}>
                                                        Sebagian Sudah Diserahkan
                                                    </option>
                                                    <option value="serah terima"
                                                        {{ 'serah terima' == $item->status ? 'selected' : '' }}>Serah
                                                        Terima</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>Kosong.</tr>
                                    @endforelse
                                </table>
                                <br><br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm btn-flat">Update</button>
                                    <a href="/cek-pengaju" class="btn btn-success btn-sm btn-flat">Kembali</a>
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
@endsection

@section('js')

@endsection
