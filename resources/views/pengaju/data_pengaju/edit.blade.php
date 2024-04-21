@extends('admin.layout.main')

@section('title', 'Edit Pengajuan - Pengaju')


@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $data['subjudul'] }}</h3>

                            <div class="card-tools">
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <div class="card-body">
                            <ul id="saveform_errList"></ul>
                            <form action="{{ route('update-datapengaju', $datapengaju->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="role" value="{{ $roles }}" class="form-control">
                                <div class="form-group row">
                                    <label for="kode_nota" class="col-sm-2 col-form-label">Kode Pengajuan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="code_pengajuan" name="code_pengajuan"
                                            value="{{ $datapengaju->code_pengajuan }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tgl_pengajuan" class="col-sm-2 col-form-label">Tanggal</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="tgl_pengajuan" onchange="handler(event)" name="tgl_pengajuan"
                                            value="{{ $datapengaju->tgl_pengajuan }}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kode_nota" class="col-sm-2 col-form-label">Nama Pengaju</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="user" name="user"
                                            value="{{ $datapengaju->user->name }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kode_nota" class="col-sm-2 col-form-label">Unit</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="unit" name="unit"
                                            value="{{ $datapengaju->user->unit->kode_unit }} / {{ $datapengaju->user->unit->nama_unit }}"
                                            readonly>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Satuan</th>
                                                <th>Qty</th>
                                                <th>Status</th>
                                                <th>Keterangan</th>
                                                <th>Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bahan-ajax">
                                            @foreach ($databarang as $barang)
                                                <tr id="data{{ $barang->id }}">
                                                    <td class="text-center">{{ $barang->barang->code_barang }}</td>
                                                    <td>{{ $barang->barang->nama_barang }}</td>
                                                    <td class="text-center">
                                                        {{ $barang->barang->satuan->satuan }} |
                                                        {{ $barang->barang->satuan->qty }}
                                                    </td>
                                                    <td class="text-center" width="10%">
                                                        <input type="number" min="0" class="form-control" id="qty{{ $barang->id }}" name="qty[]" value="{{ $barang->qty }}" @if($barang->status_persetujuanatasan == '1') readonly @endif>
                                                    </td>
                                                    <td class="text-center">
                                                        @if($barang->status_persetujuanatasan == '0')
                                                            <span class="badge bg-dark">Draf</span>
                                                        @elseif($barang->status_persetujuanatasan == '1')
                                                            <span class="badge bg-info">Diajukan</span>
                                                        @elseif ($barang->status_persetujuanatasan == '2')
                                                            <span class="badge bg-success">Disetujui</span>
                                                        @elseif ($barang->status_persetujuanatasan == '3')
                                                            <span class="badge bg-danger">Ditolak</span>
                                                        @elseif ($barang->status_persetujuanatasan == '4')
                                                            <span class="badge bg-warning">Direvisi</span>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td class="text-center">@if($barang->keterangan != '') {{ $barang->keterangan }} @else - @endif</td>
                                                    <td class="text-center">
                                                        @if($barang->status_persetujuanatasan == '2')
                                                        <button class="btn btn-xs btn-danger btnDelete" id="btnDelete{{ $barang->id }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        @else
                                                        -
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm btn-flat" @foreach ($databarang as $data)
                                    @if($data->status_persetujuanatasan != 0)
                                    disabled
                                    @endif
                                    @endforeach id="btnSave">Simpan</button>
                                    <a href="{{ request()->is('detail-datapengaju/admin/'.$datapengaju->id) ? '/datapengaju/admin' : '/datapengaju/atasan' }}" class="btn btn-success btn-sm btn-flat">Kembali</a>
                                </div>
                            </form>
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

    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4'
            });

            $('body').on('click', '.hapus', function(e) {
                e.preventDefault();
                var deletedRow = $(this).closest('tr');
                deletedRow.remove();
            });
        });

        $(document).on('click', '.btnDelete', function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var ID = $(this).closest("tr").attr('id');
            var url = "{{ route('delete-item-datapengaju') }}";
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
                        document.getElementById("btnSave").removeAttribute("disabled");
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
        @php foreach($databarang as $row) { @endphp
            document.getElementById("qty"+{{$row->id}}).addEventListener("change", () => {
                document.getElementById("btnSave").removeAttribute("disabled");
            });
        @php } @endphp

        function handler(e){
            document.getElementById("btnSave").removeAttribute("disabled");
        }
    </script>

@endsection
