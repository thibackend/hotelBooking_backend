<?php

namespace App\Http\Controllers\hotel_booking_api;

use App\Http\Controllers\Controller;
use App\Models\accounts;
use App\Models\Hotel;
use App\Models\Users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Users::all();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $account = new accounts();
        $users = new Users();
        $users->role_id =$request->input("role_id");
        $users->hotel_id =$request->input("hotel_id");
        $users->user_name =$request->input("user_name");
        $users->email =$request->input("email");
        $users->password =bcrypt($request->input("password"));
        $users->age =$request->input("age");
        $users->address =$request->input("address");
        $users->image =$request->input("image");
        $users->phone =$request->input("phone");
        $users ->save();
        
        $user_id = Users::where("user_name",$request->user_name)->pluck('id')->take(1)->all();
        // we insert account table here.
        $account->user_id =$user_id[0];
        $account->user_name =$request->user_name;
        $account->email =$request->email;
        $account->password =bcrypt($request->password);
        $account->save();
        if($users->save()) return response()->json(["mes"=>"successful","data"=>$users,"account"=>$account]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = Users::find($id);
        return response()->json($users);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $users = Users::find($id);
        $users->role_id =$request->input("role_id");
        $users->hotel_id =$request->input("hotel_id");
        $users->user_name =$request->input("user_name");
        $users->email =$request->input("email");
        $users->password =bcrypt($request->input("password"));
        $users->age =$request->input("age");
        $users->address =$request->input("address");
        $users->image =$request->input("image");
        $users->phone =$request->input("phone");
        $users ->save();
        return response()->json(["msg"=>"update Successful"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = Users::find($id);
        $users ->delete();
        return response()->json(["msg"=>"Delete successful",$users]);
    }
}

