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
                        <li class="breadcrumb-item active">edit data barang</li>
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
                        <h3 class="card-title">Edit Data Barang</h3>

                        <div class="card-tools">
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update-databarang', $databarang->id) }}" method="POST" id="modal-form">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="">Nama Barang</label>
                                <input type="text" name="nama_barang" value="{{ $databarang->nama_barang }}" class="nama_barang form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Jenis</label>
                                <select name="jenis_id" class="form-control" id="jenis_id">
                                    <option value="" selected disabled>Pilih Jenis</option>
                                    @foreach ($jenis as $jns)
                                    <option value="{{ $jns->id }}" {{ $databarang->jenis_id == $jns->id ? 'selected' : '' }}>{{ $jns->jenisbarang }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Stok</label>
                                <input type="text" name="stok" value="{{ $databarang->stok }}" class="stok form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Satuan</label>
                                <select name="satuan_id" class="form-control" id="satuan_id">
                                    <option value="" selected disabled>Pilih Satuan</option>
                                    @foreach ($satuans as $satuan)
                                    <option value="{{ $satuan->id }}" {{ $databarang->satuan_id == $satuan->id ? 'selected' : '' }}>{{ $satuan->satuan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Harga</label>
                                <input type="text" name="harga" value="{{ $databarang->harga }}" class="harga form-control">
                            </div>

                            <button type="submit" class="btn btn-primary btn-flat add_jenisbarang">Save</button>
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