<?php

namespace App\Http\Livewire\Barang;

use Livewire\Component;
use App\Models\ItemBarangMasuk;

class NewItem extends Component
{
    public function render()
    {
        $data = ItemBarangMasuk::latest()->take(5)->get();
        return view('livewire.barang.new-item', compact('data'));
    }
}
