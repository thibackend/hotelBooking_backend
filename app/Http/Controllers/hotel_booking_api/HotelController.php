<?php

namespace App\Http\Controllers\hotel_booking_api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\hotel_images;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotel = Hotel::all();
        $hotelImages =hotel_images::all();
        return response()->json(["hotels"=>$hotel, "images"=>$hotelImages]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $hotel = new Hotel();
        $hotel->name = $request->input('name');
        $hotel->address = $request->input('address');
        $hotel->contact = $request->input('contact');
        $hotel->desc = $request->input('desc');
        $hotel->star = $request->input('star');
        $hotel->status = $request->input('status');
        $saved = $hotel->save();
        if ($saved) return response()->json(['Add hotel successful', $hotel]);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hotel = Hotel::find($id);

        if (!$hotel) {
            return response()->json(['error' => 'Hotel not found'], 404);
        }
        return response()->json($hotel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return response()->json(['error' => 'Hotel not found'], 404);
        }
        $hotel->name = $request->input('name');
        $hotel->address = $request->input('address');
        $hotel->contact = $request->input('contact');
        $hotel->desc = $request->input('desc');
        $hotel->star = $request->input('star');
        $hotel->status = $request->input('status');
        $hotel->save();
        return response()->json($hotel);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return response()->json(['error' => 'Hotel not found'], 404);
        }
    
        $hotel->delete();
    
        return response()->json(['message' => 'Hotel deleted',$hotel]);
    }

    public function detail($id)
    {
        $detailHotel = Hotel::select('hotel_images.image', 'hotels.name', 'hotels.address', 'hotels.desc', 'hotels.star', 'hotels.contact')
            ->join('hotel_images', 'hotels.id', '=', 'hotel_images.hotel_id')
            ->where('hotels.id', $id)
            ->distinct()
            ->get();

        return response()->json($detailHotel);
    }
}
