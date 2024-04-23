<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('messages')->insert([
            [
                'text' => 'Soy Chuso y esto es un mensaje en la sala de Fortnite',
                'room_id' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'text' => 'Soy Javi y esto es un mensaje en la sala de Valheim',
                'room_id' => 2,
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'text' => 'Soy Fran y esto es un mensaje en la sala de Minecraft',
                'room_id' => 3,
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'text' => 'Soy Paula y esto es un mensaje en la sala de Rust',
                'room_id' => 4,
                'user_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),

            ],
        ]);
    }
}
