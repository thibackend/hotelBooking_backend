<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\room_images;
use App\Models\Hotel;
use Faker\Factory as Faker;

class RoomImageSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Lấy danh sách rooms và hotels
        $rooms = Room::pluck('id')->all();
        // Tạo dữ liệu giả cho 50 hình ảnh phòng
        for ($i = 0; $i < 50; $i++) {
            room_images::create([
                'image_path' => $faker->imageUrl(),
                'desc' => $faker->paragraph(1,true),
                'room_id' => $faker->randomElement($rooms),
            ]);
        }
    }
}