<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            [
                'name' => 'Fortnite_Room',
                'description' => 'Fortnite_Room Nº1',
                'game_id' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'name' => 'Valheim_Room',
                'description' => 'Valheim_Room Nº1',
                'game_id' => 2,
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'name' => 'Minecraft_Room',
                'description' => 'Minecraft_Room Nº1',
                'game_id' => 3,
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'name' => 'Rust_Room',
                'description' => 'Rust_Room Nº1',
                'game_id' => 4,
                'user_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),

            ],
        ]);
    }
}
