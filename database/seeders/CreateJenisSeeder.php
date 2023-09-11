<?php

namespace Database\Seeders;

use App\Models\Jenisbarang;
use Illuminate\Database\Seeder;

class CreateJenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenisbarangs = [
            [
               'jenisbarang' => 'Transportasi',
            ],
            [
                'jenisbarang' => 'Alat Berat',
            ],
            [
                'jenisbarang' => 'Kelas',
            ],
            [
                'jenisbarang' => 'Aset Staff',
            ],
            [
                'jenisbarang' => 'Alat Bersih',
            ],
            [
                'jenisbarang' => 'Elektronik',
            ],
        ];

        foreach ($jenisbarangs as $key => $value) {
            Jenisbarang::create($value);
        }
    }
}
