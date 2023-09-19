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
                <div id="success_message"></div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ $judul['subjudul'] }}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#add-data"><i class="fas fa-plus"></i> Add Data
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="datatables" class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th width="50px">No</th>
                                    <th>Supplier</th>
                                    <th>Alamat</th>
                                    <th>No Telepon</th>
                                    <th width="100px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="add_new">
                                @php $no = 1 @endphp
                                @forelse ($supplier as $item)
                                <tr id="data{{ $item->id }}">
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td class="text-center">
                                        <span class="editSpan nama">{{ $item->nama }}</span>
                                        <input type="text" class="editInput nama form-control" name="nama" style="display:none;" value="{{ $item->nama }}">
                                    </td>
                                    <td class="text-center">
                                        <span class="editSpan alamat">{{ $item->alamat }}</span>
                                        <input type="text" class="editInput alamat form-control" name="alamat" style="display:none;" value="{{ $item->alamat }}">
                                    </td>
                                    <td class="text-center">
                                        <span class="editSpan no_telp">{{ $item->no_telp }}</span>
                                        <input type="text" class="editInput no_telp form-control" name="no_telp" style="display:none;" value="{{ $item->no_telp }}">
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-warning btn-sm btn-flat  edit_inline"><i class="fas fa-pencil-alt"></i></button>
                                        <button class="btn text-primary  btnSave" style="display:none;"><i class="fa fa-check"></i></button>
                                        <button class="btn text-danger  editCancel" style="display:none;"><i class="fa fa-times"></i></button>
                                        <button class="btn btn-danger btn-sm btn-flat  btnDelete"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data Supplier belum Tersedia.
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
                <form id="modal-form">

                    <div class="form-group mb-3">
                        <label for="">Supplier</label>
                        <input type="text" name="nama" id="nama" class="nama form-control">
                        <div class="invalid-feedback" id="nama-error">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="alamat form-control">
                        <div class="invalid-feedback" id="alamat-error">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">No Telepon</label>
                        <input type="number" name="no_telp" id="no_telp" class="no_telp form-control">
                        <div class="invalid-feedback" id="no_telp-error">
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-flat add_supplier">Save</button>
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
    $(document).ready(function() {
        $("#datatables").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "paging": true,
            "ordering": true,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        // Menghilangkan alert error pada waktu tidak diinputkan
        $('#nama').on('click', function() {
            $('#nama').removeClass('is-valid is-invalid');
        });

        $('#alamat').on('click', function() {
            $('#alamat').removeClass('is-valid is-invalid');
        });

        $('#no_telp').on('click', function() {
            $('#no_telp').removeClass('is-valid is-invalid');
        });
    });

    $(document).on('submit', '#modal-form', function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        // console.log(data);

        $.ajax({
            type: "POST",
            url: "/supplier",
            data: data,
            dataType: "json",
            success: function(response) {
                // console.log(response);

                if (response.status == 400) {
                    // $('#saveform_errList').html("");
                    // $('#saveform_errList').addClass('alert alert-danger');
                    // $.each(response.errors, function(key, err_values) {
                    //     $('#saveform_errList').append('<li>' + err_values + '</li>');
                    // });

                    // Validation jika setiap error dibawah masing" inputan
                    $.each(response.data, function(field, errors) {
                            $('#' + field).addClass('is-invalid');
                            $('#' + field + '-error').text(errors[0]).wrapInner("<strong />");
                        });
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500

                    });
                    setTimeout(function() {
                        location = "{{ route('supplier')}}";
                    }, 1500)
                }
            }
        });
    });

    $(document).on('click', '.edit_supplier', function(e) {
        e.preventDefault();
        var supplier_id = $(this).val();
        // console.log(jenisbarang_id);
        $('#edit-data').modal('show');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/edit-supplier/" + supplier_id,
            success: function(response) {
                // console.log(response);
                if (response.status == 404) {
                    $('#success_message').html("");
                    $('#success_message').addClass('alert alert-danger');
                    $('#success_message').text(response.message);
                } else {
                    $('#edit_supplier').val(response.supplier.supplier);
                    $('#edit_supplier_id').val(response.supplier.supplier);
                }
            }
        });
    });

    $(document).on('click', '.btnDelete', function(e) {
        e.preventDefault();
        var ID = $(this).closest("tr").attr('id');
        var url = "{{route('supplier.destroy')}}";
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

    $("#add_new").on('click', '.edit_inline', function() {
        var btn = $(this);
        btn.closest("tr").find(".edit_inline").hide();
        btn.closest("tr").find(".btnDelete").hide();

        $(this).closest("tr").find(".editSpan").hide();
        $(this).closest("tr").find(".editInput").show(250);
        $(this).closest("tr").find(".editCancel").show(250);
        $(this).closest("tr").find(".edit_inline").hide();
        $(this).closest("tr").find(".btnSave").show(250);
    });

    $("#add_new").on('click', '.editCancel', function(e) {
        e.preventDefault();

        $(this).closest("tr").find(".editSpan").show();
        $(this).closest("tr").find(".editInput").hide();

        $(this).closest("tr").find(".edit_inline").show(250);
        $(this).closest("tr").find(".btnDelete").show(250);

        $(this).closest("tr").find(".editCancel").hide();

        $(this).closest("tr").find(".btnSave").hide();
    });

    $("#add_new").on("click", '.btnSave', function(e) {
        e.preventDefault();
        var trObj = $(this).closest("tr");
        var ID = $(this).closest("tr").attr('id');
        var inputData = $(this).closest("tr").find(".editInput").serialize();
        console.log(trObj);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var url = "{{route('supplier.update')}}";
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: 'action=edit&id=' + ID + '&' + inputData,
            success: function(response) {
                if (response.status == 200) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500

                    });
                    trObj.find(".editSpan.nama").text(response.data.nama);
                    trObj.find(".editSpan.alamat").text(response.data.alamat);
                    trObj.find(".editSpan.no_telp").text(response.data.no_telp);


                    trObj.find(".editInput.supplier").val(response.data.supplier);

                    trObj.find(".editInput").hide();
                    trObj.find(".editSpan").show();
                    trObj.find(".btnSave").hide();
                    trObj.find(".editCancel").hide();
                    trObj.find(".edit_inline").show();
                    trObj.find(".btnDelete").show();

                }
            }
        });
    });
</script>

@endsection