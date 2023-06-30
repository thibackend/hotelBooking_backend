<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Users;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 5; $i++) {
            Users::create([
                'name' => $faker->userName(),
                'email' => $faker->unique()->safeEmail(),
                'password' => bcrypt('password'),
                'address' => $faker->address(),
                'image' => $faker->imageUrl(),
                'phone' => $faker->phoneNumber(),
            ]);
        }
    }
}
