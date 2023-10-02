@extends('admin.layout.main')

@section('title', 'Cek Pengaju - Administrator')

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
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datatables" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th width="50px">No</th>
                                        <th>Kode Pengajuan</th>
                                        <th>Nama Pengaju</th>
                                        <th>Tanggal</th>
                                        <th>Unit</th>
                                        <th>Status</th>
                                        <th width="100px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="add_new">
                                    @php $no = 1 @endphp
                                    @forelse ($pengaju as $item)
                                        <tr class="text-center" id="data{{ $item->id }}">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->code_pengajuan }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item->tgl_pengajuan)) }}</td>
                                            <td>{{ $item->user->unit }}</td>
                                            <td>
                                                @if ($item->status == 'diajukan')
                                                    <span class="badge bg-warning">Diajukan</span>
                                                @elseif ($item->status == 'proses')
                                                    <span class="badge bg-secondary">Proses</span>
                                                @elseif ($item->status == 'pending')
                                                    <span class="badge bg-danger">Pending</span>
                                                @elseif ($item->status == 'sebagian sudah diserahkan')
                                                    <span class="badge bg-info">Sebagian Sudah Diserahkan</span>
                                                @else
                                                    <span class="badge bg-success">Serah Terima</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button href="{{ route('detail-barangmasuk', $item->id) }}"
                                                    class="btn btn-primary btn-sm btn-flat"
                                                    onclick="detail({{ $item->id }})" data-toggle="modal"
                                                    data-target="#detail"><i class="fas fa-eye"></i></button>
                                                <a href="{{ route('edit-barangmasuk', $item->id) }}"
                                                    class="btn btn-warning btn-sm btn-flat  edit_inline"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                                <button class="btn btn-danger btn-sm btn-flat btnDelete"><i
                                                        class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Pengajuan Barang belum Tersedia.
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

    <!-- Detail Barcode -->
    <div class="modal fade" id="detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

@endsection

@section('js')

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
                url: "{{ route('shows-pengaju') }}",
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
                            <th class="text-center">Barcode</th>
                        </tr>
                        <tr>
                            <td class="text-center">${response.data.nama_barang}</td>
                            <td class="text-center">${response.data.stok}</td>
                            <td class="text-center">${response.data.jenisbarang}</td>
                            <td class="text-center">${response.data.satuan}</td>
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

            $(document).on('click', '.btnDelete', function(e) {
                e.preventDefault();
                var ID = $(this).closest("tr").attr('id');
                var url = "{{ route('delete-barangmasuk') }}";
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
