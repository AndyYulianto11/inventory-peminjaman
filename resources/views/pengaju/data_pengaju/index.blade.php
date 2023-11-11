@extends('admin.layout.main')

@section('title', 'Pengajuan Barang - Pengaju')

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
                            <a href="{{ route('create-datapengaju') }}" type="button" class="btn btn-tool"><i class="fas fa-plus"></i> Add Data
                            </a>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="datatables" class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th width="50px">No</th>
                                    <th>Kode <br> Pengajuan</th>
                                    <th width="150px">Tanggal</th>
                                    <th>Qty</th>
                                    <th>Status Atasan</th>
                                    <th>Status Admin</th>
                                    <th>File</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1 @endphp
                                @forelse ($datapengaju as $item)
                                <tr class="text-center" id="data{{ $item->id }}">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->code_pengajuan }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->tgl_pengajuan)) }}</td>
                                    <td>
                                        @if ($item->item_datapengaju->count() > 0)
                                        {{ $item->item_datapengaju->count() }}
                                        @else
                                        0
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status_setujuatasan == 1)
                                        <span class="badge bg-info">Diajukan</span>
                                        @elseif($item->status_setujuatasan == 2)
                                        <span class="badge bg-secondary">Diproses</span>
                                        @elseif($item->status_setujuatasan == 3)
                                        <span class="badge bg-success">Disetujui</span>
                                        @elseif($item->status_setujuatasan == 4)
                                        <span class="badge bg-danger">Ditolak</span>
                                        @elseif($item->status_setujuatasan == 5)
                                        <span class="badge bg-warning">Direvisi</span>
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status_setujuadmin == 0)
                                            <span class="badge bg-info">Diajukan</span>
                                        @elseif($item->status_setujuadmin == 1)
                                            <span class="badge bg-secondary">Proses</span>
                                        @elseif($item->status_setujuadmin == 2)
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($item->status_setujuadmin == 3)
                                            <span class="badge bg-success">Selesai</span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->upload_dokumen != null)
                                        <a href="{{ route('lihat-dokumen', $item->id) }}" target="_blank"><span class="badge bg-info">Lihat
                                                File</span></a>
                                        @elseif($item->upload_dokumen == null)
                                        -
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('lihat-data-pengaju', $item->id) }}" class="btn btn-primary btn-sm btn-flat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if ($item->status_pengajuan == 1 && $item->upload_dokumen == null && $item->status_setujuatasan == 5)
                                        <a href="{{ route('edit-datapengaju', $item->id) }}" class="btn btn-warning btn-sm btn-flat">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        @endif
                                        @if ($item->status_setujuatasan == 3 && $item->upload_dokumen == null)
                                        <a href="{{ route('upload', $item->id) }}" class="btn btn-success btn-sm btn-flat">
                                            <i class="fas fa-arrow-up"></i>
                                        </a>
                                        @endif
                                        @if ($item->status_setujuatasan == 3 && $item->upload_dokumen != null && $item->status_submit == '0')
                                        <a class="btn btn-success btn-sm btn-flat" onclick="updateStatus({{ $item->id }})">
                                            <i class="fas fa-share"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data Pengaju belum Tersedia.
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

    });

    function updateStatus(id) {
        $.ajax({
            url: `/update-status/${id}`,
            type: 'PUT',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status === 'success') {
                    // alert('Status diperbarui');
                    // Tambahkan logika lain yang Anda perlukan
                    // window.location.href = "{{ route('datapengaju') }}";
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500

                    });
                    setTimeout(function() {
                        location = "{{ route('datapengaju') }}";
                    }, 1500)
                } else {
                    alert('Gagal memperbarui status');
                }
            },
            error: function(xhr, status, error) {
                alert('Terjadi kesalahan: ' + error);
            }
        });
    }
</script>

@endsection
