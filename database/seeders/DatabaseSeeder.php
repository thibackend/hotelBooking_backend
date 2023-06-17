<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            // Các seeder khác...
            TypeRoomSeeder::class,
            HotelSeeder::class,
            RoleSeeder::class,
            RoomSeeder::class,
            HotelImageSeeder::class,
            RoomImageSeeder::class,
            UserSeeder::class,
            AccountSeeder::class,
            CommentSeeder::class,
            BookingSeeder::class,
        ]);
    }
}
