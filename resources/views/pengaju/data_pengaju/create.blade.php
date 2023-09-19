@extends('admin.layout.main')

@section('title', 'Dashboard - Pengaju')


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
                        <ul id="saveform_errList"></ul>
                        <form id="modal-form">

                            <div class="form-group row">
                                <label for="kode_nota" class="col-sm-2 col-form-label">Kode Pengajuan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="code_pengajuan" name="code_pengajuan" placeholder="Kode Pengajuan" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tgl_pengajuan" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="tgl_pengajuan" name="tgl_pengajuan" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kode_nota" class="col-sm-2 col-form-label">User</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="code_pengajuan" name="code_pengajuan" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kode_nota" class="col-sm-2 col-form-label">Unit</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="code_pengajuan" name="code_pengajuan" readonly>
                                </div>
                            </div>

                            <hr>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Satuan</th>
                                            <th>Qty</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bahan-ajax">
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-sm btn-flat">Simpan</button>
                                <a href="/datapengaju" class="btn btn-success btn-sm btn-flat">Kembali</a>
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

<script type="text/javascript">

</script>

@endsection