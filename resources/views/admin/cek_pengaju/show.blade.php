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
                                            <span class="badge bg-dark">Draft</span>
                                        @elseif($datapengaju->status_setujuadmin == 1)
                                            <span class="badge bg-info">Diajukan</span>
                                        @elseif($datapengaju->status_setujuadmin == 2)
                                        <span class="badge bg-danger">Belum Serah Terima</span>
                                        @elseif($datapengaju->status_setujuadmin == 3)
                                        <span class="badge bg-success">Serah Terima</span>
                                        @elseif($datapengaju->status_setujuadmin == 4)
                                            <span class="badge bg-warning">Sebagian Serah Terima</span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            </table>

                            <hr>

                            <div class="form-group row">
                                <label for="status_setujuadmin" class="col-sm-2 col-form-label">Status Pengajuan</label>
                                <div class="col-sm-10">
                                    <select name="status_setujuadmin" id="status_setujuadmin" class="form-control" readonly>
                                        <option value="{{ $datapengaju->status_setujuadmin }}">
                                            @if($datapengaju->status_setujuadmin == '0')
                                                Draft
                                            @elseif($datapengaju->status_setujuadmin == '1')
                                                Diajukan
                                            @elseif($datapengaju->status_setujuadmin == '2')
                                                Belum Serah Terima
                                            @elseif($datapengaju->status_setujuadmin == '3')
                                                Serah Terima
                                            @elseif($datapengaju->status_setujuadmin == '4')
                                                Sebagian Serah Terima
                                            @endif
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <br>

                            <table class="table table-bordered">
                                <tr>
                                    <th class="text-center" width="5">No.</th>
                                    <th class="text-center">Nama Barang</th>
                                    <th class="text-center">Jumlah <br>Peminjaman</th>
                                    <th class="text-center">Stok</th>
                                    <th class="text-center">Selisih</th>
                                    <th class="text-center">Satuan</th>
                                    <th class="text-center">Status Admin</th>
                                    @if($itemDatapengaju[0]->status_persetujuanadmin != '1')
                                    <th class="text-center">Keterangan</th>
                                    @endif
                                </tr>
                                @php $no = 1 @endphp
                                @forelse ($itemDatapengaju as $item)
                                    <tr>
                                        <input type="hidden" class="form-control" name="datapengaju_id[]"
                                            value="{{ $item->datapengaju_id }}">
                                        <input type="hidden" class="form-control" name="barang_id[]"
                                            value="{{ $item->barang_id }}">
                                        <input type="hidden" name="qty[]" value="{{ $item->qty }}">

                                        <td class="text-center">{{ $no++ }}</td>
                                        <td>{{ $item->barang->nama_barang }}</td>
                                        <td class="text-center">{{ $item->qty }}</td>
                                        <td class="text-center">{{ $item->barang->stok }}</td>

                                        {{-- @if ($item->barang->stok > $item->qty)
                                            <td class="text-center">0</td>
                                        @elseif ($item->barang->stok < $item->qty) --}}
                                            {{-- absolute -> mengabaikan nilai positif atau negatif --}}
                                            <td class="text-center">{{ abs($item->selisih) }}</td>
                                        {{-- @endif --}}

                                        <td class="text-center">{{ $item->barang->satuan->satuan }}</td>
                                        @if($item->status_persetujuanadmin == '1')
                                        <td class="text-center">
                                            <select name="status_persetujuanadmin[]" id="status_persetujuanadmin"
                                                class="form-control">
                                                <option value="" selected disabled>--Pilih Status--</option>
                                                <option value="2"
                                                    {{ '2' == $item->status_persetujuanadmin ? 'selected' : '' }}>
                                                    Belum Serah Terima
                                                </option>
                                                <option value="3"
                                                    {{ '3' == $item->status_persetujuanadmin ? 'selected' : '' }}>
                                                    Serah Terima
                                                </option>
                                                <option value="4"
                                                    {{ '4' == $item->status_persetujuanadmin ? 'selected' : '' }}>
                                                    Sebagian Serah Terima
                                                </option>
                                            </select>
                                        </td>
                                        @else
                                        <td class="text-center">
                                            @if($item->status_persetujuanadmin == '2')
                                            <span class="badge bg-danger">Belum Serah Terima</span>
                                            @elseif($item->status_persetujuanadmin == '3')
                                            <span class="badge bg-success">Serah Terima</span>
                                            @elseif($item->status_persetujuanadmin == '4')
                                            <span class="badge bg-warning">Sebagian Serah Terima</span>
                                            @else
                                            <span class="badge bg-dark">Draft</span>
                                            @endif
                                        </td>
                                        @endif
                                        @if($item->status_persetujuanadmin != '1')
                                        <td class="text-center">
                                            @if($item->datapengaju->status_setujuadmin == '1')
                                            <textarea cols="20" rows="1" class="form-control" name="keterangan[]" id="keterangan">{{ $item->keterangan }}</textarea>
                                            @else
                                            <textarea cols="20" rows="1" class="form-control" name="keterangan[]" id="keterangan" readonly>{{ $item->keterangan }}</textarea>
                                            @endif
                                        </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>Kosong.</tr>
                                @endforelse
                            </table>
                            <br><br>
                            <div class="form-group">
                                @if($itemDatapengaju[0]->datapengaju->status_setujuadmin == '1')
                                <button type="submit" class="btn btn-danger btn-sm btn-flat">Akhiri Pengecekan Data</button>
                                @endif
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
