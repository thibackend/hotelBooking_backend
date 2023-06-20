<?php

namespace App\Http\Controllers\hotel_booking_api;

use App\Http\Controllers\Controller;
use App\Models\accounts;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function Login(Request $request)
    {
        $email = $request->email;
        if (!$email) {
            return response()->json("have no email");
        }
        $acc = accounts::where('email', $email)->take(1)->pluck("id")->all();
        if ($acc) {
            $account = accounts::find($acc[0]);
            return response()->json(["status"=>true,'account'=>$account]);
        } else {
            return response()->json(["status"=>false,"msg"=>"email khong ton tai",'account'=>null]);
        }
    }
}
