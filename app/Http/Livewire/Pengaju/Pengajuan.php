<?php

namespace App\Http\Livewire\Pengaju;

use Livewire\Component;
use App\Models\DataPengaju;

class Pengajuan extends Component
{
    public function render()
    {
        $user = auth()->user();
        $datapengaju = Datapengaju::select("*")->orderBy('created_at', 'DESC')
                                    ->where('user_id', $user->id)->paginate(10);
        return view('livewire.pengaju.pengajuan', compact('datapengaju'));
    }
}
