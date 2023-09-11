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
               'qty' => '1',
            ],
            [
                'satuan' => 'Box',
                'qty' => '24',
            ],
            [
                'satuan' => 'Pcs',
                'qty' => '1',
            ],
            [
                'satuan' => 'Kg',
                'qty' => '7',
            ],
            [
                'satuan' => 'Buah',
                'qty' => '1',
            ],
            [
                'satuan' => 'Roll',
                'qty' => '1',
            ],
            [
                'satuan' => 'Set',
                'qty' => '12',
            ],
            [
                'satuan' => 'Botol',
                'qty' => '1',
            ],
            [
                'satuan' => 'Batang',
                'qty' => '1',
            ],
        ];

        foreach ($satuans as $key => $value) {
            Satuan::create($value);
        }
    }
}
