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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $data['subjudul'] }}</h3>

                            <div class="card-tools">
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store-barangmasuk') }}" method="POST" id="formMenu">
                                @csrf

                                <div class="form-group row">
                                    <label for="kode_nota" class="col-sm-2 col-form-label">Kode Nota</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="kode_nota" name="kode_nota"
                                            placeholder="Kode Nota">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal_pembelian" class="col-sm-2 col-form-label">Tanggal</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="tanggal_pembelian"
                                            name="tanggal_pembelian">
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label for="barang" class="col-sm-2 col-form-label">Barang Masuk</label>
                                    <div class="col-sm-10">
                                        <select id="barang" class="form-control">
                                            <option value="" selected disabled>-- Pilih Barang --</option>
                                            @foreach ($databarang as $data)
                                                <option value="{{ $data->id }}">{{ $data->nama_barang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Nama Barang</th>
                                                {{-- <th>Supplier</th> --}}
                                                <th>Qty</th>
                                                <th>Harga</th>
                                                <th>Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bahan-ajax">

                                        </tbody>
                                    </table>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm btn-flat">Simpan</button>
                                    <a href="#" class="btn btn-success btn-sm btn-flat">Kembali</a>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#barang').change(function(e) {
                e.preventDefault();
                var nama_barang = $('option:selected', this).text();
                var id = $('option:selected', this).val();

                $(this).val("");

                var barangById = $('#barang_id_' + id);
                var qtyById = $("#qty_" + id);
                var supplierById = $("#supplier_id_" + id);
                var hargaById = $("#harga_" + id);

                if (barangById.val() > 0) {
                    var current = qtyById.val();
                    qtyById.val(parseInt(current) + 1);
                } else {
                    var nilai = `
                    <tr>
                        <td>
                            ${nama_barang}
                            <input type="hidden" class="form-control" name="barang_id[]" value="${id}" id="barang_id_${id}">
                        </td>
                        <td class="text-center">
                            <input type="number" class="form-control" name="qty[]" id="qty_${id}" id="qty" value="1">
                        </td>
                        <td>
                            <input type="number" class="form-control" name="harga[]" id="harga_${id}" id="harga">
                        </td>
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
                $(this).closest('tr').remove();
            });

            $("#formMenu").submit(function(e) {
                e.preventDefault();
                $('.preloader').fadeIn();

                var _this = e;
                var form = $(this).closest('form')[0];
                var form = new FormData(form);

                console.log(form);

                $.ajax({
                    type: $(this).attr("method"),
                    url: $(this).attr("action"),
                    data: form,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(data) {
                        console.log(data);

                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.title,
                            showConfirmButton: false,
                            timer: 1500

                        });
                        setTimeout(function() {
                            location = "{{ route('barangmasuk') }}";
                        }, 1500)
                    }
                });
            });
        });
    </script>

@endsection
