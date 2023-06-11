<?php

namespace App\Http\Controllers\hotel_booking_api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotel = Hotel::all();
        return response()->json($hotel);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $hotel = new Hotel();
        $hotel->hotel_code = $request->input('hotel_code');
        $hotel->name = $request->input('name');
        $hotel->address = $request->input('address');
        $hotel->hotel_desc = $request->input('hotel_desc');
        $hotel->star=$request->input('star');
        $saved = $hotel->save();
        if ($saved) return response()->json(['Add hotel successful',$hotel]);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hotel = Hotel::find($id);
        return response()->json([$hotel]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hotel = Hotel::find($id);
        $hotel->hotel_code = $request->input('hotel_code');
        $hotel->name = $request->input('name');
        $hotel->address = $request->input('address');
        $hotel->hotel_desc = $request->input('hotel_desc');
        $hotel->star=$request->input('star');
        $updated = $hotel->save();
        if ($updated) return response()->json(['Update hotel successful',$hotel]);
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hotel = Hotel::find($id);
        $deleted = $hotel->delete();

        if ($deleted) :
            return response()->json(['mess'=>"Delete successful", "data"=>$hotel]);
        endif;
    }
}
