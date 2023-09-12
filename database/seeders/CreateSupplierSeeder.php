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
                'nama' => 'Noor',
                'alamat' => 'Pacitan, Jawa Timur',
                'no_telp' => '081234567890',
            ]
        ];

        foreach ($supplier as $key => $value) {
            Supplier::create($value);
        }
    }
}
