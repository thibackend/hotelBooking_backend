<?php

namespace Database\Seeders;

use App\Models\hotel_images;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class HotelImageSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

       // Tạo dữ liệu giả cho các hình ảnh của khách sạn
       for ($i = 0; $i < 10; $i++) {
        hotel_images::create([
            'desc' => $faker->paragraph(1,true), // ID của khách sạn
            'image_path' => $faker->imageUrl(), // Đường dẫn hình ảnh giả
        ]);
    }
    }
}
