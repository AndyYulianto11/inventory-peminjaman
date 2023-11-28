<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Administrator',
                'email' => 'administrator@gmail.com',
                'role' => 'administrator',
                'password' => bcrypt('123123123'),
                'unit_id' => 1,
            ],
            [
                'name' => 'Admin Gudang',
                'email' => 'admingudang@gmail.com',
                'role' => 'admingudang',
                'password' => bcrypt('123123123'),
                'unit_id' => 1,
            ],
            [
                'name' => 'Kepala Gudang',
                'email' => 'kepalagudang@gmail.com',
                'role' => 'kepalagudang',
                'password' => bcrypt('123123123'),
                'unit_id' => 1,
            ],
            [
                'name' => 'Pengaju',
                'email' => 'pengaju@gmail.com',
                'role' => 'pengaju',
                'password' => bcrypt('123123123'),
                'unit_id' => 1,
            ],
            [
                'name' => 'Atasan',
                'email' => 'atasan@gmail.com',
                'role' => 'atasan',
                'password' => bcrypt('123123123'),
                'unit_id' => 1,
            ],
            [
                'name' => 'Keuangan',
                'email' => 'keuangan@gmail.com',
                'role' => 'keuangan',
                'password' => bcrypt('123123123'),
                'unit_id' => 1,
            ],
            [
                'name' => 'rektor',
                'email' => 'rektor@gmail.com',
                'role' => 'rektor',
                'password' => bcrypt('123123123'),
                'unit_id' => 1,
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
