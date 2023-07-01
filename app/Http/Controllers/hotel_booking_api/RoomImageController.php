<?php

namespace App\Http\Controllers\hotel_booking_api;

use App\Http\Controllers\Controller;
use App\Models\room_images;
use Illuminate\Http\Request;

class RoomImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all room images
        $roomImages = room_images::all();

        return response()->json($roomImages);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate and create a new room image
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
            'desc' => $request->desc
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

    public function upload(Request $request) {
        $imagesName = [];
        $response = [];

        $validator = Validator::make($request->all(),
            [
                'images' => 'required',
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]
        );

        if($validator->fails()) {
            return response()->json(["status" => "failed", "message" => "Validation error", "errors" => $validator->errors()]);
        }

        if($request->has('images')) {
            foreach($request->file('images') as $image) {
                $filename = time().rand(3, 9). '.'.$image->getClientOriginalExtension();
                $image->move('public/uploads/', $filename);

                room_images::create([
                    'image_name' => $filename
                ]);
            }

            $response["status"] = "successs";
            $response["message"] = "Success! image(s) uploaded";
        }

        else {
            $response["status"] = "failed";
            $response["message"] = "Failed! image(s) not uploaded";
        }
        return response()->json($response);
    }
}
