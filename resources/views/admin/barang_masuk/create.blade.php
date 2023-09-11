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
                                            placeholder="Kode Nota" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal_pembelian" class="col-sm-2 col-form-label">Tanggal</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="tanggal_pembelian"
                                            name="tanggal_pembelian" required>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label for="barang" class="col-sm-2 col-form-label">Barang Masuk</label>
                                    <div class="col-sm-10">
                                        <select id="barang" class="form-control">
                                            <option value="" selected disabled>-- Pilih Barang --</option>
                                            @foreach ($databarang as $data)
                                                <option value="{{ $data->id }}"
                                                    data-satuan="{{ $data->satuan->satuan }}"
                                                    data-qty="{{ $data->satuan->qty }}">{{ $data->nama_barang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Nama Barang</th>
                                                <th>Satuan</th>
                                                <th>Supplier</th>
                                                <th>Qty</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bahan-ajax">

                                        </tbody>
                                    </table>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered mt-3">
                                        <tr>
                                            <th colspan="2" style="text-align: right;" id="subtotal">Sub total : </th>
                                            <th class="text-right" id="total_jumlah"></th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" style="text-align: right;">PPN 11% : </th>
                                            <th class="text-right" id="total_ppn">Rp. 0</th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" style="text-align: right;">Diskon (%) : </th>
                                            <th width="300">
                                                <input type="number" class="form-control" id="diskon" name="diskon" placeholder="0">
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" style="text-align: right;">Total : </th>
                                            <th class="text-right" id="total_bayar">
                                                <input type="hidden" id="input_total_bayar" name="input_total_bayar">
                                            </th>
                                        </tr>
                                    </table>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm btn-flat">Simpan</button>
                                    <a href="/barangmasuk" class="btn btn-success btn-sm btn-flat">Kembali</a>
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
            $(document).on('input', 'input[id^="qty_"], input[id^="harga_"], #diskon', function() {
                var id = $(this).attr('id').split('_')[1];
                var qtyValue = parseFloat($("#qty_" + id).val());
                var hargaValue = parseFloat($("#harga_" + id).val());
                var jumlahById = $("#jumlah_" + id);

                var jumlah = isNaN(qtyValue) || isNaN(hargaValue) ? 0 : qtyValue * hargaValue;
                jumlahById.val(jumlah);

                // Memanggil fungsi untuk menghitung total jumlah dan PPN
                var totalJumlah = hitungTotalJumlah();
                var ppn = hitungPPN(totalJumlah);
                var totalPpn = totalJumlah + ppn;

                var diskon = parseFloat($("#diskon").val()) || 0;

                // Menghitung total bayar setelah diskon
                var totalBayar = totalPpn - (totalJumlah * (diskon / 100));

                // Menampilkan total jumlah, jumlah + PPN, diskon setelah jumlah + ppn
                $("#total_jumlah").text("Rp. " + totalJumlah);
                $("#total_ppn").text("Rp. " + totalPpn);
                $("#total_bayar").text("Rp. " + totalBayar);

                // add ke input
                var totalJumlahValue = $("#total_bayar").text();
                $("#input_total_bayar").val(totalJumlahValue);
                // console.log(totalJumlahValue);
            });

            $('#barang').change(function(e) {
                e.preventDefault();
                var nama_barang = $('option:selected', this).text();
                var id = $('option:selected', this).val();
                var satuan = $('option:selected', this).data('satuan');
                var qty = $('option:selected', this).data('qty');

                $(this).val("");

                var barangById = $('#barang_id_' + id);
                var qtyById = $("#qty_" + id);
                var supplierById = $("#supplier_id_" + id);
                var hargaById = $("#harga_" + id);
                var jumlahById = $("#jumlah_" + id);

                if (barangById.val() > 0) {
                    var current = qtyById.val();
                    qtyById.val(parseInt(current) + 1);
                } else {
                    var nilai = `
                        <tr>
                            <td class="text-center">
                                ${nama_barang}
                                <input type="hidden" class="form-control" name="barang_id[]" value="${id}" id="barang_id_${id}">
                            </td>
                            <td class="text-center">
                                ${satuan} | ${qty}
                            </td>
                            <td>
                                <select id="supplier_id_${id}" name="supplier_id[]" class="form-control">
                                    <option value="" selected disabled>-- Pilih Supplier --</option>
                                    @foreach ($supplier as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="text-center">
                                <input type="number" class="form-control" name="qty[]" id="qty_${id}" id="qty" value="1">
                            </td>
                            <td class="text-center">
                                <input type="number" class="form-control" name="harga[]" id="harga_${id}" id="harga">
                            </td>
                            <td class="text-center">
                                <input type="number" class="form-control" name="jumlah[]" id="jumlah_${id}" id="jumlah">
                            </td>
                            <td class="text-center">
                                <button class="btn btn-xs btn-danger hapus"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    `;

                    $('.bahan-ajax').append(nilai);
                }
            });

            // Fungsi untuk menghitung total jumlah
            function hitungTotalJumlah() {
                var total = 0;
                $('input[id^="jumlah_"]').each(function() {
                    var nilai = parseFloat($(this).val());
                    if (!isNaN(nilai)) {
                        total += nilai;
                    }
                });

                return total;
            }

            // Fungsi untuk menghitung PPN
            function hitungPPN(totalJumlah) {
                var ppn = 0.11 * totalJumlah; // 11% dari total jumlah
                return ppn;
            }

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
                    success: function(response) {
                        // console.log(response);

                        // if (response.status === 'error') {
                        //     Swal.fire({
                        //         position: 'center',
                        //         icon: 'error',
                        //         title: 'Oops!',
                        //         text: 'Gagal menambah data baru',
                        //         showConfirmButton: true,
                        //         timer: 3000
                        //     });
                        // } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Sukses!',
                            text: 'Berhasil menambah data baru',
                            showConfirmButton: true,
                            timer: 6000
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Redirect atau lakukan tindakan lain jika diperlukan
                                window.location.href = '/barangmasuk';
                            }
                        }, 3000);
                        // }
                    }

                });
            });
        });
    </script>

@endsection
