<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\DataPengaju;

class Pengajuan extends Component
{
    public function render()
    {
        $pengaju = Datapengaju::where('status_submit', 1)->paginate(10);
        return view('livewire.pengajuan', compact('pengaju'));
    }
}
