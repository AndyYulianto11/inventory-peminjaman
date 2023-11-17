@extends('admin.layout.main')

@section('title', 'Dashboard - Administrator')

@section('css')

@endsection

@section('content')

<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('adminlte/dist/img/logouniba.png') }}" alt="AdminLTELogo" height="120" width="120"><br>
    <h3>UNIBA MADURA</h3>
</div>

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
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-indigo">
                        <div class="inner">
                            <h3>{{ $satuan }}</h3>

                            <p>Satuan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-basket"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-teal">
                        <div class="inner">
                            <h3>{{ $barang }}</h3>

                            <p>Barang</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-cubes"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $user }}</h3>

                            <p>User</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-pink">
                        <div class="inner">
                            <h3>{{ $jenis }}</h3>

                            <p>Jenis Barang</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-list"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Monthly Recap Report</h5>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="text-center">
                                    <strong>Report: 1 Sep, 2023 - 31 Des, 2023</strong>
                                </p>
                                <div class="chart">
                                    <canvas id="myChart" width="100" height="35px"></canvas>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card-header">
                                    <h3 class="card-title"><strong>List Barang Baru</strong></h3>

                                    <div class="card-tools">
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <ul class="products-list product-list-in-card pl-2 pr-2">
                                        <li class="item">
                                            <a href="javascript:void(0)" class="product-title">Kursi
                                                <span class="badge badge-warning float-right">28 Unit</span></a>
                                            <span class="product-description">
                                                Kelas
                                            </span>
                                        </li>
                                        <!-- /.item -->
                                        <li class="item">
                                            <a href="javascript:void(0)" class="product-title">Proyektor
                                                <span class="badge badge-info float-right">31 Pcs</span></a>
                                            <span class="product-description">
                                                Kelas
                                            </span>
                                        </li>
                                        <!-- /.item -->
                                        <li class="item">
                                            <a href="javascript:void(0)" class="product-title">Keyboard
                                                <span class="badge badge-danger float-right">26 Pcs</span></a>
                                            <span class="product-description">
                                                Kelas
                                            </span>
                                        </li>
                                        <!-- /.item -->
                                        <li class="item">
                                            <a href="javascript:void(0)" class="product-title">Kabel Proyektor
                                                <span class="badge badge-success float-right">12 Pcs</span></a>
                                            <span class="product-description">
                                                Aset Staff
                                            </span>
                                        </li>
                                        <!-- /.item -->
                                    </ul>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">
                                    <a href="javascript:void(0)" class="uppercase">View All Products</a>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- content -->
        </div>
        <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>

@endsection

@section('js')

@endsection