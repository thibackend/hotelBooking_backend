<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hotel;
use Faker\Factory as Faker;
class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Tạo dữ liệu giả cho 50 khách sạn
        for ($i = 0; $i <5; $i++) {
            Hotel::create([
                'name' => $faker->company(),
                'address' => $faker->address(),
                'contact' => $faker->phoneNumber(),
                'desc' => $faker->paragraph(),
                'star' => $faker->numberBetween(1, 5),
                'status' => $faker->boolean(),
            ]);
        }
    }
}
