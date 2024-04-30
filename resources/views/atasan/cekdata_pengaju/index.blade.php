@extends('admin.layout.main')

@section('title', 'Cek Pengajuan - Atasan')

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
                        <ul class="nav nav-tabs navbar-light">
                            <li class="nav-item text-dark">
                                <a href="{{ route('cekdatapengaju') }}" class="nav-link {{ request()->is('cekdatapengaju') ? 'active' : '' }}">DRAFT</a>
                            </li>
                            <li class="nav-item text-dark">
                                <a href="{{ route('cekdatapengaju-atasan', ['status' => 'diajukan']) }}" class="nav-link {{ request()->is('cekdatapengaju/diajukan') ? 'active' : '' }}">DIAJUKAN</a>
                            </li>
                            <li class="nav-item text-dark">
                                <a href="{{ route('cekdatapengaju-atasan', ['status' => 'disetujui']) }}" class="nav-link {{ request()->is('cekdatapengaju/disetujui') ? 'active' : '' }}">DISETUJUI</a>
                            </li>
                            <li class="nav-item text-dark">
                                <a href="{{ route('cekdatapengaju-atasan', ['status' => 'ditangguhkan']) }}" class="nav-link {{ request()->is('cekdatapengaju/ditangguhkan') ? 'active' : '' }}">DITANGGUHKAN</a>
                            </li>
                            <li class="nav-item text-dark">
                                <a href="{{ route('cekdatapengaju-atasan', ['status' => 'ditolak']) }}" class="nav-link {{ request()->is('cekdatapengaju/ditolak') ? 'active' : '' }}">DITOLAK</a>
                            </li>
                        </ul>
                        <div class="card-body">
                        <table id="datatables" class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th width="50px">No</th>
                                    <th>Kode <br> Pengajuan</th>
                                    <th>Nama Pengaju</th>
                                    <th>Tanggal</th>
                                    <th>Unit</th>
                                    <th>Status Atasan</th>
                                    <th>File</th>
                                    @if($datapengaju)
                                        @if($datapengaju[0]->status_setujuatasan == 1)
                                        <th width="100px">Aksi</th>
                                        @endif
                                    @endif
                                </tr>
                            </thead>
                            <tbody id="add_new">
                                @php $no = 1 @endphp
                                @forelse ($datapengaju as $item)
                                    <tr class="text-center" id="data{{ $item->id }}">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->code_pengajuan }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->tgl_pengajuan)) }}</td>
                                        <td>{{ $item->user->unit->nama_unit }}</td>
                                        <td>
                                            @if ($item->status_setujuatasan == 0)
                                                <span class="badge bg-dark">Draft</span>
                                            @elseif($item->status_setujuatasan == 1)
                                                <span class="badge bg-info">Diajukan</span>
                                            @elseif($item->status_setujuatasan == 2)
                                                <span class="badge bg-success">Disetujui</span>
                                            @elseif($item->status_setujuatasan == 3)
                                            <span class="badge bg-warning">Direvisi</span>
                                            @elseif($item->status_setujuatasan == 4)
                                            <span class="badge bg-danger">Ditolak</span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->upload_dokumen != null)
                                            <a href="{{ route('lihat-file', $item->id) }}" target="_blank"><span class="badge bg-info">Lihat
                                                    File</span></a>
                                            @elseif($item->upload_dokumen == null)
                                            -
                                            @endif
                                        </td>
                                        @if($item->status_setujuatasan == 1)
                                        <td>
                                            <a href="{{ route('detail-data-pengaju', $item->id) }}"
                                                class="btn btn-primary btn-sm btn-flat">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                        @endif
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Pengajuan Barang belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
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
    <script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/pdfmake/vfs_fonts.js')}}"></script>

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
