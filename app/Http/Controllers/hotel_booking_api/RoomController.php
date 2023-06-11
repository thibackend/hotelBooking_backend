<?php

namespace App\Http\Controllers\hotel_booking_api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::all();
        return response()->json($rooms);
    }

    /**
     * Store a newly created resource in storage.
     */
    // $table->id();
    // $table->unsignedBigInteger("type_room_id");
    // $table->unsignedBigInteger("hotel_id");
    // $table->string("room_name");
    // $table->float("price", 8, 2);
    // $table->longText("room_desc");
    // $table->boolean("status");
    // $table->foreign("type_room_id")->references('id')->on("type_rooms")->onDelete('cascade');
    // $table->foreign("hotel_id")->references('id')->on("hotels")->onDelete('cascade'); 
    // $table->timestamps();
    public function store(Request $request)
    {
        $room = new Room();
        $room->type_room_id = $request->input("type_room_id");
        $room->hotel_id = $request->input("hotel_id");
        $room->room_name = $request->input("room_name");
        $room->price = $request->input("price");
        $room->room_desc = $request->input("room_desc");
        $room->status = $request->input("status");
        $room->save();
        return response()->json(["msg"=> "Add successful","data"=>$room]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $room = Room::find($id);
        return response()->json($room);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $room = Room::find($id);
        $room->type_room_id = $request->input("type_room_id");
        $room->hotel_id = $request->input("hotel_id");
        $room->room_name = $request->input("room_name");
        $room->price = $request->input("price");
        $room->room_desc = $request->input("room_desc");
        $room->save();
        return response()->json(["msg"=> "update successful","data"=>$room]);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = Room::find($id);
        $room->delete();
        return response()->json(["msg"=> "Delete successful","data"=>$room]);
    }
}
