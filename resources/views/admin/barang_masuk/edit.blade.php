@extends('admin.layout.main')

@section('title', 'Barang Masuk - Administrator')

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
                            <ul id="saveform_errList"></ul>
                            <form id="modal-form">

                                <div class="form-group row">
                                    <label for="kode_nota" class="col-sm-2 col-form-label">Kode Nota</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="kode_nota" name="kode_nota"
                                            value="{{ $barangmasuk->kode_nota }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal_pembelian" class="col-sm-2 col-form-label">Tanggal</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="tanggal_pembelian"
                                            name="tanggal_pembelian" value="{{ $barangmasuk->tanggal_pembelian }}" required>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label for="barang" class="col-sm-2 col-form-label">Barang Masuk</label>
                                    <div class="col-sm-10">
                                        <select id="barang" class="form-control select2">
                                            <option value="" selected disabled>-- Pilih Barang --</option>
                                            @foreach ($supplier as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $barangmasuk->supplier_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="5">No.</th>
                                                <th>Nama Barang</th>
                                                <th>Satuan</th>
                                                <th>Qty</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1 @endphp
                                            @forelse ($itemBarangmasuk as $masuk)
                                                <tr>
                                                    <td class="text-center">{{ $no++ }}</td>
                                                    <td class="text-center">{{ $masuk->barang->nama_barang }}</td>
                                                    <td class="text-center">{{ $masuk->barang->satuan->satuan }}</td>
                                                    <td class="text-center">{{ $masuk->qty }}</td>
                                                    <td class="text-right">Rp. {{ number_format($masuk->harga) }}</td>
                                                    <td class="text-right">Rp. {{ number_format($masuk->jumlah) }}</td>
                                                </tr>
                                            @empty
                                                <tr>Kosong.</tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered mt-3">
                                        {{-- <tr>
                                            <th colspan="2" style="text-align: right;" id="subtotal">Sub total : </th>
                                            <th colspan="2" class="text-right" id="total_jumlah"></th>
                                        </tr> --}}
                                        <tr>
                                            <th colspan="2" style="text-align: right;">PPN : </th>
                                            <th width="200">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            Rp.
                                                        </span>
                                                    </div>
                                                    @if ($barangmasuk->ppn_angka != null)
                                                        <input type="number" class="form-control" id="ppn_angka"
                                                            name="ppn_angka" value="{{ $barangmasuk->ppn_angka }}">
                                                    @else
                                                        <input type="number" class="form-control" id="ppn_angka"
                                                            name="ppn_angka" value="0">
                                                    @endif
                                                </div>
                                            </th>
                                            <th width="200">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            %
                                                        </span>
                                                    </div>
                                                    @if ($barangmasuk->ppn_persen != null)
                                                        <input type="number" class="form-control" id="ppn_persen"
                                                            name="ppn_persen" value="{{ $barangmasuk->ppn_persen }}">
                                                    @else
                                                        <input type="number" class="form-control" id="ppn_persen"
                                                            name="ppn_persen" value="0">
                                                    @endif
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" style="text-align: right;">Diskon : </th>
                                            <th width="200">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            Rp.
                                                        </span>
                                                    </div>
                                                    @if ($barangmasuk->diskon_angka != null)
                                                        <input type="number" class="form-control" id="diskon_angka"
                                                            name="diskon_angka" value="{{ $barangmasuk->diskon_angka }}">
                                                    @else
                                                        <input type="number" class="form-control" id="diskon_angka"
                                                            name="diskon_angka" value="0">
                                                    @endif
                                                </div>
                                            </th>
                                            <th width="200">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            %
                                                        </span>
                                                    </div>
                                                    @if ($barangmasuk->diskon_persen != null)
                                                        <input type="number" class="form-control" id="diskon_persen"
                                                            name="diskon_persen"
                                                            value="{{ $barangmasuk->diskon_persen }}">
                                                    @else
                                                        <input type="number" class="form-control" id="diskon_persen"
                                                            name="diskon_persen" value="0">
                                                    @endif
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" style="text-align: right;">Grand Total : </th>
                                            <th colspan="2" class="text-right">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            Rp.
                                                        </span>
                                                    </div>
                                                    <input type="number" class="form-control" id="total_bayar_input"
                                                        name="total_bayar_input" value="{{ $barangmasuk->total_bayar }}">
                                                </div>
                                            </th>
                                        </tr>
                                    </table>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm btn-flat">Update</button>
                                    <a href="/barangmasuk" class="btn btn-success btn-sm btn-flat">Kembali</a>
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

    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection
