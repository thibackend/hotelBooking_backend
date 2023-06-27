<?php

namespace App\Http\Controllers\hotel_booking_api;

use App\Http\Controllers\Controller;
use App\Models\RoomService;
use Illuminate\Http\Request;

class RoomServiceControlle extends Controller
{
    public function index()
    {
        return RoomService::all();
    }

    public function store(Request $request)
    {
        $roomService = RoomService::create($request->all());
        return $roomService;
    }

    public function show($id)
    {
        $roomService = RoomService::findOrFail($id);
        return $roomService;
    }

    public function update(Request $request, $id)
    {
        $roomService = RoomService::findOrFail($id);
        $roomService->update($request->all());
        return $roomService;
    }

    public function destroy($id)
    {
        $roomService = RoomService::findOrFail($id);
        $roomService->delete();
        return response()->json(["msg"=>"delete successful : $id"], 204);
    }
}
