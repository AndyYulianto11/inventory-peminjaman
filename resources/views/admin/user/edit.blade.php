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
                            <h3 class="card-title">Edit User</h3>

                            <div class="card-tools">
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.update', $user->id) }}" method="POST">
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
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" id="name" value="{{ $user->name }}"
                                        class="form-control" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="unit_id">Unit</label>
                                    <select name="unit_id" class="form-control" id="unit_id">
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}" {{ $unit->id == $user->unit_id ? 'selected' : '' }}>{{ $unit->nama_unit }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback" id="unit_id-error">
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" value="{{ $user->email }}"
                                        class="form-control" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="role">Role</label>
                                    <select name="role" class="form-control" id="role">
                                        <option value="administrator" {{ $user->role == 'administrator' ? 'selected' : '' }}>Administrator</option>
                                        <option value="admingudang" {{ $user->role == 'admingudang' ? 'selected' : '' }}>Admin Gudang</option>
                                        <option value="kepalagudang" {{ $user->role == 'kepalagudang' ? 'selected' : '' }}>Kepala Gudang</option>
                                        <option value="atasan" {{ $user->role == 'atasan' ? 'selected' : '' }}>Atasan</option>
                                        <option value="pengaju" {{ $user->role == 'pengaju' ? 'selected' : '' }}>Pengaju</option>
                                        <option value="keuangan" {{ $user->role == 'keuangan' ? 'selected' : '' }}>Keuangan</option>
                                        <option value="rektor" {{ $user->role == 'rektor' ? 'selected' : '' }}>Rektor</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <input type="text" name="password" id="password"
                                        class="form-control">
                                    <span style="color: red">*Kosongi jika tidak mengubah password.</span>
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
