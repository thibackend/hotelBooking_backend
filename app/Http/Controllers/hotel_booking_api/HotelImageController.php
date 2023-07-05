<?php

namespace App\Http\Controllers\hotel_booking_api;

use App\Http\Controllers\Controller;
use App\Models\hotel_images;
use Illuminate\Http\Request;

class HotelImageController extends Controller
{
    public function index()
    {
        return hotel_images::all();
    }

    public function store(Request $request)
    {
        $hotelImage = hotel_images::create($request->all());
        return $hotelImage;
    }

    public function show($id)
    {
        $hotelImage = hotel_images::findOrFail($id);
        return $hotelImage;
    }

    public function update(Request $request, $id)
    {
        $hotelImage = hotel_images::findOrFail($id);
        $hotelImage->update($request->all());
        return $hotelImage;
    }

    public function destroy($id)
    {
        $hotelImage = hotel_images::findOrFail($id);
        $hotelImage->delete();
        return response()->json(null, 204);
    }
}
