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
                                    <tr>
                                        <td>Status</td>
                                        <td>:</td>
                                        <td>
                                            @if ($datapengaju->status_setujuatasan == 1)
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
                                    </tr>
                                </table>

                                <hr>

                                <div class="form-group row">
                                    <label for="barang" class="col-sm-2 col-form-label">Update Status</label>
                                    <div class="col-sm-10">
                                        <select name="status_setujuatasan" id="status_setujuatasan" class="form-control">
                                            <option value="1"
                                                {{ '1' == $datapengaju->status_setujuatasan ? 'selected' : '' }}>Diajukan
                                            </option>
                                            <option value="2"
                                                {{ '2' == $datapengaju->status_setujuatasan ? 'selected' : '' }}>Diproses
                                            </option>
                                            <option value="3"
                                                {{ '3' == $datapengaju->status_setujuatasan ? 'selected' : '' }}>Disetujui
                                            </option>
                                            <option value="4"
                                                {{ '4' == $datapengaju->status_setujuatasan ? 'selected' : '' }}>Ditolak
                                            </option>
                                            <option value="5"
                                                {{ '5' == $datapengaju->status_setujuatasan ? 'selected' : '' }}>Direvisi
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <br>

                                <table class="table table-bordered">
                                    <tr>
                                        <th class="text-center" width="5">No.</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Satuan</th>
                                        <th class="text-center">Status Admin</th>
                                        <th class="text-center">Status Atasan</th>
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
                                                    <option value="1"
                                                        {{ '1' == $item->status_persetujuanatasan ? 'selected' : '' }}>
                                                        Disetujui</option>
                                                    <option value="2"
                                                        {{ '2' == $item->status_persetujuanatasan ? 'selected' : '' }}>
                                                        Ditolak</option>
                                                    <option value="3"
                                                        {{ '3' == $item->status_persetujuanatasan ? 'selected' : '' }}>
                                                        Direvisi</option>
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                <textarea name="keterangan[]" id="keterangan" cols="20" rows="1" class="form-control">{{ $item->keterangan }}</textarea>
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
