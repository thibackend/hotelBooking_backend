<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Faker\Factory as Faker;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        // Tạo dữ liệu giả cho 5 vai trò
        for ($i = 0; $i < 5; $i++) {
            Role::create([
                'name' => $faker->word(),
                'desc' => $faker->paragraph(1,true),
            ]);
        }
    }
}
