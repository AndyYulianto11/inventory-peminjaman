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
                    <div id="success_message"></div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $data['subjudul'] }}</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#add-data"><i
                                        class="fas fa-plus"></i> Add Data
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datatables" class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th width="50px">No</th>
                                        <th>Nama</th>
                                        <th>E-Mail</th>
                                        <th>Level</th>
                                        <th>Last Seen</th>
                                        <th>Unit</th>
                                        <th width="100px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="add_new">
                                    @php $no = 1 @endphp
                                    @forelse ($user as $item)
                                        <tr id="data{{ $item->id }}">
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td class="text-center"><span
                                                    class="badge bg-primary">{{ $item->role }}</span></td>
                                            <td class="text-center">
                                                @if (Cache::has('user-is-online-' . $item->id))
                                                    <span class="badge bg-success">Online</span>
                                                @else
                                                    <span class="badge bg-secondary">Offline</span>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $item->unit->nama_unit }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-danger btn-sm btn-flat btnDelete"><i
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
                            <label for="">Nama</label>
                            <input type="text" name="name" id="name" class="name form-control">
                            <div class="invalid-feedback" id="name-error">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Unit</label>
                            <select name="unit_id" class="form-control" id="unit_id">
                                <option value="">-- Pilih Unit --</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->nama_unit }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="unit_id-error">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Email</label>
                            <input type="text" name="email" id="email" class="email form-control">
                            <div class="invalid-feedback" id="email-error">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Password</label>
                            <input type="password" name="password" id="password" class="password form-control">
                            <div class="invalid-feedback" id="password-error">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Role</label>
                            <select name="role" class="form-control" id="role">
                                <option value="">-- Pilih Role --</option>
                                <option value="administrator">Administrator</option>
                                <option value="admingudang">Admin Gudang</option>
                                <option value="kepalagudang">Kepala Gudang</option>
                                <option value="atasan">Atasan</option>
                                <option value="pengaju">Pengaju</option>
                                <option value="keuangan">Keuangan</option>
                                <option value="rektor">Rektor</option>
                            </select>
                            <div class="invalid-feedback" id="role-error">
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat add_user">Save</button>
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
            $('#name').on('click', function() {
                $('#name').removeClass('is-valid is-invalid');
            });

            $('#unit').on('click', function() {
                $('#unit').removeClass('is-valid is-invalid');
            });

            $('#email').on('click', function() {
                $('#email').removeClass('is-valid is-invalid');
            });

            $('#password').on('click', function() {
                $('#password').removeClass('is-valid is-invalid');
            });

            $('#role').on('change', function() {
                $('#role').removeClass('is-valid is-invalid');
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
                    url: "/user",
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
                                $('#' + field + '-error').text(errors[0]).wrapInner(
                                    "<strong />");
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
                                location = "{{ route('user') }}";
                            }, 1500)
                        }
                    }
                });
            });

            $(document).on('click', '.btnDelete', function(e) {
                e.preventDefault();
                var ID = $(this).closest("tr").attr('id');
                var url = "{{ route('user.destroy') }}";
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
        })
    </script>

@endsection
