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

                                <hr>

                                <div class="form-group row">
                                    <label for="status_setujuadmin" class="col-sm-2 col-form-label">Update Status</label>
                                    <div class="col-sm-10">
                                        <select name="status_setujuadmin" id="status_setujuadmin" class="form-control">
                                            <option value="0"
                                                {{ '0' == $datapengaju->status_setujuadmin ? 'selected' : '' }}>Draft
                                            </option>
                                            <option value="1"
                                                {{ '1' == $datapengaju->status_setujuadmin ? 'selected' : '' }}>Diajukan
                                            </option>
                                            <option value="2"
                                                {{ '2' == $datapengaju->status_setujuadmin ? 'selected' : '' }}>Diproses
                                            </option>
                                            <option value="3"
                                                {{ '3' == $datapengaju->status_setujuadmin ? 'selected' : '' }}>Disetujui
                                            </option>
                                            <option value="4"
                                                {{ '4' == $datapengaju->status_setujuadmin ? 'selected' : '' }}>Ditolak
                                            </option>
                                            <option value="5"
                                                {{ '5' == $datapengaju->status_setujuadmin ? 'selected' : '' }}>Ditangguhkan
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
                                        <th class="text-center">Keterangan</th>
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
                                            <td class="text-center">
                                                <select name="status_persetujuanadmin[]" id="status_persetujuanadmin"
                                                    class="form-control">
                                                    <option value="" selected disabled>--Pilih Status--</option>
                                                    <option value="0"
                                                        {{ '0' == $item->status_persetujuanadmin ? 'selected' : '' }}>
                                                        Serah Terima
                                                    </option>
                                                    <option value="1"
                                                        {{ '1' == $item->status_persetujuanadmin ? 'selected' : '' }}>
                                                        Sebagian Diserahterimakan
                                                    </option>
                                                    <option value="2"
                                                        {{ '2' == $item->status_persetujuanadmin ? 'selected' : '' }}>
                                                        Tidak Ready
                                                    </option>
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                <textarea cols="20" rows="1" class="form-control" name="keterangan[]" id="keterangan">{{ $item->keterangan }}</textarea>
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
