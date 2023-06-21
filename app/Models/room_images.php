<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class room_images extends Model
{
    use HasFactory;
    protected $room_image = "room_images";

    public function Room() {
        return $this->belongsTo(Room::class);
    }
}
