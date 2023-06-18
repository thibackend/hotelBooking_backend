<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\Role;
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
        $roles = Role::pluck('id')->all();
        $hotels = Hotel::pluck('id')->all();
        for ($i = 0; $i < 5; $i++) {
            Users::create([
                'role_id' => $faker->randomElement($roles),
                'hotel_id' => $faker->randomElement($hotels),
                'user_name' => $faker->userName(),
                'email' => $faker->unique()->safeEmail(),
                'password' => bcrypt('password'),
                'age' => $faker->numberBetween(18, 60),
                'address' => $faker->address(),
                'image' => $faker->imageUrl(),
                'phone' => $faker->phoneNumber(),
            ]);
        }
    }
}
