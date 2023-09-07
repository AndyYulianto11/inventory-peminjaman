<?php

namespace Database\Seeders;

use App\Models\Satuan;
use Illuminate\Database\Seeder;

class CreateSatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $satuans = [
            [
               'satuan' => 'Unit',
            ],
            [
                'satuan' => 'Box',
            ],
        ];

        foreach ($satuans as $key => $value) {
            Satuan::create($value);
        }
    }
}
