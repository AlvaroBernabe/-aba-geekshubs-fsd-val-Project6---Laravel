<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert(
            [
                [
                    'title' => "Dota 2",
                    'genre' => "MOBA",
                    'platform' => "Steam",
                ],
                [
                    'title' => "Counter Strike 2",
                    'genre' => "Shooter",
                    'platform' => "Steam",
                ],
                [
                    'title' => "The last of Us",
                    'genre' => "Action",
                    'platform' => "PS5",
                ],
                [
                    'title' => "Midtown Madness 3",
                    'genre' => "Carreras",
                    'platform' => "XBOX",
                ],
                [
                    'title' => "Pinball FX",
                    'genre' => "Complejo",
                    'platform' => "Windows XP",
                ],
                [
                    'title' => "ISSPRO 98",
                    'genre' => "Carreras",
                    'platform' => "PS1",
                ],
                [
                    'title' => "Los Sims",
                    'genre' => "Destrucción",
                    'platform' => "Pc",
                ],
            ]
        );
    }
}
