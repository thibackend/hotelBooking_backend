<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Room;
use App\Models\Services;
use Illuminate\Support\Facades\DB;

class RoomServiceSeede extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get all room and service IDs
        $roomIds = Room::pluck('id')->all();
        $serviceIds = Services::pluck('id')->all();
        print_r($serviceIds);

        // Generate fake data for the rooms_services table
        foreach (range(1, 50) as $index) {
            DB::table('rooms_services')->insert([
                'room_id' => $faker->randomElement($roomIds),
                'service_id' => $faker->randomElement($serviceIds),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
