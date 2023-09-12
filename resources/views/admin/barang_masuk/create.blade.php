@extends('admin.layout.main')

@section('title', 'Barang Masuk - Administrator')

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
                            <form id="modal-form">

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
                                        <select id="barang" class="form-control select2">
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
                                            <th colspan="2" class="text-right" id="total_jumlah"></th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" style="text-align: right;">PPN : </th>
                                            <th width="200">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            Rp.
                                                        </span>
                                                    </div>
                                                    <input type="number" class="form-control" id="ppn_angka"
                                                        name="ppn_angka" value="0" placeholder="0">
                                                </div>
                                            </th>
                                            <th width="200">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            11 %
                                                        </span>
                                                    </div>
                                                    <input type="number" class="form-control" id="ppn_persen"
                                                        name="ppn_persen" value="0" placeholder="0">
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" style="text-align: right;">Diskon : </th>
                                            <th width="200">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            Rp.
                                                        </span>
                                                    </div>
                                                    <input type="number" class="form-control" id="diskon_angka"
                                                        name="diskon_angka" value="0" placeholder="0">
                                                </div>
                                            </th>
                                            <th width="200">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            %
                                                        </span>
                                                    </div>
                                                    <input type="number" class="form-control" id="diskon_persen"
                                                        name="diskon_persen" value="0" placeholder="0">
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" style="text-align: right;">Grand Total : </th>
                                            <th colspan="2" class="text-right">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            Rp.
                                                        </span>
                                                    </div>
                                                    <input type="number" class="form-control" id="total_bayar_input"
                                                        name="total_bayar_input">
                                                </div>
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

    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $('.select2').select2({
                theme: 'bootstrap4'
            });

            $(document).on('input',
                'input[id^="qty_"], input[id^="harga_"], #diskon, #ppn_angka, #ppn_persen, #diskon_angka, #diskon_persen',
                function() {
                    var id = $(this).attr('id').split('_')[1];
                    var qtyValue = parseFloat($("#qty_" + id).val());
                    var hargaValue = parseFloat($("#harga_" + id).val());
                    var jumlahById = $("#jumlah_" + id);

                    var jumlah = isNaN(qtyValue) || isNaN(hargaValue) ? 0 : qtyValue * hargaValue;
                    jumlahById.val(jumlah);

                    // Memanggil fungsi untuk menghitung total jumlah
                    var totalJumlah = hitungTotalJumlah();

                    var ppnAngka = parseFloat($("#ppn_angka").val()) || 0;
                    var ppnPersen = parseFloat($("#ppn_persen").val()) || 0;
                    var getPpn = (totalJumlah * ppnPersen / 100) + ppnAngka;

                    var diskonAngka = parseFloat($("#diskon_angka").val()) || 0;
                    var diskonPersen = parseFloat($("#diskon_persen").val()) || 0;
                    var getDiskon = (totalJumlah * diskonPersen / 100) + diskonAngka;

                    // Menghitung total bayar setelah ppn diskon
                    var totalBayar = totalJumlah + getPpn - getDiskon;

                    // Menampilkan total jumlah
                    $("#total_jumlah").text("Rp. " + totalJumlah);
                    $("#total_bayar").text("Rp. " + totalBayar);

                    // Melempar nilai totalBayar ke id total_bayar_input
                    $("#total_bayar_input").val(totalBayar);
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
                            <td width="200">
                                <select id="supplier_id_${id}" name="supplier_id[]" class="form-control select2">
                                    <option value="" selected disabled>Pilih Supplier</option>
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
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        Rp.
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" name="jumlah[]" id="jumlah_${id}" id="jumlah">
                                </div>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-xs btn-danger hapus"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    `;

                    $('.bahan-ajax').append(nilai);

                    // agar select2 di dom bisa berjalan
                    $('#supplier_id_' + id).select2({
                        theme: 'bootstrap4'
                    });
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

            $('body').on('click', '.hapus', function(e) {
                e.preventDefault();
                var deletedRow = $(this).closest('tr');
                deletedRow.remove();

                // Mengurangkan jumlah saat menghapus baris
                var hargaBaris = parseFloat(deletedRow.find('[id^="harga_"]').val()) || 0;
                var qtyBaris = parseFloat(deletedRow.find('[id^="qty_"]').val()) || 0;
                var jumlahBaris = qtyBaris * hargaBaris;

                // Mengambil total jumlah saat ini
                var totalJumlah = parseFloat($("#total_jumlah").text().replace("Rp. ", "")) || 0;
                totalJumlah -= jumlahBaris;

                // Menghitung ulang total bayar dengan mempertimbangkan diskon dan PPN
                var diskonAngka = parseFloat($("#diskon_angka").val()) || 0;
                var diskonPersen = parseFloat($("#diskon_persen").val()) || 0;
                var ppnAngka = parseFloat($("#ppn_angka").val()) || 0;
                var ppnPersen = parseFloat($("#ppn_persen").val()) || 0;

                var totalDiskon = (totalJumlah * diskonPersen / 100) + diskonAngka;
                var totalPPN = (totalJumlah * ppnPersen / 100) + ppnAngka;
                var totalBayar = totalJumlah + totalPPN - totalDiskon;

                // Memperbarui total jumlah dan total bayar
                $("#total_jumlah").text("Rp. " + totalJumlah.toFixed(2));
                $("#total_bayar").text("Rp. " + totalBayar.toFixed(2));
                $("#total_bayar_input").val(totalBayar.toFixed(2));

                // Jika tidak ada baris lagi, atur total_bayar ke 0
                var jumlahBaris = $('.bahan-ajax tr').length;
                if (jumlahBaris === 0) {
                    $("#total_jumlah").text("Rp. 0");
                    $("#total_bayar_input").val(0);
                    $("#ppn_angka").val(0);
                    $("#ppn_persen").val(0);
                    $("#diskon_angka").val(0);
                    $("#diskon_persen").val(0);
                }
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
                    url: "/store-barangmasuk",
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
                                location = "{{ route('barangmasuk') }}";
                            }, 1500)
                        }
                    }
                });
            });

            $("#ppn_angka, #ppn_persen").on("input", function() {
                var ppnAngka = parseFloat($("#ppn_angka").val());
                var ppnPersen = parseFloat($("#ppn_persen").val());

                if (!isNaN(ppnAngka) && ppnAngka !== 0) {
                    // Jika input PPN (Angka) terisi, menonaktifkan input PPN (Persen)
                    $("#ppn_persen").prop("disabled", true);
                } else if (!isNaN(ppnPersen) && ppnPersen !== 0) {
                    // Jika input PPN (Persen) terisi, menonaktifkan input PPN (Angka)
                    $("#ppn_angka").prop("disabled", true);
                } else {
                    // Jika keduanya kosong, aktifkan kembali keduanya
                    $("#ppn_angka, #ppn_persen").prop("disabled", false);
                }
            });

            $("#diskon_angka, #diskon_persen").on("input", function() {
                var diskonAngka = parseFloat($("#diskon_angka").val());
                var diskonPersen = parseFloat($("#diskon_persen").val());

                if (!isNaN(diskonAngka) && diskonAngka !== 0) {
                    $("#diskon_persen").prop("disabled", true);
                } else if (!isNaN(diskonPersen) && diskonPersen !== 0) {
                    $("#diskon_angka").prop("disabled", true);
                } else {
                    $("#diskon_angka, #diskon_persen").prop("disabled", false);
                }
            });
        });
    </script>

@endsection
