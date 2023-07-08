<?php

namespace App\Http\Controllers\hotel_booking_api;

use App\Http\Controllers\Controller;
use App\Models\room_images;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class RoomImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $image = room_images::all();
        return response()->json($image);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'image_path' => 'required|string',
            'desc' => 'required|string',
        ]);

        $roomImage = room_images::create([
            'room_id' => $request->room_id,
            'image_path' => $request->image_path,
            'desc' => $request->desc,
        ]);

        return response()->json($roomImage, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       // Retrieve a specific room image by ID
       $roomImage = room_images::findOrFail($id);

       return response()->json($roomImage);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate and update a specific room image by ID
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'image_path' => 'required|string',
            'desc' => 'required|string',
        ]);

        $roomImage = room_images::findOrFail($id);
        $roomImage->update([
            'room_id' => $request->room_id,
            'image_path' => $request->image_path,
            'desc' => $request->desc,
        ]);

        return response()->json($roomImage);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       // Delete a specific room image by ID
       $roomImage = room_images::findOrFail($id);
       $roomImage->delete();

       return response()->json(['message' => 'Room image deleted successfully']);
    }
}
