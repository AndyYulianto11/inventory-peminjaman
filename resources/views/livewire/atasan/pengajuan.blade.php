<div class="card-body" wire:poll>
    <table class="table table-bordered table-striped">
        <thead>
            <tr class="text-center">
                <th width="50px">No</th>
                <th>Kode <br> Pengajuan</th>
                <th>Nama Pengaju</th>
                <th>Tanggal</th>
                <th>Unit</th>
                <th>Status Atasan</th>
                <th>Status Admin</th>
                <th>File</th>
                <th width="100px">Aksi</th>
            </tr>
        </thead>
        <tbody id="add_new">
            @php $no = 1 @endphp
            @forelse ($pengaju as $item)
                <tr class="text-center" id="data{{ $item->id }}">
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->code_pengajuan }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ date('d-m-Y', strtotime($item->tgl_pengajuan)) }}</td>
                    <td>{{ $item->user->unit->nama_unit }}</td>
                    <td>
                        @if ($item->status_setujuatasan == 1)
                            <span class="badge bg-info">Diajukan</span>
                        @elseif($item->status_setujuatasan == 2)
                            <span class="badge bg-secondary">Diproses</span>
                        @elseif($item->status_setujuatasan == 3)
                            <span class="badge bg-success">Disetujui</span>
                        @elseif($item->status_setujuatasan == 4)
                            <span class="badge bg-danger">Ditolak</span>
                        @elseif($item->status_setujuatasan == 5)
                            <span class="badge bg-warning">Direvisi</span>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($item->status_setujuadmin == 0)
                            <span class="badge bg-info">Diajukan</span>
                        @elseif($item->status_setujuadmin == 1)
                            <span class="badge bg-secondary">Proses</span>
                        @elseif($item->status_setujuadmin == 2)
                            <span class="badge bg-warning">Pending</span>
                        @elseif($item->status_setujuadmin == 3)
                            <span class="badge bg-success">Selesai</span>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($item->upload_dokumen != null)
                        <a href="{{ route('lihat-file', $item->id) }}" target="_blank"><span class="badge bg-info">Lihat
                                File</span></a>
                        @elseif($item->upload_dokumen == null)
                        -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('detail-data-pengaju', $item->id) }}"
                            class="btn btn-primary btn-sm btn-flat">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <div class="alert alert-danger">
                    Data Pengajuan Barang belum Tersedia.
                </div>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex mt-3 float-right">
        {{ $pengaju->links() }}
    </div>
</div>
