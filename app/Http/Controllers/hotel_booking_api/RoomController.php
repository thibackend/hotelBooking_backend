<?php

namespace App\Http\Controllers\hotel_booking_api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;
use PHPUnit\Event\Test\TestStubForIntersectionOfInterfacesCreated;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::all();
        foreach ($rooms as $key => $value) {
        }
        return response()->json($rooms);
    }

    public function get_room_in_a_hotel(string $hotelID)
    {

        if ($hotelID) {
            $rooms = Room::where('hotel_id', $hotelID)->get();
            $a = [] || null;
            foreach ($rooms as $key => $value) {
                $roomImages = $value->Image()->get();
                $a = $roomImages;
            }
            if ($a) {
                $rooms_and_images = [];
                foreach ($rooms as $value) {
                    $room = Room::find($value->id);
                    $imagesBelongRoomId = $room->Image()->where("room_id", $room->id)->pluck('image')->all();
                    array_push($rooms_and_images, [
                        "id" => $value->id,
                        "name" => $room->name,
                        "type_room_id" => $room->type_room_id,
                        "hotel_id" => $room->hotel_id,
                        "price" => $room->price,
                        "desc" => $room->desc,
                        "status" => $room->status,
                        "image" => $imagesBelongRoomId
                    ]);
                }
                return response()->json($rooms_and_images);
            } else {
                return response()->json(['Notfound' => " Hotel has ID:  $hotelID"]);
            }
        }
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
        return response()->json(["msg" => "Add successful", "data" => $room]);
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
        return response()->json(["msg" => "update successful", "data" => $room]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = Room::find($id);
        $room->delete();
        return response()->json(["msg" => "Delete successful", "data" => $room]);
    }
}
