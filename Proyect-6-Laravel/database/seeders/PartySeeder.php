<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parties')->insert(
            [
                [
                    'id' => 1,
                    'name' => "Carreras",
                    'rules' => "No correr",
                    'game_id' => 4,
                ],
                [
                    'id' => 2,
                    'name' => "Mobas",
                    'rules' => "Vende tu alma antes de entrar",
                    'game_id' => 1,

                ],
                [
                    'id' => 3,
                    'name' => "Futbol",
                    'rules' => "No correr",
                    'game_id' => 5,

                ],
                [
                    'id' => 4,
                    'name' => "Complejos",
                    'rules' => "Juegos Difíciles de entender",
                    'game_id' => 7,

                ]
            ]
        );
    }
}
