@extends('admin.layout.main')

@section('title', 'Data Pengadaan Barang - Rektorat')

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
                        <li class="breadcrumb-item active">data pengadaan barang</li>
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
                <div id="success_message"></div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Data Pengadaan Barang</h3>
                        <!-- /.card-tools -->
                    </div>
                    <ul class="nav nav-tabs navbar-light">
                        <li class="nav-item text-dark">
                            <a href="{{ route('detail-datapengadaanbarang') }}" class="nav-link {{ request()->is('detail-datapengadaanbarang') ? 'active' : '' }}">DRAFT</a>
                        </li>
                        <li class="nav-item text-dark">
                            <a href="{{ route('detail-datapengadaanbarang-rektorat', ['status' => 'diajukan']) }}" class="nav-link {{ request()->is('detail-datapengadaanbarang-rektorat/diajukan') ? 'active' : '' }}">DIAJUKAN</a>
                        </li>
                        <li class="nav-item text-dark">
                            <a href="{{ route('detail-datapengadaanbarang-rektorat', ['status' => 'disetujui']) }}" class="nav-link {{ request()->is('detail-datapengadaanbarang-rektorat/disetujui') ? 'active' : '' }}">DISETUJUI</a>
                        </li>
                        <li class="nav-item text-dark">
                            <a href="{{ route('detail-datapengadaanbarang-rektorat', ['status' => 'ditangguhkan']) }}" class="nav-link {{ request()->is('detail-datapengadaanbarang-rektorat/ditangguhkan') ? 'active' : '' }}">DITANGGUHKAN</a>
                        </li>
                        <li class="nav-item text-dark">
                            <a href="{{ route('detail-datapengadaanbarang-rektorat', ['status' => 'ditolak']) }}" class="nav-link {{ request()->is('detail-datapengadaanbarang-rektorat/ditolak') ? 'active' : '' }}">DITOLAK</a>
                        </li>
                    </ul>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="datatables" class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th width="50px">No</th>
                                    <th>Kode <br> Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Nama Transaksi</th>
                                    <th>Admin</th>
                                    <th>Status</th>
                                    <th width="100px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="add_new">
                                @php $no = 1 @endphp
                                @forelse ($datapengadaanbarang as $item)
                                <tr class="text-center">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->kode_transaksi }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->tgl_transaksi)) }}</td>
                                    <td>{{ $item->nama_transaksi }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>
                                        @if ($item->status_setujurektorat == '0')
                                        <span class="badge bg-dark">Draft</span>
                                        @elseif ($item->status_setujurektorat == '1')
                                        <span class="badge bg-info">Diajukan</span>
                                        @elseif ($item->status_setujurektorat == '2')
                                        <span class="badge bg-success">Disetujui</span>
                                        @elseif ($item->status_setujurektorat == '3')
                                        <span class="badge bg-warning">Ditangguhkan</span>
                                        @elseif ($item->status_setujurektorat == '4')
                                        <span class="badge bg-danger">Ditolak</span>
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('show-datapengadaanbarang-rektorat', $item->id) }}" class="btn btn-primary btn-sm btn-flat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data Pengadaan Barang belum Tersedia.
                                </div>
                                @endforelse
                            </tbody>
                        </table>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/pdfmake/vfs_fonts.js')}}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $("#datatables").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "paging": true,
            "ordering": true,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
</script>
@endsection
