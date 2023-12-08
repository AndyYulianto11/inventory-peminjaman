@extends('admin.layout.main')

@section('title', 'Edit Transaksi Pengadaan Barang - Administrator')

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
                        <form id="modal-form" class="ajax-form" method="post" action="{{ route('update-cek-datapengadaanbarang', $datapengadaanbarang->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="kode_transaksi" class="col-sm-2 col-form-label">Kode Transaksi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kode_transaksi" name="kode_transaksi" value="{{ $datapengadaanbarang->kode_transaksi }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_transaksi" class="col-sm-2 col-form-label">Nama Transaksi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_transaksi" name="nama_transaksi" value="{{ $datapengadaanbarang->nama_transaksi }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tgl_transaksi" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($datapengadaanbarang->tgl_transaksi)->format('d-m-Y') }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user" class="col-sm-2 col-form-label">Admin</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="user" name="user" value="{{ $datapengadaanbarang->user->name }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="unit" class="col-sm-2 col-form-label">Unit</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="unit" name="unit" value="{{ $datapengadaanbarang->user->unit->kode_unit }} / {{ $datapengadaanbarang->user->unit->nama_unit }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status_transaksi" class="col-sm-2 col-form-label">Status Transaksi</label>
                                <div class="col-sm-10">
                                    <select id="status_transaksi" name="status_transaksi" class="form-control select2">
                                        <option value="0" {{ $datapengadaanbarang->status_transaksi == 0 ? 'selected' : '' }}>Diajukan</option>
                                        <option value="1" {{ $datapengadaanbarang->status_transaksi == 1 ? 'selected' : '' }}>Draft</option>
                                        <option value="2" {{ $datapengadaanbarang->status_transaksi == 2 ? 'selected' : '' }}>Disetujui</option>
                                        <option value="3" {{ $datapengadaanbarang->status_transaksi == 3 ? 'selected' : '' }}>Direvisi</option>
                                        <option value="4" {{ $datapengadaanbarang->status_transaksi == 4 ? 'selected' : '' }}>Ditolak</option>
                                        <option value="5" {{ $datapengadaanbarang->status_transaksi == 5 ? 'selected' : '' }}>Dipending</option>
                                    </select>
                                </div>
                            </div>

                            <hr>
                            <div class="text-right mb-3">
                                <button type="button" class="btn btn-info" data-toggle="modal" id="btn-data-item" 
                                        data-target="#itemModal">Data Item</button>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dateFilterModal">Generate Data</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th width="5">No.</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Satuan</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bahan-ajax">
                                        @php $no = 1 @endphp
                                        @forelse ($itemDatapengadaanbarang as $item)
                                        <tr data-id="{{ $item->barang_id }}">
                                            <td class="text-center no-urut">{{ $no++ }}</td>
                                            <td class="text-center">{{ $item->code_barang }}</td>
                                            <td class="text-center">{{ $item->nama_barang }}</td>
                                            <td class="text-center">{{ $item->satuan }}</td>
                                            <td class="text-center">{{ $item->qty }}</td>
                                            <td class="text-right">Rp. {{ number_format($item->harga) }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-xs btn-danger hapus" data-item-id="{{ $item->id }}"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>Kosong.</tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-group">
                                <button type="button" class="btn btn-primary btn-sm btn-flat btn-update">Update</button>
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
                <div class="modal-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Satuan</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                                <!-- Tambahkan kolom lain sesuai kebutuhan -->
                            </tr>
                        </thead>
                        <tbody id="itemDataBody">
                            <!-- Data akan ditampilkan di sini -->
                        </tbody>
                    </table>
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

<!-- Select2 -->
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $(".btn-update").on("click", function() {
            // e.preventDefault()
            var formData = new FormData($('#modal-form')[0]);
            console.log(formData)
            // Add your existing AJAX request for the form submission
            $.ajax({
                type: 'POST',
                url: '{{ route("update-cek-datapengadaanbarang", $datapengadaanbarang->id) }}',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // console.log(response);
                    Swal.fire({
                        title: 'Success!',
                        text: 'Transaksi Pengadaan berhasil diupdate',
                        icon: 'success'
                    }).then(() => {
                        window.location.href = "{{ route('cek-datapengadaanbarang') }}";
                    });
                },
                error: function(err) {
                    // Handle error response, e.g., show an error message
                    console.log(err);
                    alert('Error submitting form!');
                }
            });
        });
        // Event listener for the "Delete" button
        $(".table").on("click", ".hapus", function(event) {
            event.preventDefault();
            var itemId = $(this).data('item-id');

            // Show a confirmation dialog using SweetAlert
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data item akan dihapus.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send an AJAX request to delete the item
                    $.ajax({
                        type: 'POST',
                        url: '/delete-item/' + itemId,
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            // Check if the deletion was successful
                            if (response.success) {
                                // Fade out and remove the item row from the table
                                $('#item_row_' + itemId).fadeOut(400, function() {
                                    $(this).remove();
                                });

                                // Show a success message using SweetAlert
                                Swal.fire('Terhapus!', 'Data item telah dihapus.', 'success')
                                    .then(() => {
                                        // Reload or refresh the page
                                        location.reload();
                                    });
                            } else {
                                // Show an error message using SweetAlert
                                Swal.fire('Gagal!', 'Data item gagal dihapus.', 'error');
                            }
                        },
                        error: function(err) {
                            // Show an error message using SweetAlert
                            Swal.fire('Error!', 'Terjadi kesalahan saat menghapus data.', 'error');
                        }
                    });
                }
            });
        });

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
        function getItemData() {
            $.ajax({
                type: 'GET',
                url: '{{ route('get-item-data') }}',
                success: function(response) {
                    // Hapus data lama sebelum menambahkan yang baru
                    $('#itemDataBody').empty();

                    var nomorUrut = 1;

                    $.each(response.item_data, function(index, item) {
                        var row = $('<tr class="text-center"></tr>');

                        row.append('<td>' + nomorUrut + '</td>');
                        row.append('<td>' + item.barang.code_barang + '</td>');
                        row.append('<td>' + item.barang.nama_barang + '</td>');
                        row.append('<td>' + item.barang.satuan.satuan + '</td>');
                        row.append('<td>' + item.qty + '</td>');
                        row.append('<td>' + item.barang.harga + '</td>');

                        var addButton = $(
                            '<button class="btn btn-success btn-sm"><i class="fas fa-plus-square"></i></button>'
                        );

                        addButton.click(function() {
                            var code_barang = $(this).closest('tr').find('td:eq(1)').text();
                            var nama_barang = $(this).closest('tr').find('td:eq(2)').text();
                            var satuan = $(this).closest('tr').find('td:eq(3)').text();
                            var qty = $(this).closest('tr').find('td:eq(4)').text();
                            var harga = $(this).closest('tr').find('td:eq(5)').text();
                            var id = item.barang.id;

                            console.log(id);

                            tambahDataKeTabel(code_barang, nama_barang, satuan, qty, harga, id);
                        });

                        row.append($('<td></td>').append(addButton));

                        $('#itemDataBody').append(row);
                        nomorUrut++;
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
        function tambahDataKeTabel(code_barang, nama_barang, satuan, qty, harga, id) {
            var existingRow = $('.bahan-ajax').find('tr[data-barangid="' + id + '"]');
            let lastUrut = $('.bahan-ajax').find('tr').last().find('.no-urut')
            // console.log(lastUrut.text())

            if (existingRow.length > 0) {
                alert("Data sudah ditambahkan");
            } else {
                let urut = 1;
                if(lastUrut.length){
                    urut = parseInt(lastUrut.text())+1
                }
                var nilai = `
                    <tr data-barangid="${id}" class="new">
                        <td class="text-center no-urut">
                            ${urut}
                        </td>
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
                        <td class="text-right">
                            ${formatRupiah(harga)}
                            <input type="hidden" class="form-control" name="harga[]" value="${harga}" id="harga_${harga}" id="harga">
                        </td>
                        
                        <td class="text-center">
                            <button class="btn btn-xs btn-danger hapus-button"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                `;

                $('.bahan-ajax').append(nilai);
            }
        }
        $(".bahan-ajax").on("click", ".hapus-button", function() {
            $(this).closest("tr").remove();
        });


        $('#itemModal').on('shown.bs.modal', function(e) {
            getItemData();

        });
        $('#btn-data-item').on('click', function(){
            getItemData();            
        })
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
                    let lastUrut = $('.bahan-ajax').find('tr').last().find('.no-urut')
                    let urut = 1;
                    if(lastUrut.length){
                        urut = parseInt(lastUrut.text())+1
                    }

                    // Hapus data yang sudah ada di tabel
                    // $(".bahan-ajax").find('tr.new').remove();

                    // Iterasi melalui setiap baris data dan tambahkan ke tabel
                    $.each(filteredData, function(index, item) {
                        console.log(item.barang)
                        let barangExist = $('.bahan-ajax').find('tr[data-barangid="' + item.barang.id + '"]');
                        if(barangExist.length == 0){
                            var nilai = `
                                <tr data-barangid="${item.barang.id}" class="new">
                                    <td class="text-center no-urut">
                                        ${urut}
                                    </td>
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
                                    <td class="text-right">
                                        ${formatRupiah(item.barang.harga)}
                                        <input type="hidden" class="form-control" name="harga[]" value="${item.barang.harga}" id="harga_${item.barang.harga}" id="code_barang">
                                    </td>
                                    
                                    <td class="text-center">
                                        <button class="btn btn-xs btn-danger hapus-button"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            `;
                            urut++;

                            $('.bahan-ajax').append(nilai);

                        }
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
        // Event listener for the "Delete" button
        // Update the AJAX URL in your JavaScript
        // $(document).ready(function() {

        // });

    });
</script>

@endsection