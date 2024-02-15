<?php

namespace App\Http\Livewire\Chart;

use Livewire\Component;
use App\Models\ItemBarangMasuk;

class Report extends Component
{
    public function render()
    {
        $barang = ItemBarangMasuk::all();

        return view('livewire.chart.report', compact('barang'));
    }
}
