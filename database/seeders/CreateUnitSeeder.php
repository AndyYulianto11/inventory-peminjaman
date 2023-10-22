<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class CreateUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = [
            [
               'kode_unit' => '001',
               'nama_unit' => 'IT',
               'lokasi_unit' => 'Gedung Mawar',
               'status_unit' => 1,
            ],
        ];

        foreach ($units as $key => $value) {
            Unit::create($value);
        }
    }
}
