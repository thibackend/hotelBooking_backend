<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\categories;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $categories = [
            'Phòng Đơn',
            'Phòng Đôi',
            'Phòng Hai Giường Đơn',
            'Phòng Gia Đình',
            'Phòng Hội Nghị',
            'Phòng Luxury',
            'Phòng Cao Cấp',
            'Phòng Suite',
            'Phòng Penthouse',
            'Phòng Bungalow',
        ];

        // Lặp qua danh sách và tạo dữ liệu giả cho mỗi danh mục
        if ($categories) :
            foreach ($categories as $category) {
                categories::create([
                    'name' => $category,
                ]);
            }
        endif;
    }
}
