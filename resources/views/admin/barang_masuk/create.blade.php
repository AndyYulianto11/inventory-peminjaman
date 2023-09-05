@extends('admin.layout.main')

@section('title', 'Dashboard - Administrator')

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

                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input name="nama_barang" class="form-control" placeholder="Nama Barang" value="">
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Jenis</label>
                                    <select name="id_kategori" class="form-control">
                                        <option value="">--Pilih Jenis--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <select name="id_kategori" class="form-control">
                                        <option value="">--Pilih Satuan--</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Stok</label>
                            <input name="stok" class="form-control" placeholder="Stok" value="">
                        </div>

                        <div class="form-group">
                            <label>Barcode</label><br>
                            <img src="{{ asset('adminlte/dist/img/qrcode.png') }}" id="gambar_load" width="200px">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm btn-flat">Simpan</button>
                            <a href="#" class="btn btn-success btn-sm btn-flat">Kembali</a>
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

@endsection