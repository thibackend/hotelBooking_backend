<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $hotels = 'hotels';

    public function image()
    {
        return $this->hasMany(hotel_images::class);
    }
    public function room()
    {
        return $this->hasMany(Room::class);
    }
}
