@extends('admin.layout.main')

@section('title', 'Edit Data Pengadaan Barang - Administrator')

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
                        <form action="{{ route('update-cek-datapengadaanbarang', $datapengadaanbarang->id) }}" method="POST" id="updateForm">
                            @csrf
                            @method('PUT')
                            <table>
                                <tr>
                                    <td width="200">Kode Pengajuan</td>
                                    <td width="50">:</td>
                                    <td>{{ $datapengadaanbarang->kode_transaksi }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Pengajuan</td>
                                    <td>:</td>
                                    <td>{{ date('d-m-Y', strtotime($datapengadaanbarang->tgl_transaksi)) }}</td>
                                </tr>
                                <tr>
                                    <td>Unit</td>
                                    <td>:</td>
                                    <td>{{ $datapengadaanbarang->user->unit->nama_unit }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Penerima</td>
                                    <td>:</td>
                                    <td>{{ $datapengadaanbarang->user->name }}</td>
                                </tr>
                                <tr>
                                    <td>Menyerahkan</td>
                                    <td>:</td>
                                    <td>{{ $datapengadaanbarang->yang_menyerahkan }}</td>
                                </tr>
                            </table>

                            <br><br>

                            <table class="table table-bordered">
                                <tr>
                                    <th class="text-center" width="5">No.</th>
                                    <th class="text-center">Nama Barang</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Kondisi Barang</th>
                                </tr>
                                @php $no = 1 @endphp
                                @forelse ($itemDatapengadaanbarang as $item)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td>{{ $item->barang->nama_barang }}</td>
                                    <td class="text-center">{{ $item->qty }}</td>
                                    <td class="text-center">
                                        <select name="kondisi_barang[]" id="kondisi_barang" class="form-control">
                                            <option>--Pilih Kondisi--</option>
                                            <option value="1" {{ '1' == $item->kondisi_barang ? 'selected' : '' }}>
                                                Baik</option>
                                            <option value="2" {{ '2' == $item->kondisi_barang ? 'selected' : '' }}>
                                                Baru</option>
                                            <option value="3" {{ '3' == $item->kondisi_barang ? 'selected' : '' }}>
                                                Bekas</option>
                                        </select>
                                    </td>
                                </tr>
                                @empty
                                <tr>Kosong.</tr>
                                @endforelse
                            </table>
                            <br><br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-sm btn-flat" id="updateData">Update</button>
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
@endsection

@section('js')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('updateForm').addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data akan diubah!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Update!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Lanjutkan dengan mengirim formulir menggunakan Ajax
                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        success: function(response) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            setTimeout(function() {
                                window.location.href = "{{ route('cek-datapengadaanbarang') }}";
                            }, 1500);
                        },
                        error: function(error) {
                            console.log(error);
                            Swal.fire(
                                'Error!',
                                'Data gagal diupdate.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>

@endsection