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
<<<<<<< HEAD
        $user_ids = Users::pluck('id')->all();
        // Tạo dữ liệu giả cho 100 bookings
        $hotel_ids = Hotel::pluck('id')->all();
        for ($i = 0; $i < 2; $i++) {
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
=======
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
>>>>>>> a8c542b0c0e90fe69db12da9146fd5b71acacdb4
        }
    }
}