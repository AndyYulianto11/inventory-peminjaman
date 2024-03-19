@extends('admin.layout.main')

@section('title', 'Pengajuan Barang - Pengaju')


@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
                        <!-- modal -->
                        <div class="modal fade" id="modalLainnya">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Barang Lainnya</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body ml-3">
                                            <form>
                                                <div class="form-group row">
                                                    <label for="kode_barang" class="col-sm-3">Kode Barang :</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="code_barang" id="code_barang" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="nama_barang" class="col-sm-3">Nama Barang :</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="nama_barang" id="nama_barang" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="jenis_id" class="col-sm-3">Jenis Barang :</label>
                                                    <div class="col-sm-12">
                                                        <select name="jenis_id" id="jenis_id" class="form-control">
                                                            <option selected disabled>-- Jenis Barang --</option>
                                                            @foreach($jenisbarang as $row)
                                                            <option value="{{ $row->id }}" data-jenis="{{ $row->jenisbarang }}">{{ $row->jenisbarang }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row py-2">
                                                    <button type="button" onclick="barangFunction()" class="btn btn-sm btn-primary mr-2">Tambah</button>
                                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.modal -->
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
                                            <option value="lainnya">Lainnya</option>
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

                                <div class="table-responsive">
                                    <table class="table table-bordered table-stripde">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Jenis Barang</th>
                                                <th>Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bahan-lainnya">

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#barang').change(function(e) {
                if($(this).val() != "lainnya"){
                    e.preventDefault();
                    var nama_barang = $('option:selected', this).text();
                    var id = $('option:selected', this).val();
                    var satuan = $('option:selected', this).data('satuan');
                    var qty = $('option:selected', this).data('qty');
                    var code = $('option:selected', this).data('code');

                    $(this).val("");

                    var barangById = $('#barang_id_' + id);
                    console.log(barangById.val());
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
                }else{
                    $('#modalLainnya').modal('toggle');
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

        function barangFunction() {
            var code_barang = $('#code_barang').val();
            var nm_barang = $('#nama_barang').val();
            var jenis_id = $('#jenis_id').val();
            var e = document.getElementById('jenis_id');
            var jenis_barang = e.options[e.selectedIndex];

            var nilai = `
                            <tr>
                                <td class="text-center">
                                    ${code_barang}
                                    <input type="hidden" name="code_barang[]" value="${code_barang}">
                                </td>
                                <td class="text-center">
                                    ${nm_barang}
                                    <input type="hidden" name="nm_barang[]" value="${nm_barang}">
                                </td>
                                <td class="text-center">
                                    ${jenis_barang.getAttribute("data-jenis")}
                                    <input type="hidden" name="jenis_barang[]" value="${jenis_id}">
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-xs btn-danger hapus"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        `;
            $('.bahan-lainnya').append(nilai);
        };
    </script>

@endsection
