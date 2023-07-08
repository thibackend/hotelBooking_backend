<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    protected $services = 'services';
    protected $fillable= [
        "name",
        "price"
    ];
    
    public function Rooms() {
        return $this->hasMany(RoomService::class);
    }
}
