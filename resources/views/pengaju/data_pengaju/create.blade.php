@extends('admin.layout.main')

@section('title', 'Pengajuan Barang - Pengaju')


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
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <div class="card-body">
                            <ul id="saveform_errList"></ul>
                            <form id="modal-form">

                                <div class="form-group row">
                                    <label for="code_pengajuan" class="col-sm-2 col-form-label">Kode Pengajuan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="code_pengajuan" name="code_pengajuan"
                                        value="{{ $codePengajuan }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tgl_pengajuan" class="col-sm-2 col-form-label">Tanggal</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="tgl_pengajuan" name="tgl_pengajuan"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="user" class="col-sm-2 col-form-label">Nama Pengaju</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="user" name="user"
                                            value="{{ Auth::user()->name }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="unit" class="col-sm-2 col-form-label">Unit</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="unit" name="unit"
                                            value="{{ Auth::user()->unit->kode_unit }} / {{ Auth::user()->unit->nama_unit }}"
                                            readonly>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label for="barang" class="col-sm-2 col-form-label">Data Barang</label>
                                    <div class="col-sm-10">
                                        <select id="barang" class="form-control select2">
                                            <option value="" selected disabled>-- Pilih Barang --</option>
                                            @foreach ($databarang as $data)
                                                <option value="{{ $data->id }}"
                                                    data-satuan="{{ $data->satuan->satuan }}"
                                                    data-qty="{{ $data->satuan->qty }}"
                                                    data-code="{{ $data->code_barang }}">{{ $data->nama_barang }}</option>
                                            @endforeach
                                        </select>
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
                                                <th>Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bahan-ajax">

                                        </tbody>
                                    </table>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm btn-flat">Simpan</button>
                                    <a href="/datapengaju" class="btn btn-success btn-sm btn-flat">Kembali</a>
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

            $('#barang').change(function(e) {
                e.preventDefault();
                var nama_barang = $('option:selected', this).text();
                var id = $('option:selected', this).val();
                var satuan = $('option:selected', this).data('satuan');
                var qty = $('option:selected', this).data('qty');
                var code = $('option:selected', this).data('code');

                $(this).val("");

                var barangById = $('#barang_id_' + id);
                var qtyById = $("#qty_" + id);

                if (barangById.val() > 0) {
                    var current = qtyById.val();
                    qtyById.val(parseInt(current) + 1);
                } else {
                    var nilai = `
                        <tr>
                            <td class="text-center">
                                ${code}
                            </td>
                            <td class="text-center">
                                ${nama_barang}
                                <input type="hidden" class="form-control" name="barang_id[]" value="${id}" id="barang_id_${id}">
                            </td>
                            <td class="text-center">
                                ${satuan} | ${qty}
                            </td>
                            <td class="text-center">
                                <input type="number" class="form-control" name="qty[]" id="qty_${id}" id="qty" value="1">
                            </td>
                            <input type="hidden" name="status_persetujuanatasan[]" id="status_persetujuanatasan_${id}" id="status_persetujuanatasan" value="0">

                            <td class="text-center">
                                <button class="btn btn-xs btn-danger hapus"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    `;

                    $('.bahan-ajax').append(nilai);
                }
            });

            $('body').on('click', '.hapus', function(e) {
                e.preventDefault();
                var deletedRow = $(this).closest('tr');
                deletedRow.remove();
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
                    url: "/store-datapengaju",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response.status == 400) {
                            $('#saveform_errList').html("");
                            $('#saveform_errList').addClass('alert alert-danger');
                            $.each(response.errors, function(key, err_values) {
                                $('#saveform_errList').append('<li>' + err_values +
                                    '</li>');
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
                                location = "{{ route('datapengaju') }}";
                            }, 1500)
                        }
                    }
                });
            });
        });
    </script>

@endsection
