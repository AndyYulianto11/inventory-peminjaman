@extends('admin.layout.main')

@section('title', 'Detail Pengajuan - Atasan')

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
                            <li class="breadcrumb-item active">{{ $judul['submenu'] }}</li>
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
                            <h3 class="card-title">{{ $judul['subjudul'] }}</h3>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('update-data-pengaju', $datapengaju->id) }}" method="POST">
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
                                    <tr>
                                        <td>Unit</td>
                                        <td>:</td>
                                        <td>{{ $datapengaju->user->unit->nama_unit }}</td>
                                    </tr>
                                </table>
                                <br><br>

                                <table class="table table-bordered">
                                    <tr>
                                        <th class="text-center" width="5">No.</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Satuan</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Status Progress</th>
                                        <th class="text-center">Aksi</th>
                                        <th class="text-center">Keterangan</th>
                                    </tr>
                                    @php $no = 1 @endphp
                                    @forelse ($itemDatapengaju as $item)
                                        <tr>
                                            <input type="hidden" class="form-control" name="datapengaju_id[]"
                                                value="{{ $item->datapengaju_id }}">

                                            <td class="text-center">{{ $no++ }}</td>
                                            <td>{{ $item->barang->nama_barang }}</td>
                                            <td class="text-center">{{ $item->qty }}</td>
                                            <td class="text-center">{{ $item->barang->satuan->satuan }}</td>
                                            <td class="text-center">
                                                @if ($item->status_persetujuanatasan == '0')
                                                    <span class="badge bg-info">Diajukan</span>
                                                @elseif ($item->status_persetujuanatasan == '1')
                                                    <span class="badge bg-success">Disetujui</span>
                                                @elseif ($item->status_persetujuanatasan == '2')
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @elseif ($item->status_persetujuanatasan == '3')
                                                    <span class="badge bg-warning">Direvisi</span>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($item->status_persetujuanadmin == 0)
                                                    <span class="badge bg-warning">Diajukan</span>
                                                @elseif($item->status_persetujuanadmin == 1)
                                                    <span class="badge bg-secondary">Proses</span>
                                                @elseif($item->status_persetujuanadmin == 2)
                                                    <span class="badge bg-danger">Pending</span>
                                                @elseif($item->status_persetujuanadmin == 3)
                                                    <span class="badge bg-info">Sebagian Sudah Diserahkan</span>
                                                @elseif($item->status_persetujuanadmin == 4)
                                                    <span class="badge bg-success">Serah Terima</span>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <select name="status_persetujuanatasan[]" id="status_persetujuanatasan"
                                                    class="form-control">
                                                    <option>--Status Persetujuan--</option>
                                                    <option value="1">Disetujui</option>
                                                    <option value="2">Ditolak</option>
                                                    <option value="3">Direvisi</option>
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                <textarea name="keterangan[]" id="keterangan" cols="20" rows="3" class="form-control">{{ $item->keterangan }}</textarea>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>Kosong.</tr>
                                    @endforelse
                                </table>
                                <br><br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger btn-sm btn-flat">Akhiri Pengecekan
                                        Data</button>
                                    <a href="/cekdatapengaju" class="btn btn-success btn-sm btn-flat">Kembali</a>
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
