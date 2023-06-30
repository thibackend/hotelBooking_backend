<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Users;
use App\Models\Booking;

class BookingSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $userIds = Users::pluck('id')->all();

        // Tạo dữ liệu giả cho 100 đặt phòng
        for ($i = 0; $i < 10; $i++) {
            $roomId = $faker->randomElement(Room::pluck('id')->all());
            $userId = $faker->randomElement($userIds);
            $bookingDate = $faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d');
            $checkOutDate = Carbon::parse($bookingDate)->addDays($faker->numberBetween(1, 7))->format('Y-m-d');

            Booking::create([
                'room_id' => $roomId,
                'user_id' => $userId,
                'booking_date' => $bookingDate,
                'checkin_date' => $bookingDate,
                'checkout_date' => $checkOutDate,
            ]);
        }
    }
}