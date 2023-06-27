<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\comments;
use App\Models\Room;
use App\Models\Users;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $user_ids  = Users::pluck('id')->all();
        $room_ids  = Room::pluck('id')->all();
        // Tạo dữ liệu giả cho 100 comments
        for ($i = 0; $i < 20; $i++) {
            comments::create([
                'content' => $faker->paragraph(3,true),
                'user_id' => $faker->randomElement($user_ids),
                'room_id' =>$faker->randomElement($room_ids),
            ]);
        }
    }
}
