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
               'name'=>'Administrator',
               'email'=>'administrator@gmail.com',
                'role'=>'administrator',
               'password'=> bcrypt('123123123'),
            ],
            [
               'name'=>'Admin Gudang',
               'email'=>'admingudang@gmail.com',
                'role'=>'admingudang',
               'password'=> bcrypt('123123123'),
            ],
            [
               'name'=>'Kepala Gudang',
               'email'=>'kepalagudang@gmail.com',
                'role'=>'kepalagudang',
               'password'=> bcrypt('123123123'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
