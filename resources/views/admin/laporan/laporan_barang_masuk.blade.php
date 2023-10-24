@extends('admin.layout.main')

@section('title', 'Barang Masuk - Administrator')

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
                <div id="success_message"></div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ $data['subjudul'] }}</h3>

                        <div class="card-tools">
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Tanggal Awal</label>
                                    <input type="date" name="tglawal" id="tglawal" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Akhir</label>
                                    <div class="col-10 input-group">
                                        <input type="date" name="tglakhir" id="tglakhir" class="form-control">
                                        <span class="input-group-append">
                                            <!-- <button onclick="ViewTabelLaporan()" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#cari-produk">
                                                <i class="fas fa-file-alt"></i> View Laporan
                                            </button> -->
                                            <a href="" onclick="this.href='/cetak-laporan-barang-masuk/'+ document.getElementById('tglawal').value + '/' + document.getElementById('tglakhir').value" target="_blank" class="btn btn-primary btn-flat">
                                                <i class="fas fa-file-alt"></i> View Laporan
                                            </a>
                                            <button onclick="PrintLaporan()" class="btn btn-success btn-flat">
                                                <i class="fas fa-print"></i> Print Laporan
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <hr>
                            <div class="Tabel">

                            </div>
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

    function ViewTabelLaporan() {
        let tglawal = $('#tglawal').val();
        let tglakhir = $('#tglakhir').val();
        if (tglawal == "") {
            Swal.fire('Tanggal Awal Belum Dipilih!')
        } else if(tglakhir == "") {
            Swal.fire('Tanggal Akhir Belum Dipilih!')
        } else {
            $.ajax({
                type: "POST",
                url: "/cetak-laporan-barang-masuk",
                data : {
                    tglawal: tglawal,
                    tglakhir: tglakhir,
                },
                dataType: "JSON",
                success : function(response) {
                    if (response.data) {
                        $('.Tabel ').html(response.data)
                    }
                }
            });
        }
    }
</script>
@endsection