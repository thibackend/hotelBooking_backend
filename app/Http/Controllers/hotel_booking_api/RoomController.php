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
    public function store(Request $request)
    {
        $room = new Room();
        $room->type_room_id = $request->input("type_room_id");
        $room->hotel_id = $request->input("hotel_id");
        $room->name = $request->input("name");
        $room->price = $request->input("price");
        $room->desc = $request->input("desc");
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
        $room->name = $request->input("name");
        $room->price = $request->input("price");
        $room->desc = $request->input("desc");
        $room->status = $request->input("status");
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
