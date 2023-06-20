<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\comments;
use App\Models\Hotel;
use App\Models\accounts;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $account_ids = accounts::pluck('id')->all();
        $hotel_ids = Hotel::pluck('id')->all();
        // Tạo dữ liệu giả cho 100 comments
        for ($i = 0; $i < 10; $i++) {
            comments::create([
                'comment' => $faker->paragraph(),
                'account_id' => $faker->randomElement($account_ids),
                'hotel_id' =>$faker->randomElement($hotel_ids),
            ]);
        }
    }
}
