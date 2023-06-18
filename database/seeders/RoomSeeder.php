<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\TypeRoom;
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
        $typeRooms = TypeRoom::pluck('id')->all();
        $hotels = Hotel::pluck('id')->all();
        // Tạo dữ liệu giả cho 50 phòng
        for ($i = 0; $i <30; $i++) {
            Room::create([
                'type_room_id' => $faker->randomElement($typeRooms),
                'hotel_id' => $faker->randomElement($hotels),
                'name' => $faker->word(),
                'price' => $faker->randomFloat(2, 50, 500),
                'desc' => $faker->paragraph(),
                'status' => $faker->boolean(),
            ]);
        }
    }
}
