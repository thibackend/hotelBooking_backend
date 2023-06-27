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
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'name' => 'required|string',
            'desc' => 'nullable|string',
            'star' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        $room = Room::create($request->all());
        return response()->json($room, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $room = Room::findOrFail($id);
        return response()->json($room);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => 'exists:categories,id',
            'price' => 'numeric',
            'name' => 'string',
            'desc' => 'nullable|string',
            'star' => 'integer',
            'status' => 'boolean',
        ]);

        $room = Room::findOrFail($id);
        $room->update($request->all());

        return response()->json($room);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
        return response()->json(null, 204);
    }
}
