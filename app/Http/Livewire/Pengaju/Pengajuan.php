<?php

namespace App\Http\Livewire\Pengaju;

use Livewire\Component;
use App\Models\DataPengaju;
use App\Models\ItemDataPengaju;

class Pengajuan extends Component
{
    public function render()
    {
        return view('livewire.pengaju.pengajuan', compact('datapengaju'));
    }
}
