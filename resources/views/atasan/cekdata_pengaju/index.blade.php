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
                                        <th>Unit</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
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
                                            <td>{{ $item->user->unit }}</td>
                                            <td>
                                                @if($item->status_setujuatasan == 1)
                                                <span class="badge bg-info">Diajukan</span>
                                                @elseif($item->status_setujuatasan == 2)
                                                <span class="badge bg-secondary">Diproses</span>
                                                @elseif($item->status_setujuatasan == 3)
                                                <span class="badge bg-success">Disetujui</span>
                                                @elseif($item->status_setujuatasan == 4)
                                                <span class="badge bg-danger">Ditolak</span>
                                                @elseif($item->status_setujuatasan == 5)
                                                <span class="badge bg-warning">Direvisi</span>
                                                @endif
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($item->tgl_pengajuan)) }}</td>
                                            <td>
                                                <a href="{{ route('detail-data-pengaju', $item->id) }}" class="btn btn-primary btn-sm btn-flat">
                                                    <i class="fas fa-eye"></i>
                                                </a>
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
