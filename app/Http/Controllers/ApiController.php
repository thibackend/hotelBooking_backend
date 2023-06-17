<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use App\Models\Users;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getUser()
    {
        // $users = User::all();
        // return response()->json($users);
        // $users = Users::pluck('user_name')->where('user_name',"rowena.raynor");
        // foreach ($users as $key => $value) {
        //     $user =  Users::find($value);
        // }
        $hotel_ids = Hotel::pluck('id')->all();
        $rooms = Room::where('hotel_id', $hotel_ids)->get();
        foreach ($rooms as $key => $value) {
            dd($value);
        }
        return response()->json($rooms);


    }
}
