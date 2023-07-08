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
<<<<<<< HEAD
        echo "this is api";
=======
        return response()->json(["msg"=>"api url not found"],404);
>>>>>>> 2e0ad2cdeb8434c941efdf90cb9632c2f03a7907
    }
}
