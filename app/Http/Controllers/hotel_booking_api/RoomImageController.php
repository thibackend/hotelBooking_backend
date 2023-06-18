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
        $image = new room_images();
        $image->image = $request->image;
        $image->room_id = $request->room_id;
        $image->hotel_id = $request->hotel_id;
        $image->save();
        return response()->json(['msg'=>"add successful",$image],201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $image = room_images::find($id);
        return response()->json($image);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $image =room_images::find($id);
        $image->image = $request->image;
        $image->room_id = $request->room_id;
        $image->hotel_id = $request->hotel_id;
        $image->save();
        return response()->json(['msg'=>"update successful",$image],201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $image = room_images::find($id);
        $image->delete();
        return response()->json(['msg'=>"delete successful",$image]);


        
    }
}
