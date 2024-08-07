@extends('admin.layout.main')

@section('title', 'Transaksi Pengadaan Barang - Administrator')


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
                                    <label for="kode_transaksi" class="col-sm-2 col-form-label">Kode Transaksi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="kode_transaksi" name="kode_transaksi"
                                            value="{{ $kodeTransaksi }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_transaksi" class="col-sm-2 col-form-label">Nama Transaksi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_transaksi"
                                            name="nama_transaksi">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tgl_transaksi" class="col-sm-2 col-form-label">Tanggal</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control"
                                            value="{{ $currentDateTime->format('d-m-Y') }}" readonly>
                                        <input type="hidden" class="form-control" id="tgl_transaksi" name="tgl_transaksi"
                                            value="{{ $currentDateTime }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="user" class="col-sm-2 col-form-label">Admin</label>
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
                                <div class="text-right mb-3">
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#itemModal">Data Item</button>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#dateFilterModal">Generate Data</button>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Satuan</th>
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

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm btn-flat">Simpan</button>
                                    <a href="/cek-datapengadaanbarang" class="btn btn-success btn-sm btn-flat">Kembali</a>
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

    <!-- Filter item -->
    <div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="itemModalLabel">Item Data Pengadaan Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="from-group row">
                        <label for="nama_barang" class="col-sm-2 col-from-label">Pilih Barang :</label>
                        <div class="col-sm-10">
                            <select id="barang" class="form-control select2">
                                <option disabled selected>-- Pilih Barang --</option>
                                @foreach ($barang as $data)
                                    <option value="{{ $data->id }}"
                                        data-satuan="{{ $data->satuan->satuan }}"
                                        data-code="{{ $data->code_barang }}"
                                        data-harga="{{ $data->harga }}">{{ $data->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="dateFilterModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dateFilterModalLabel">Filter Data by Date</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="start_date_modal">Start Date:</label>
                            <input type="date" class="form-control" name="start_date_modal" id="start_date_modal">
                        </div>
                        <div class="col-md-6">
                            <label for="end_date_modal">End Date:</label>
                            <input type="date" class="form-control" name="end_date_modal" id="end_date_modal">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="filter_btn_modal">Filter Data</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
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
        $(document).ready(function() {

            function formatRupiah(angka) {
                var numberString = angka.toString();
                var sisa = numberString.length % 3;
                var rupiah = numberString.substr(0, sisa);
                var ribuan = numberString.substr(sisa).match(/\d{3}/g);

                if (ribuan) {
                    var separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                return 'Rp ' + rupiah;
            }

            $('#barang').change(function(e) {
                e.preventDefault();
                var nama_barang = $('option:selected', this).text();
                var id = $('option:selected', this).val();
                var satuan = $('option:selected', this).data('satuan');
                var code = $('option:selected', this).data('code');
                var harga = $('option:selected', this).data('harga');

                var _qty = 1;

                var jumlah = formatRupiah(_qty * harga);

                $(this).val("");
                var barangById = $('#barang_id_' + id + '_add');
                var qtyById = $("#qty_" + id);
                var _jumlah = $("#jumlah_" + id);

                if (barangById.val() > 0) {
                    var current = qtyById.val();
                    qtyById.val(parseInt(current) + 1);
                    _jumlah.empty();
                    _jumlah.append(formatRupiah(qtyById.val() * harga));
                } else {
                    var nilai = `
                        <tr data-id="${id}">
                            <td class="text-center">
                                ${code}
                            </td>
                            <td class="text-center">
                                ${nama_barang}
                                <input type="hidden" class="form-control" name="barang_id[]" value="${id}" id="barang_id_${id}_add">
                                <input type="hidden" class="form-control" name="nama_barang[]" value="${nama_barang}" id="nama_barang_${nama_barang}" id="nama_barang">
                            </td>
                            <td class="text-center">
                                ${satuan}
                                <input type="hidden" class="form-control" name="satuan[]" value="${satuan}" id="satuan_${satuan}" id="satuan">
                            </td>
                            <td class="text-center">
                                <input type="number" min="1" class="form-control" name="qty[]" id="qty_${id}" data-qty="${id}" id="qty" value="1">
                            </td>
                            <td class="text-center" id="harga_${id}" data-harga="${harga}">
                                ${formatRupiah(harga)}
                                <input type="hidden" class="form-control" name="harga[]" value="${harga}" id="harga_${harga}" id="harga">
                            </td>
                            <td class="text-center" id="jumlah_${id}">
                                ${jumlah}
                            </td>
                            <td class="text-center">
                                <button class="btn btn-xs btn-danger hapus"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    `;
                    $('.bahan-ajax').append(nilai);
                }

                $('#qty_' + id).on("keyup mouseup", function(){
                    var qty = $(this).val();
                    var id = $(this).data("qty");
                    var harga = $("#harga_" + id).data("harga");
                    $('#jumlah_' + id).empty();
                    $('#jumlah_' + id).append(formatRupiah(qty * harga));
                });
            });

            // Fungsi untuk menambahkan data ke dalam tabel (bahan-ajax)
            function tambahDataKeTabel(code_barang, nama_barang, satuan, qty, harga, id) {
                var existingRow = $('.bahan-ajax').find('tr[data-id="' + id + '"]');

                if (existingRow.length > 0) {
                    alert("Data sudah ditambahkan");
                } else {
                    var nilai = `
                        <tr data-id="${id}">
                            <td class="text-center">
                                ${code_barang}
                            <input type="hidden" class="form-control" name="code_barang[]" value="${code_barang}" id="code_barang_${code_barang}" id="code_barang">
                            </td>
                            <td class="text-center">
                                ${nama_barang}
                                <input type="hidden" class="form-control" name="barang_id[]" value="${id}" id="barang_id_${id}">
                                <input type="hidden" class="form-control" name="nama_barang[]" value="${nama_barang}" id="nama_barang_${nama_barang}" id="nama_barang">
                            </td>
                            <td class="text-center">
                                ${satuan}
                                <input type="hidden" class="form-control" name="satuan[]" value="${satuan}" id="satuan_${satuan}" id="satuan">
                            </td>
                            <td class="text-center qty">
                                ${qty}
                                <input type="hidden" class="form-control" name="qty[]" value="${qty}" id="qty_${qty}" id="qty">
                            </td>
                            <td class="text-center">
                                ${formatRupiah(harga)}
                                <input type="hidden" class="form-control" name="harga[]" value="${harga}" id="harga_${harga}" id="harga">
                            </td>
                            <td class="text-center">
                                ${formatRupiah(qty * harga)}
                            </td>
                            <td class="text-center">
                                <button class="btn btn-xs btn-danger hapus"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    `;

                    $('.bahan-ajax').append(nilai);
                }
            }

            // Event listener untuk tampilkan modal
            $('#itemModal').on('shown.bs.modal', function(e) {
            });

            // Function untuk mendapatkan data berdasarkan tanggal
            function getDataByDateRange() {
                var start_date = $('#start_date_modal').val();
                var end_date = $('#end_date_modal').val();

                $.ajax({
                    type: 'GET',
                    url: '/get-data-by-date',
                    data: {
                        start_date: start_date,
                        end_date: end_date
                    },
                    success: function(response) {
                        // Proses data yang diterima
                        var filteredData = response.filteredData;
                        // Tampilkan data ke console untuk debugging
                        // console.log(filteredData);
                        // Hapus data yang sudah ada di tabel
                        $(".bahan-ajax").empty();
                        // Iterasi melalui setiap baris data dan tambahkan ke tabel
                        $.each(filteredData, function(index, item) {
                            var nilai = `
                                <tr>
                                    <td class="text-center">
                                        ${item.barang.code_barang}
                                        <input type="hidden" class="form-control" name="code_barang[]" value="${item.barang.code_barang}" id="code_barang_${item.barang.code_barang}" id="code_barang">
                                    </td>
                                    <td class="text-center">
                                        ${item.barang.nama_barang}
                                        <input type="hidden" class="form-control" name="barang_id[]" value="${item.barang.id}" id="barang_id_${item.barang.id}">
                                        <input type="hidden" class="form-control" name="nama_barang[]" value="${item.barang.nama_barang}" id="nama_barang_${item.barang.nama_barang}" id="code_barang">
                                    </td>
                                    <td class="text-center">
                                        ${item.barang.satuan.satuan}
                                        <input type="hidden" class="form-control" name="satuan[]" value="${item.barang.satuan.satuan}" id="satuan_${item.barang.satuan.satuan}" id="satuan">
                                    </td>
                                    <td class="text-center">
                                        ${item.qty}
                                        <input type="hidden" class="form-control" name="qty[]" value="${item.qty}" id="qty_${item.qty}" id="qty">
                                    </td>
                                    <td class="text-center">
                                        ${formatRupiah(item.barang.harga)}
                                        <input type="hidden" class="form-control" name="harga[]" value="${item.barang.harga}" id="harga_${item.barang.harga}" id="code_barang">
                                    </td>
                                    <td class="text-center">
                                        ${formatRupiah(item.qty * item.barang.harga)}
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-xs btn-danger hapus"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            `;
                            $('.bahan-ajax').append(nilai);
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

            // Event listener untuk tombol filter
            $('#filter_btn_modal').click(function() {
                getDataByDateRange();
            });

            // Tombol Hapus diklik
            $(".bahan-ajax").on("click", ".hapus-button", function() {
                $(this).closest("tr").remove();
            });

            $('body').on('click', '.hapus', function(e) {
                e.preventDefault();
                var deletedRow = $(this).closest('tr');
                deletedRow.remove();
            });

            $(document).on('submit', '#modal-form', function(e) {
                e.preventDefault();
                var data = $(this).serialize();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/store-datapengadaanbarang",
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
                                location = "{{ route('cek-datapengadaanbarang') }}";
                            }, 1500)
                        }
                    }
                });
            });
        });
    </script>

@endsection
