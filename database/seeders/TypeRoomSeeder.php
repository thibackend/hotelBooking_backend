<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeRoom;
use Faker\Factory as Faker;
class TypeRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Tạo dữ liệu giả cho 10 loại phòng
        for ($i = 0; $i < 5; $i++) {
            TypeRoom::create([
                'name' => $faker->word(),
                'desc' => $faker->paragraph(1,true),
            ]);
        }
    }
}
