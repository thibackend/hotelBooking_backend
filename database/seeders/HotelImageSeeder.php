<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\hotel_images;
use App\Models\Hotel;
use Faker\Factory as Faker;

class HotelImageSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Lấy danh sách hotels
        $hotels = Hotel::pluck('id')->all();

        // Tạo dữ liệu giả cho 50 hình ảnh khách sạn
        for ($i = 0; $i <25; $i++) {
            hotel_images::create([
                'image' => $faker->imageUrl(),
                'hotel_id' => $faker->randomElement($hotels),
            ]);
        }
    }
}
