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
                <th width="120px">Aksi</th>
            </tr>
        </thead>
        <tbody>
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
                    <a href="{{ route('lihat-berkas', $item->id) }}" target="_blank"><span class="badge bg-info">Lihat
                            File</span></a>
                </td>
                <td>
                    <a href="{{ route('show-pengaju', $item->id) }}" class="btn btn-primary btn-sm btn-flat">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('edit-cek-pengaju', $item->id) }}" class="btn btn-warning btn-sm btn-flat">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <button class="btn btn-danger btn-sm btn-flat btnDelete">
                        <i class="fas fa-trash"></i>
                    </button>
                    <button class="btn btn-info btn-sm btn-flat insertData" data-id="{{ $item->id }}" title="Proses Data">
                        <i class="fas fa-share"></i>
                    </button>
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
