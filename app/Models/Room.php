<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $rooms = 'rooms';
    protected $fillable = [
        'category_id',
        'price',
        'name',
        'desc',
        'star',
        'status',
    ];
    public function Image()
    {
        return $this->hasMany(room_images::class);
    }
    public function categories()
    {
        return $this->belongsTo(categories::class);
    }
    public $timestamps = true;
}
