<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class RoomService extends Model
{
    use HasFactory;
    protected $table = 'rooms_services';

    protected $fillable = [
        "room_id",
        "service_id"
    ];

    public function Rooms()
    {
        return $this->belongsTo(Room::class);
    }

    public function Services()
    {
        return $this->belongsTo(Services::class);
    }
}
