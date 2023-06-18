<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use App\Models\Users;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function Notfound()
    {
        return response()->json(["msg"=>"api url not found"],404);


    }
}
