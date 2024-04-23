<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_rooms')->insert([
            [
                'room_id' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'room_id' => 2,
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'room_id' => 3,
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'room_id' => 4,
                'user_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),

            ],
        ]);
    }
}
