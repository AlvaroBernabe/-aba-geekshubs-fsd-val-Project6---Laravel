<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {


            $this->call([
                RoleSeeder::class,
                UserSeeder::class,
                GameSeeder::class,
                PartySeeder::class,
            ]);
            \App\Models\User::factory(10)->create();
            \App\Models\Message::factory(50)->create();
        }
}
