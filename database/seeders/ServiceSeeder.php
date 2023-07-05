<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker ;
use App\Models\Services;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $services = [
            'Dịch vụ phòng',
            'Nhà hàng và quầy bar',
            'Dịch vụ đặt vé và tour du lịch',
            'Dịch vụ xe đưa đón',
            'Trung tâm thể dục và spa',
            'Internet Wi-Fi',
            'Dịch vụ giữ trẻ',
            'Dịch vụ xe đạp, xe máy',
        ];

        foreach ($services as $service) {
            Services::create([
                'name' => $service,
                'price' => $faker->numberBetween(50, 200), // You can adjust the price range as needed
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
