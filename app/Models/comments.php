<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    use HasFactory;
    protected $comments = 'comments';
    protected $fillable = [
        "content",
        "room_id",
        "user_id"
    ];

}
