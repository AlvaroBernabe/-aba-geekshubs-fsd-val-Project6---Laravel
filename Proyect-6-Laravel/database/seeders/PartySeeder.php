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
                    'name' => "Carreras",
                    'rules' => "No correr",
                ],
                [
                    'name' => "Mobas",
                    'rules' => "Vende tu alma antes de entrar",
                ],
                [
                    'name' => "Futbol",
                    'rules' => "No correr",
                ],
                [
                    'name' => "Complejos",
                    'rules' => "Juegos Difíciles de entender",
                ]
            ]
        );
    }
}
