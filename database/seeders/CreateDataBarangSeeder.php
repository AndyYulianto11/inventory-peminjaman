<?php

namespace Database\Seeders;

use App\Models\Databarang;
use Illuminate\Database\Seeder;

class CreateDataBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $databarang = [
            [
                'code_barang' => 10001, 
                'nama_barang' => 'Kursi', 
                'jenis_id' => 3, 
                'stok' => 12,
                'satuan_id' => 1
            ]
        ];

        foreach ($databarang as $key => $value) {
            Databarang::create($value);
        }
    }
}
