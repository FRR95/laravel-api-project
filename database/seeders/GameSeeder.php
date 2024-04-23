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
        DB::table('games')->insert([
            [
                'name' => 'Fortnite',
                'description' => 'Shooter battle royale',
                'url_image' => 'https://cdn2.unrealengine.com/keyart-overscan-nologo-2-2276x1280-aa06338f9aae.jpg',
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'name' => 'Valheim',
                'description' => 'Role game',
                'url_image' => 'https://cdn2.unrealengine.com/keyart-overscan-nologo-2-2276x1280-aa06338f9aae.jpg',
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'name' => 'Minecraft',
                'description' => 'Craft Game',
                'url_image' => 'https://cdn2.unrealengine.com/keyart-overscan-nologo-2-2276x1280-aa06338f9aae.jpg',
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'name' => 'Rust',
                'description' => 'Survival Game',
                'url_image' => 'https://cdn2.unrealengine.com/keyart-overscan-nologo-2-2276x1280-aa06338f9aae.jpg',
                'created_at' => now(),
                'updated_at' => now(),

            ],
        ]);
    }
}
