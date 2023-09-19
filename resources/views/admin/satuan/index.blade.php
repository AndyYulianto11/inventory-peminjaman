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
                                    <th>Satuan</th>
                                    <th>Qty</th>
                                    <th width="100px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="add_new">
                                @php $no = 1 @endphp
                                @forelse ($satuan as $item)
                                <tr id="data{{ $item->id }}">
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td class="text-center">
                                        <span class="editSpan satuan">{{ $item->satuan }}</span>
                                        <input type="text" class="editInput satuan" name="satuanedit" onclick="removenotifsatuan({{ $item->id }})" id="satuanedit" style="display:none;" value="{{ $item->satuan }}">
                                        <div class="invalid-feedback" id="satuanedit-error">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="editSpan qty">{{ $item->qty }}</span>
                                        <input type="text" class="editInput qty" name="qtyedit" onclick="removenotifqty({{ $item->id }})" id="qtyedit" style="display:none;" value="{{ $item->qty }}">
                                        <div class="invalid-feedback" id="qtyedit-error">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-warning btn-sm btn-flat  edit_inline"><i class="fas fa-pencil-alt"></i></button>
                                        <button class="btn text-primary  btnSave" style="display:none;"><i class="fa fa-check"></i></button>
                                        <button class="btn text-danger  editCancel" onclick="removecancel({{ $item->id }})" style="display:none;"><i class="fa fa-times"></i></button>
                                        <button class="btn btn-danger btn-sm btn-flat  btnDelete"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data Satuan belum Tersedia.
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
                        <label for="">Satuan</label>
                        <input type="text" name="satuan" id="satuan" class="satuan form-control">
                        <div class="invalid-feedback" id="satuan-error">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Qty</label>
                        <input type="number" name="qty" id="qty" class="qty form-control">
                        <div class="invalid-feedback" id="qty-error">
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-flat add_satuan">Save</button>
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
        $('#satuan').on('click', function() {
            $('#satuan').removeClass('is-valid is-invalid');
        });

        $('#qty').on('click', function() {
            $('#qty').removeClass('is-valid is-invalid');
        });

        // fetchsatuan();

        // function fetchsatuan() {
        //     $.ajax({
        //         type: "GET",
        //         url: "/fetch-satuans",
        //         dataType: "json",
        //         success: function(response) {
        //             // console.log(response.satuan);
        //             var no = 1;
        //             $.each(response.satuan, function(key, item) {
        //                 $('tbody').append(
        //                     `<tr id="data${item.id}">
        //                         <td class="text-center">${no++}
        //                         </td>
        //                         <td class="text-center">
        //                         <span class="editSpan satuan">${item.satuan}</span>
        //                          <input type="text" class="editInput satuan" name="satuan" style="display:none;" value="${item.satuan}">
        //                         </td>
        //                         <td class="text-center">
        //                                     <button class="btn btn-warning btn-sm btn-flat  edit_inline"><i class="fas fa-pencil-alt"></i></button>
        //                                     <button class="btn text-primary  btnSave" style="display:none;"><i class="fa fa-check"></i></button>
        //                                     <button class="btn text-danger  editCancel" style="display:none;"><i class="fa fa-times"></i></button>
        //                                     <button class="btn btn-danger btn-sm btn-flat  btnDelete"><i class="fas fa-trash"></i></button>
        //                         </td>
        //                     </tr>`
        //                 );
        //             });
        //         }
        //     });
        // }

        $(document).on('submit', '#modal-form', function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            // console.log(data);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/satuan",
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
                            location = "{{ route('satuan')}}";
                        }, 1500)
                    }
                }
            });
        });

        $(document).on('click', '.edit_satuan', function(e) {
            e.preventDefault();
            var satuan_id = $(this).val();
            // console.log(jenisbarang_id);
            $('#edit-data').modal('show');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/edit-satuan/" + satuan_id,
                success: function(response) {
                    // console.log(response);
                    if (response.status == 404) {
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-danger');
                        $('#success_message').text(response.message);
                    } else {
                        $('#edit_satuan').val(response.satuan.satuan);
                        $('#edit_satuan_id').val(response.satuan.satuan);
                    }
                }
            });

        });

        $(document).on('click', '.btnDelete', function(e) {
            e.preventDefault();
            var ID = $(this).closest("tr").attr('id');
            var url = "{{route('satuan.destroy')}}";
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
            data_id = ID.split("data");
            var inputData = $(this).closest("tr").find(".editInput").serialize();
            console.log(trObj);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var url = "{{route('satuan.update')}}";
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
                        trObj.find(".editSpan.satuan").text(response.data.satuan);
                        trObj.find(".editSpan.qty").text(response.data.qty);

                        trObj.find(".editInput.satuan").val(response.data.satuan);

                        trObj.find(".editInput").hide();
                        trObj.find(".editSpan").show();
                        trObj.find(".btnSave").hide();
                        trObj.find(".editCancel").hide();
                        trObj.find(".edit_inline").show();
                        trObj.find(".btnDelete").show();

                    }else{
                        $.each(response.data, function(field, errors) {
                            $('#' + field).addClass('is-invalid');
                            $('#' + field + '-error').text(errors[0]).wrapInner("<strong />");
                        });
                    }
                }
            });
        });

    });

    function removenotifsatuan(id) {
            $('#satuanedit').removeClass('is-valid is-invalid');
    }

    function removenotifqty(id) {
            $('#qtyedit').removeClass('is-valid is-invalid');
    }

    function removecancel(id) {
        $('#satuanedit' ).removeClass('is-valid is-invalid');
        $('#qtyedit' ).removeClass('is-valid is-invalid');
    }
</script>

@endsection