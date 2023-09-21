<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class CreateSupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $supplier = [
            [
                'nama' => 'Toko Gajah Terbang',
                'alamat' => 'Jalan Satelit Sumenep',
                'no_telp' => '085234769810',
            ],
            [
                'nama' => 'Toko Wijaya Abadi',
                'alamat' => 'Jalan Manalagi Mangga',
                'no_telp' => '087432109876',
            ]
        ];

        foreach ($supplier as $key => $value) {
            Supplier::create($value);
        }
    }
}
