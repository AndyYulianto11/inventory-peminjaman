<?php

namespace Database\Seeders;

use App\Models\Databarang;
use App\Models\HistoryStokBarang;
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
                'id' => 1,
                'code_barang' => 10001,
                'nama_barang' => 'Kursi',
                'jenis_id' => 3,
                'stok' => 12,
                'satuan_id' => 1
            ]
        ];

        foreach ($databarang as $key => $value) {
            Databarang::create($value);

            HistoryStokBarang::create([
                'id' => 1,
                'databarang_id' => 1,
                'qty' => 12,
                'keterangan' => 'Insert Data Barang',
            ]);
        }
    }
}
