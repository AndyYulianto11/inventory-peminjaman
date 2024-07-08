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
                            @if($role == 'atasan')
                                <a href="{{ route('create-datapengaju') }}" type="button" class="btn btn-tool"><i class="fas fa-plus"></i> Add Data
                                </a>
                            @endif
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <ul class="nav nav-tabs navbar-light">
                        <li class="nav-item text-dark">
                            <a href="{{ route('datapengaju', ['role' => $role]) }}" class="nav-link {{ request()->is('datapengaju/'.$role) ? 'active' : '' }}">DRAFT</a>
                        </li>
                        @if($role == "atasan")
                        <li class="nav-item text-dark">
                            <a href="{{ route('datapengaju-'.$role, ['status' => 'diajukan']) }}" class="nav-link {{ request()->is('datapengaju/'.$role.'/diajukan') ? 'active' : '' }}">DIAJUKAN</a>
                        </li>
                        <li class="nav-item text-dark">
                            <a href="{{ route('datapengaju-'.$role, ['status' => 'disetujui']) }}" class="nav-link {{ request()->is('datapengaju/'.$role.'/disetujui') ? 'active' : '' }}">DISETUJUI</a>
                        </li>
                        <li class="nav-item text-dark">
                            <a href="{{ route('datapengaju-'.$role, ['status' => 'ditangguhkan']) }}" class="nav-link {{ request()->is('datapengaju/'.$role.'/ditangguhkan') ? 'active' : '' }}">DITANGGUHKAN</a>
                        </li>
                        <li class="nav-item text-dark">
                            <a href="{{ route('datapengaju-'.$role, ['status' => 'ditolak']) }}" class="nav-link {{ request()->is('datapengaju/'.$role.'/ditolak') ? 'active' : '' }}">DITOLAK</a>
                        </li>
                        @elseif($role == "admin")
                        <li class="nav-item text-dark">
                            <a href="{{ route('datapengaju-'.$role, ['status' => 'diajukan']) }}" class="nav-link {{ request()->is('datapengaju/'.$role.'/diajukan') ? 'active' : '' }}">DIAJUKAN</a>
                        </li>
                        <li class="nav-item text-dark">
                            <a href="{{ route('datapengaju-'.$role, ['status' => 'belum-serah-terima']) }}" class="nav-link {{ request()->is('datapengaju/'.$role.'/belum-serah-terima') ? 'active' : '' }}">BELUM SERAH TERIMA</a>
                        </li>
                        <li class="nav-item text-dark">
                            <a href="{{ route('datapengaju-'.$role, ['status' => 'serah-terima']) }}" class="nav-link {{ request()->is('datapengaju/'.$role.'/serah-terima') ? 'active' : '' }}">SERAH TERIMA</a>
                        </li>
                        <li class="nav-item text-dark">
                            <a href="{{ route('datapengaju-'.$role, ['status' => 'sebagian-serah-terima']) }}" class="nav-link {{ request()->is('datapengaju/'.$role.'/sebagian-serah-terima') ? 'active' : '' }}">SEBAGIAN SERAH TERIMA</a>
                        </li>
                        @endif
                    </ul>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="datatables" class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    @if($role == 'atasan')
                                        <th width="50px">No</th>
                                        <th>Kode <br> Pengajuan</th>
                                        <th width="150px">Tanggal</th>
                                        <th>Qty</th>
                                        <th>Status Atasan</th>
                                        <th>File</th>
                                        <th width="150px">Aksi</th>
                                    @else
                                        <th width="50px">No</th>
                                        <th>Kode <br> Pengajuan</th>
                                        <th width="150px">Tanggal</th>
                                        <th>Qty</th>
                                        <th>Status Admin</th>
                                        <th>File</th>
                                        <th width="150px">Aksi</th>
                                    @endif
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
                                        @php

                                            $data = App\Models\ItemDataPengaju::where('datapengaju_id', $item->id)->sum('qty');

                                            echo $data;
                                        @endphp
                                    </td>
                                    @if($role == 'atasan')
                                    <td>
                                        @if($item->status_setujuatasan == 0)
                                        <span class="badge bg-dark">Draft</span>
                                        @elseif($item->status_setujuatasan == 1)
                                        <span class="badge bg-info">Diajukan</span>
                                        @elseif($item->status_setujuatasan == 2)
                                        <span class="badge bg-success">Disetujui</span>
                                        @elseif($item->status_setujuatasan == 3)
                                        <span class="badge bg-warning">Ditangguhkan</span>
                                        @elseif($item->status_setujuatasan == 4)
                                        <span class="badge bg-danger">Ditolak</span>
                                        @else
                                        -
                                        @endif
                                    </td>
                                    @else
                                    <td>
                                        @if($item->status_setujuadmin == 0)
                                        <span class="badge bg-dark">Draft</span>
                                        @elseif($item->status_setujuadmin == 1)
                                        <span class="badge bg-info">Diajukan</span>
                                        @elseif($item->status_setujuadmin == 2)
                                        <span class="badge bg-success">Disetujui</span>
                                        @elseif($item->status_setujuadmin == 3)
                                        <span class="badge bg-warning">Ditangguhkan</span>
                                        @elseif($item->status_setujuadmin == 4)
                                        <span class="badge bg-danger">Ditolak</span>
                                        @else
                                        -
                                        @endif
                                    </td>
                                    @endif
                                    <td>
                                        @if ($item->upload_dokumen != null)
                                        <a href="{{ route('lihat-dokumen', $item->id) }}" target="_blank"><span class="badge bg-info">Lihat
                                                File</span></a>
                                        @elseif($item->upload_dokumen == null)
                                        -
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($role == 'admin')
                                            <a href="{{ route('lihat-data-pengaju', ['role' => $role, 'id' => $item->id]) }}" class="btn btn-primary btn-sm btn-flat" title="Lihat Data">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('lihat-data-pengaju', ['role' => $role, 'id' => $item->id]) }}" class="btn btn-primary btn-sm btn-flat" title="Lihat Data">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endif

                                        @if ($item->status_setujuatasan == 0)
                                            <a class="btn btn-success btn-sm btn-flat" onclick="updateSetujuatasan({{ $item->id }})" title="Ajukan Atasan">
                                                <i class="fas fa-share"></i>
                                            </a>
                                        @endif

                                        @if ($item->status_pengajuan == 1 && $item->upload_dokumen == null && $item->status_setujuatasan == 5 || $item->status_setujuatasan == 0 || $item->status_setujuatasan == 3)
                                        <a href="{{ route('edit-datapengaju', ['role' => $role, 'id' => $item->id]) }}" class="btn btn-warning btn-sm btn-flat" title="Edit Data">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        @endif

                                        @if ($item->status_setujuatasan == 2 && $item->upload_dokumen == null && $role == "atasan")
                                        <a href="{{ route('upload', $item->id) }}" class="btn btn-success btn-sm btn-flat" title="Upload File">
                                            <i class="fas fa-arrow-up"></i>
                                        </a>
                                        @endif

                                        @if ($item->status_setujuatasan == 2 && $item->upload_dokumen != null && $item->status_submit == '0' && $role != 'admin')
                                        <a class="btn btn-success btn-sm btn-flat" onclick="updateStatus({{ $item->id }})" title="Ajukan Admin">
                                            <i class="fas fa-share"></i>
                                        </a>
                                        @endif

                                        @if($item->status_setujuatasan == 4)
                                        <a class="btn btn-danger btn-sm btn-flat btnDelete" id="{{$item->id}}" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Tidak ada data pengaju.
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
                    // window.location.href = "{{ route('datapengaju', ['role' => $role]) }}";
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500

                    });
                    setTimeout(function() {
                        location = "{{ route('datapengaju', ['role' => $role]) }}";
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

    function updateSetujuatasan(id){
        $.ajax({
            url: `/update-setuju-atasan/${id}`,
            type: 'PUT',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status === 'success') {
                    // alert('Status diperbarui');
                    // Tambahkan logika lain yang Anda perlukan
                    // window.location.href = "{{ route('datapengaju', ['role' => $role]) }}";
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500

                    });
                    setTimeout(function() {
                        location = "{{ route('datapengaju', ['role' => $role]) }}";
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

    $(document).on('click', '.btnDelete', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: `/delete-item-datapengaju`,
              method: 'delete',
              data: {
                id: id,
                _token: csrf
              },
              success: function(response) {
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
              }
            });
          }
        })
    });
</script>

@endsection
