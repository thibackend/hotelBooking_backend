<?php

namespace App\Http\Controllers\hotel_booking_api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $booking = Booking::all();
        return response()->json($booking);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $booking = new Booking();
        $booking->id = $request->input("id");
        $booking->hotel_id = $request->input("hotel_id");
        $booking->user_id = $request->input("user_id");
        $booking->room_id = $request->input("room_id");
        $booking->booking_date = $request->input("booking_date");
        $booking->check_out_date = $request->input("check_out_date");
        $booking->save();

        return response()->json(["msg" => "Add successful", "data" => $booking]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = Booking::find($id);
        return response()->json($booking);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $booking = Booking::find($id);
        $booking->hotel_id = $request->input("hotel_id");
        $booking->user_id = $request->input("user_id");
        $booking->room_id = $request->input("room_id");
        $booking->booking_date = $request->input("booking_date");
        $booking->check_out_date = $request->input("check_out_date");
        $booking->save();
        return response()->json(["msg" => "update successful", "data" => $booking]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booking = Booking::find($id);
        $booking->delete();
        return response()->json(["msg" => "delete successful", "data" => $booking]);
    }
}
