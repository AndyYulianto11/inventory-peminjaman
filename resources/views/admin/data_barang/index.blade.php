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
                        <li class="breadcrumb-item active">Dashboard v1</li>
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
                        <h3 class="card-title">Data Barang</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#add-data"><i class="fas fa-plus"></i> Add Data
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>ID Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Jenis</th>
                                    <th>Stok</th>
                                    <th>Satuan</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1 @endphp
                                @forelse ($databarang as $item)
                                <tr class="text-center">
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->jenisbarang->jenisbarang }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>{{ $item->satuan->satuan }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm btn-flat" data-toggle="modal" data-target="#"><i class="fas fa-qrcode"></i></button>
                                        <a href="{{ route('edit-databarang', $item->id) }}" class="btn btn-warning btn-sm btn-flat" ><i class="fas fa-pencil-alt"></i></a>
                                        <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data Barang belum Tersedia.
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

<!-- Modal Add Data -->
<div class="modal fade" id="add-data">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <ul id="saveform_errList"></ul>
                <form action="{{ route('store-databarang') }}" method="POST" id="modal-form">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="">Nama Barang</label>
                        <input type="text" name="nama_barang" class="nama_barang form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Jenis</label>
                        <select name="jenis_id" class="form-control" id="jenis_id">
                            <option value="" selected disabled>Pilih Jenis</option>
                            @foreach ($jenis as $jns)
                            <option value="{{ $jns->id }}">{{ $jns->jenisbarang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Stok</label>
                        <input type="text" name="stok" class="stok form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Satuan</label>
                        <select name="satuan_id" class="form-control" id="satuan_id">
                            <option value="" selected disabled>Pilih Satuan</option>
                            @foreach ($satuans as $satuan)
                            <option value="{{ $satuan->id }}">{{ $satuan->satuan }}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-flat add_jenisbarang">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection