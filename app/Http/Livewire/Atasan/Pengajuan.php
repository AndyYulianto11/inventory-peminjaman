<?php

namespace App\Http\Livewire\Atasan;

use Livewire\Component;
use App\Models\DataPengaju;

class Pengajuan extends Component
{
    public function render()
    {
        $pengaju = Datapengaju::where('status_setujuatasan', '1')->paginate(10);
        return view('livewire.atasan.pengajuan', compact('pengaju'));
    }
}
