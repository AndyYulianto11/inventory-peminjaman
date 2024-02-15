<div class="card-body p-0" wire:poll.visible>
    <ul class="products-list product-list-in-card pl-2 pr-2">
        @foreach ($data as $row)
            <li class="item">
                <a href="javascript:void(0)" class="product-title">{{ $row->barang->nama_barang }}
                    <span class="badge @if($row->barang->jenisbarang->jenisbarang == 'Transportasi') bg-danger
                        @elseif($row->barang->jenisbarang->jenisbarang == 'Alat Berat') bg-warning
                        @elseif($row->barang->jenisbarang->jenisbarang == 'Kelas') bg-info
                        @elseif($row->barang->jenisbarang->jenisbarang == 'Aset Staff') bg-primary
                        @elseif($row->barang->jenisbarang->jenisbarang == 'Alat Bersih') bg-success
                        @else bg-secondary @endif float-right">{{ $row->qty }} {{ $row->barang->satuan->satuan }}</span></a>
                <span class="product-description">
                    {{ $row->barang->jenisbarang->jenisbarang }}
                </span>
            </li>
        @endforeach
        <!-- /.item -->
    </ul>
</div>
