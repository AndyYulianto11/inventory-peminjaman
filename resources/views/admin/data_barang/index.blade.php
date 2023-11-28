@extends('admin.layout.main')

@section('title', 'Dashboard - Administrator')

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
                                <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#add-data"><i
                                        class="fas fa-plus"></i> Add Data
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datatables" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th width="150px">Barcode</th>
                                        <th>Nama Barang</th>
                                        <th>Jenis</th>
                                        <th>Stok</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th width="150px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1 @endphp
                                    @forelse ($databarang as $item)
                                        <tr id="data{{ $item->id }}" class="{{ $item->stok <= 0 ? 'bg-danger' : '' }}">
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td>{!! DNS1D::getBarcodeHTML("$item->code_barang", 'CODABAR') !!}</td>
                                            <td>{{ $item->nama_barang }}</td>
                                            <td>{{ $item->jenisbarang->jenisbarang }}</td>
                                            <td>{{ $item->stok }}</td>
                                            <td>{{ $item->satuan->satuan }}</td>
                                            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-primary btn-sm btn-flat"
                                                    onclick="detail({{ $item->id }})" data-toggle="modal"
                                                    data-target="#barcode"><i class="fas fa-eye"></i></button>
                                                <a href="{{ route('edit-databarang', $item->id) }}"
                                                    class="btn btn-warning btn-sm btn-flat  edit_inline"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                                <button class="btn btn-danger btn-sm btn-flat  btnDelete"><i
                                                        class="fas fa-trash"></i></button>

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

    <!-- Modal Barcode -->
    <div class="modal fade" id="barcode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="details">

                    </div>
                </div>
                <tr>
                </tr>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
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

                        <div class="form-group mb-3">
                            <label for="">Harga</label>
                            <input type="text" name="harga" class="harga form-control">
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

        function detail(id) {
            console.log(id);
            $.ajax({
                type: "GET",
                url: "{{ route('shows-databarang') }}",
                data: {
                    id: id,
                },
                dataType: "JSON",
                success: function(response) {
                    html = `<table class="table table-bordered">
                        <tr>
                            <th class="text-center">Nama Barang</th>
                            <th class="text-center">Stok</th>
                            <th class="text-center">Jenis Barang</th>
                            <th class="text-center">Satuan</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Barcode</th>
                        </tr>
                        <tr>
                            <td class="text-center">${response.data.nama_barang}</td>
                            <td class="text-center">${response.data.stok}</td>
                            <td class="text-center">${response.data.jenisbarang}</td>
                            <td class="text-center">${response.data.satuan}</td>
                            <td class="text-center">Rp ${response.data.harga.toLocaleString('id-ID')}</td>
                            <td class="text-center">${response.data.code_barang}</td>
                        </tr>
                        </table>`;
                    $('.details').html(html);
                }
            });
        }

        $(document).ready(function() {
            $("#datatables").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "paging": true,
                "ordering": true,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

        $(document).on('click', '.btnDelete', function(e) {
            e.preventDefault();
            var ID = $(this).closest("tr").attr('id');
            var url = "{{ route('databarang.destroy') }}";
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
            });
            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "Do you want to delete ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: "POST",
                            data: {
                                ids: ID,
                            },
                            success: function(response) {
                                var datas = $('#data' + response.data);
                                console.log(datas);
                                datas.remove();

                            }
                        });
                    }
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swal.fire(
                        'Cancelled',
                        'Data is not deleted',
                        'error'
                    )
                }
            });
        });
    </script>

@endsection
