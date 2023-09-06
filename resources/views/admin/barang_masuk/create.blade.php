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
                        <form class="form-horizontal">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Kode Nota</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail3" placeholder="Kode Nota">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="inputPassword3">
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="button" name="add" id="add_barangmasuk" class="btn btn-primary btn-flat float-right">+</button>
                            </div>

                            <table id="crud_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>Nama Barang</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody id="add_new">
                                    <tr class="text-center">
                                        <td contenteditable="true" class="nama_barang"><input type="text" size="23"></td>
                                        <td contenteditable="true" class="qty"><input type="text" size="23"></td>
                                        <td contenteditable="true" class="harga"><input type="text" size="23"></td>
                                        <td contenteditable="true" class="jumlah"><input type="text" size="23"></td>
                                    </tr>
                                </tbody>
                            </table>

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

<script>
    $(document).ready(function() {
        var count = 1;
        $('#add_barangmasuk').click(function() {
            count = count + 1;
            var html_code = "<tr id='row" + count + "'>";
            html_code += "<td contenteditable='true' class='nama_barang'></td>";
            html_code += "<td contenteditable='true' class='qty'></td>";
            html_code += "<td contenteditable='true' class='harga'></td>";
            html_code += "<td contenteditable='true' class='jumlah' ></td>";
            html_code += "</tr>";
            $('#crud_table').append(html_code);
        });
    });

    $('#save').click(function() {
        var nama_barang = [];
        var qty = [];
        var harga = [];
        var jumlah = [];

        $('.nama_barang').each(function() {
            nama_barang.push($(this).text());
        });
        $('.qty').each(function() {
            qty.push($(this).text());
        });
        $('.harga').each(function() {
            harga.push($(this).text());
        });
        $('.jumlah').each(function() {
            jumlah.push($(this).text());
        });
    })

    $.ajax({
        url: "/create-barangmasuk",
        method: "POST",
        data: {
            nama_barang: nama_barang,
            qty: qty,
            harga: harga,
            jumlah: jumlah
        },
        success: function(data) {
            alert(data);
            $("td[contentEditable='true']").text("");
            for (var i = 2; i <= count; i++) {
                $('tr#' + i + '').remove();
            }
            fetch_item_data();
        }
    });
</script>

@endsection