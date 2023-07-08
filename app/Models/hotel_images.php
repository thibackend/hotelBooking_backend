<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hotel_images extends Model
{
    use HasFactory;
    protected $hotel_images = 'hotel_images';
    protected $fillable =[
        "image_path",
        "desc"
    ];
}
