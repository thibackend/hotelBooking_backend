<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $rooms = 'rooms';
    
    public function Image() {
        return $this->hasMany(room_images::class);
    }

    public function Hotel() {
        return $this->belongsTo(Hotel::class);
    }
}
