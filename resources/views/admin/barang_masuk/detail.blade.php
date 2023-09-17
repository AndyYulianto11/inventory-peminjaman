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
                            <table>
                                <tr>
                                    <td width="200">Kode Nota</td>
                                    <td width="50">:</td>
                                    <td>{{ $barangmasuk->kode_nota }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Pembelian</td>
                                    <td>:</td>
                                    <td>{{ date('d-m-Y', strtotime($barangmasuk->tanggal_pembelian)) }}</td>
                                </tr>
                                <tr>
                                    <td>Supplier</td>
                                    <td>:</td>
                                    <td>{{ $barangmasuk->supplier->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Grand Total</td>
                                    <td>:</td>
                                    <td>Rp. {{ number_format($barangmasuk->total_bayar) }}</td>
                                </tr>
                            </table>
                            <br><br>
                            <table class="table table-bordered">
                                <tr>
                                    <th class="text-center" width="5">No.</th>
                                    <th class="text-center">Nama Barang</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Jumlah</th>
                                </tr>
                                @php $no = 1 @endphp
                                @forelse ($itemBarangmasuk as $item)
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td>{{ $item->barang->nama_barang }}</td>
                                        <td class="text-center">{{ $item->qty }}</td>
                                        <td class="text-right">Rp. {{ number_format($item->harga) }}</td>
                                        <td class="text-right">Rp. {{ number_format($item->jumlah) }}</td>
                                    </tr>
                                @empty
                                    <tr>Kosong.</tr>
                                @endforelse
                                <tr>
                                    <th colspan="4" style="text-align: right;">PPN : </th>
                                    @if ($barangmasuk->ppn_angka != NULL)
                                    <th class="text-right">Rp. {{ number_format($barangmasuk->ppn_angka) }}</th>
                                    @else
                                    <th class="text-right">{{ number_format($barangmasuk->ppn_persen) }} %</th>
                                    @endif
                                </tr>
                                <tr>
                                    <th colspan="4" style="text-align: right;">Diskon : </th>
                                    @if ($barangmasuk->diskon_angka != NULL)
                                    <th class="text-right">Rp. {{ number_format($barangmasuk->diskon_angka) }}</th>
                                    @else
                                    <th class="text-right">{{ number_format($barangmasuk->diskon_persen) }} %</th>
                                    @endif
                                </tr>
                                <tr>
                                    <th colspan="4" style="text-align: right;">Grand Total : </th>
                                    <th class="text-right">Rp. {{ number_format($barangmasuk->total_bayar) }}</th>
                                </tr>
                            </table>
                            <br><br>
                            <div class="form-group">
                                <a href="/barangmasuk" class="btn btn-success btn-sm btn-flat">Kembali</a>
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

    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



@endsection
