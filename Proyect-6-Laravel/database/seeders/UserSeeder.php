<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'id' => 1,
                    'name' => "Alyna",
                    'surname' => "Nastas",
                    'nickname' => "superalyna",
                    'phone_number' => "666666666",
                    'email' => "alyna@alyna.com",
                    'password' => encrypt("123456"),
                    'direction' => "calle verdadera n.257",
                    'birth_date' => "1994-02-02",
                    'role_id' => 1,
                ],
                [
                    'id' => 2,
                    'name' => "Álvaro",
                    'surname' => "Bernabé Alonso",
                    'nickname' => "alvarito101093",
                    'phone_number' => "666555442",
                    'email' => "alvaro101093@gmail.com",
                    'password' => encrypt("123456"),
                    'direction' => "calle falsa n.257",
                    'birth_date' => "1993-10-10",
                    'role_id' => 2,
                ],
                [
                    'id' => 3,
                    'name' => "Laura",
                    'surname' => "Sanchez",
                    'nickname' => "laurita",
                    'phone_number' => "987654321",
                    'email' => "laura@laura.com",
                    'password' => encrypt("123456"),
                    'direction' => "calle auténtica n.257",
                    'birth_date' => "1994-02-02",
                    'role_id' => 2,
                ],
                [
                    'id' => 4,
                    'name' => "El Amigo Mario",
                    'surname' => "Buena Gente",
                    'nickname' => "elamigomario",
                    'phone_number' => "123456789",
                    'email' => "elamigomario@gmail.com",
                    'password' => encrypt("123456"),
                    'direction' => "calle casi auténtica n.257",
                    'birth_date' => "1994-02-02",
                    'role_id' => 2,
                ]
            ]
        );
    }
}
