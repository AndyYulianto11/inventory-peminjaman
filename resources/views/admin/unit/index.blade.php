@extends('admin.layout.main')

@section('title', 'Dashboard - Administrator')

@section('css')
<style>
    .editInput {
        border: 1px solid #000;
        height: 50px;
        background-color: #eff1f4;
        text-align: center;
    }
</style>
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
                                    <th>Kode Unit</th>
                                    <th>Nama</th>
                                    <th>Lokasi</th>
                                    <th>Status</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="add_new">
                                @php $no = 1 @endphp
                                @forelse ($unit as $item)
                                <tr id="data{{ $item->id }}">
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td class="text-center">
                                        <span class="editSpan jenisbarang">{{ $item->kode_unit }}</span>
                                        <input type="text" class="editInput jenisbarang" name="jenisbarangedit" onclick="removenotif({{ $item->id }})" id="jenisbarangedit{{ $item->id }}" style="display:none;" value="{{ $item->jenisbarang }}">
                                        <div class="invalid-feedback" id="jenisbarangedit-error">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="editSpan jenisbarang">{{ $item->nama_unit }}</span>
                                        <input type="text" class="editInput jenisbarang" name="jenisbarangedit" onclick="removenotif({{ $item->id }})" id="jenisbarangedit{{ $item->id }}" style="display:none;" value="{{ $item->jenisbarang }}">
                                        <div class="invalid-feedback" id="jenisbarangedit-error">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="editSpan jenisbarang">{{ $item->lokasi_unit }}</span>
                                        <input type="text" class="editInput jenisbarang" name="jenisbarangedit" onclick="removenotif({{ $item->id }})" id="jenisbarangedit{{ $item->id }}" style="display:none;" value="{{ $item->jenisbarang }}">
                                        <div class="invalid-feedback" id="jenisbarangedit-error">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if ($item->status_unit == '0')
                                        <span class="badge bg-secondary editSpan jenisbarang">Tidak Aktif</span>
                                        @elseif ($item->status_unit == '1')
                                        <span class="badge bg-success editSpan jenisbarang">Aktif</span>
                                        @endif
                                        <input type="text" class="editInput jenisbarang" name="jenisbarangedit" onclick="removenotif({{ $item->id }})" id="jenisbarangedit{{ $item->id }}" style="display:none;" value="{{ $item->jenisbarang }}">
                                        <div class="invalid-feedback" id="jenisbarangedit-error">
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
                                    Data Unit belum Tersedia.
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
                        <label for="">Kode Unit</label>
                        <input type="text" name="kode_unit" id="kode_unit" class="kode_unit form-control">
                        <div class="invalid-feedback" id="kode_unit-error">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Nama</label>
                        <input type="text" name="nama_unit" id="nama_unit" class="nama_unit form-control">
                        <div class="invalid-feedback" id="nama_unit-error">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Lokasi</label>
                        <input type="text" name="lokasi_unit" id="lokasi_unit" class="lokasi_unit form-control">
                        <div class="invalid-feedback" id="lokasi_unit-error">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Status</label>
                        <select name="status_unit" id="status_unit" class="status_unit form-control">
                            <option value="">-- Pilih Status --</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                        <div class="invalid-feedback" id="status_unit-error">
                        </div>
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

<!-- Modal Edit Data -->
<div class="modal fade" id="edit-data">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <ul id="updateform_errList"></ul>
                <input type="text" id="edit_jenisbarang_id">
                <form id="modal-form">
                    <div class="form-group mb-3">
                        <label for="">Kode Unit</label>
                        <input type="text" id="edit_kode_unit" class="kode_unit form-control">
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-flat update_unit">Update</button>
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
        $('#kode_unit').on('click', function() {
            $('#kode_unit').removeClass('is-valid is-invalid');
        });

        // Menghilangkan alert error pada waktu tidak diinputkan
        $('#nama_unit').on('click', function() {
            $('#nama_unit').removeClass('is-valid is-invalid');
        });

        // Menghilangkan alert error pada waktu tidak diinputkan
        $('#lokasi_unit').on('click', function() {
            $('#lokasi_unit').removeClass('is-valid is-invalid');
        });

        // Menghilangkan alert error pada waktu tidak diinputkan
        $('#status_unit').on('click', function() {
            $('#status_unit').removeClass('is-valid is-invalid');
        });

        $(document).on('submit', '#modal-form', function(e) {
            e.preventDefault();
            var data = $(this).serialize();

            console.log(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/unit",
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
                            location = "{{ route('unit')}}";
                        }, 1500)
                    }
                }
            });
        });

        

        $(document).on('click', '.btnDelete', function(e) {
            e.preventDefault();
            var ID = $(this).closest("tr").attr('id');
            var url = "{{route('unit.destroy')}}";
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
    });

</script>


@endsection