<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $bookings = 'bookings';
    protected $fillable = [
        "user_id",
        "room_id",
        "booking_date",
        "checkin_date",
        "checkout_date"
    ];

    public function Bills() {
        return $this->hasOne(Bills::class);
    }
}
