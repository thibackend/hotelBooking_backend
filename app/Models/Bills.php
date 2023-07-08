<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    use HasFactory;
    protected $fillable = ['booking_id', 'services', 'room_rate', 'total_night', 'total', 'payment_method'];
    protected $cats = ['booking_id', 'services', 'room_rate', 'total_night', 'total', 'payment_method'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
