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
        $hotels = Hotel::pluck('id')->all();

        // Tạo dữ liệu giả cho 50 hình ảnh phòng
        for ($i = 0; $i < 20; $i++) {
            room_images::create([
                'image' => $faker->imageUrl(),
                'room_id' => $faker->randomElement($rooms),
                'hotel_id' => $faker->randomElement($hotels),
            ]);
        }
    }
}