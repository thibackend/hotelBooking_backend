<?php

namespace Database\Seeders;

use App\Models\categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;
use Faker\Factory as Faker;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Lấy danh sách type rooms và hotels
        $typeRooms = categories::pluck('id')->all();
        // Tạo dữ liệu giả cho 50 phòng
        for ($i = 0; $i <50; $i++) {
            Room::create([
                'category_id' => $faker->randomElement($typeRooms),
                'name' => $faker->word(),
                'price' => $faker->randomFloat(2, 50, 500),
                'star' => $faker->randomNumber(1,5),
                'desc' => $faker->paragraph(),
                'status' => $faker->boolean(),
            ]);
        }
    }
}
