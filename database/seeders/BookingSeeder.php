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
        $user_ids = Users::pluck('id')->all();
        // Tạo dữ liệu giả cho 100 bookings
        $hotel_ids = Hotel::pluck('id')->all();
        for ($i = 0; $i < 10; $i++) {
            $hotel_id = $faker->randomElement($hotel_ids);
            $rooms = Room::where('hotel_id', $hotel_id)->pluck('id')->all();
            $take = count($rooms);
            if ($take >= 3) :
                $rooms = Room::where('hotel_id', $hotel_ids)->take(3)->pluck('id')->all();
            endif;
            foreach ($rooms as $key => $value) {
                $user_id = $faker->randomElement($user_ids);
                $booking_date = $faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d');
                $check_out_date = Carbon::parse($booking_date)->addDays($faker->numberBetween(1, 7))->format('Y-m-d');
                Booking::create([
                    'hotel_id' => $hotel_id,
                    'room_id' => $value,
                    'user_id' => $user_id,
                    'booking_date' => $booking_date,
                    'check_out_date' => $check_out_date,
                ]);
            }
        }
    }
}
