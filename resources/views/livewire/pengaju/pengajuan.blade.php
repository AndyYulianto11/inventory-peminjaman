<div class="card-body" wire:poll>
    <table class="table table-bordered table-striped">
        <thead>
            <tr class="text-center">
                <th width="50px">No</th>
                <th>Kode <br> Pengajuan</th>
                <th width="150px">Tanggal</th>
                <th>Qty</th>
                <th>Status Atasan</th>
                <th>Status Admin</th>
                <th>File</th>
                <th width="150px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1 @endphp
            @forelse ($datapengaju as $item)
            <tr class="text-center" id="data{{ $item->id }}">
                <td>{{ $no++ }}</td>
                <td>{{ $item->code_pengajuan }}</td>
                <td>{{ date('d-m-Y', strtotime($item->tgl_pengajuan)) }}</td>
                <td>
                    @if ($item->count() > 0)
                    {{ $item->count() }}
                    @else
                    0
                    @endif
                </td>
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
                    <a href="{{ route('lihat-dokumen', $item->id) }}" target="_blank"><span class="badge bg-info">Lihat
                            File</span></a>
                    @elseif($item->upload_dokumen == null)
                    -
                    @endif
                </td>
                <td class="text-center">
                    <a href="{{ route('lihat-data-pengaju', $item->id) }}" class="btn btn-primary btn-sm btn-flat">
                        <i class="fas fa-eye"></i>
                    </a>
                    @if ($item->status_pengajuan == 1 && $item->upload_dokumen == null && $item->status_setujuatasan == 5)
                    <a href="{{ route('edit-datapengaju', $item->id) }}" class="btn btn-warning btn-sm btn-flat">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    @endif
                    @if ($item->status_setujuatasan == 3 && $item->upload_dokumen == null)
                    <a href="{{ route('upload', $item->id) }}" class="btn btn-success btn-sm btn-flat">
                        <i class="fas fa-arrow-up"></i>
                    </a>
                    @endif
                    @if ($item->status_setujuatasan == 3 && $item->upload_dokumen != null && $item->status_submit == '0')
                    <a class="btn btn-success btn-sm btn-flat" onclick="updateStatus({{ $item->id }})">
                        <i class="fas fa-share"></i>
                    </a>
                    @endif
                </td>
            </tr>
            @empty
            <div class="alert alert-danger">
                Data Pengaju belum Tersedia.
            </div>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex mt-3 float-right">
        {{ $datapengaju->links() }}
    </div>
</div>
