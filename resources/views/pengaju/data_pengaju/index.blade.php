@extends('admin.layout.main')

@section('title', 'Pengajuan Barang - Pengaju')

@section('css')

@endsection

@section('content')
    @include('sweetalert::alert')
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
                                <a href="{{ route('create-datapengaju') }}" type="button" class="btn btn-tool"><i
                                        class="fas fa-plus"></i> Add Data
                                </a>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datatables" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th width="50px">No</th>
                                        <th>Kode Pengajuan</th>
                                        <th width="150px">Tanggal</th>
                                        <th>Qty</th>
                                        <th width="150px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1 @endphp
                                    @forelse ($datapengaju as $item)
                                        <tr class="text-center" id="data{{ $item->id }}">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->code_pengajuan }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item->tgl_pengajuan)) }}</td>
                                            <td>
                                                @if ($item->item_datapengaju->count() > 0)
                                                    {{ $item->item_datapengaju->count() }}
                                                @else
                                                    0
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('lihat-data-pengaju', $item->id) }}" class="btn btn-primary btn-sm btn-flat">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <!-- <a href="#" class="btn btn-warning btn-sm btn-flat  edit_inline">
                                                    <i class="fas fa-pencil-alt"></i> -->
                                                </a>
                                                {{-- <button class="btn btn-danger btn-sm btn-flat  btnDelete"><i
                                                        class="fas fa-trash"></i></button> --}}
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Pengaju belum Tersedia.
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- DataTables  & Plugins -->
    <script src="adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="adminlte/plugins/jszip/jszip.min.js"></script>
    <script src="adminlte/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="adminlte/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

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
