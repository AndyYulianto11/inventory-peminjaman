@extends('admin.layout.main')

@section('title', 'Unit - Administrator')

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
                            <h3 class="card-title">Edit Unit</h3>

                            <div class="card-tools">
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <div class="card-body">
                            <form action="{{ route('unit.update', $units->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Ups!</strong> Kesalahan saat input data!
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="form-group mb-3">
                                    <label for="kode_unit">Kode Unit</label>
                                    <input type="text" name="kode_unit" id="kode_unit" value="{{ $units->kode_unit }}"
                                        class="form-control" required>
                                    <span style="color: red">*Maksimal 3 karakter.</span>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="nama_unit">Nama Unit</label>
                                    <input type="text" name="nama_unit" id="nama_unit" value="{{ $units->nama_unit }}"
                                        class="form-control" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="lokasi_unit">Lokasi Unit</label>
                                    <input type="text" name="lokasi_unit" id="lokasi_unit" value="{{ $units->lokasi_unit }}"
                                        class="form-control" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="status_unit">Status Unit</label>
                                    <select name="status_unit" class="form-control" id="status_unit" required>
                                        <option value="1" {{ $units->status_unit == 1 ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="0" {{ $units->status_unit == 0 ? 'selected' : '' }}>Tidak Aktif
                                        </option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary btn-flat">Save</button>
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
