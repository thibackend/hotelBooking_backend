<?php

namespace App\Http\Controllers\hotel_booking_api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Mockery\Undefined;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */


    //  Route::get('/hotel_images', 'hotel_images');
    public function hotel_images()
    {
        $dataHotel_images = [];
        $hotels = Hotel::all();
        foreach ($hotels as $key => $value) {
            $hotel = Hotel::find($key + 1);
            $images = $hotel->image()->where('hotel_id', $hotel->id)->pluck('image');
            array_push(
                $dataHotel_images,
                [
                    "id" => $hotel->id,
                    "image" => $images,
                    "name" => $hotel->name,
                    "contact" => $hotel->contact,
                    "desc" => $hotel->desc,
                    "star" => $hotel->star,
                    "address" => $hotel->address,
                    "status" => $hotel->status,
                ]
            );
        }
        return response()->json($dataHotel_images);
    }

    public function getOne_hotel_images(string $id)
    {
        $dataHotel_images = [];
        $hotel = Hotel::find($id);
        if(!$hotel) return response()->json(null);
        $images = $hotel->image()->where('hotel_id', $hotel->id)->pluck('image')->all();
        array_push(
            $dataHotel_images,
            [
                "id" => $hotel->id,
                "image" => $images,
                "name" => $hotel->name,
                "contact" => $hotel->contact,
                "desc" => $hotel->desc,
                "star" => $hotel->star,
                "address" => $hotel->address,
                "status" => $hotel->status,
            ]
        );
        return response()->json($dataHotel_images);
    }





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
        $hotel->name = $request->input('name');
        $hotel->address = $request->input('address');
        $hotel->contact = $request->input('contact');
        $hotel->desc = $request->input('desc');
        $hotel->star = $request->input('star');
        $hotel->status = $request->input('status');
        $saved = $hotel->save();
        if ($saved) return response()->json(['Add hotel successful', $hotel], 201);
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

        return response()->json(['message' => 'Hotel deleted', $hotel]);
    }
<<<<<<< HEAD
=======

    public function detail($id)
    {
        $detailHotel = Hotel::select('hotels.name', 'hotels.address', 'hotels.desc', 'hotels.star', 'hotels.contact', 'hotel_images.image')
            ->join('hotel_images', 'hotels.id', '=', 'hotel_images.hotel_id')
            ->where('hotels.id', $id)
            ->get();

        // Xử lý dữ liệu
        $result = [
            'name' => $detailHotel[0]->name,
            'address' => $detailHotel[0]->address,
            'desc' => $detailHotel[0]->desc,
            'star' => $detailHotel[0]->star,
            'contact' => $detailHotel[0]->contact,
            'images' => []
        ];

        foreach ($detailHotel as $hotel) {
            $result['images'][] = $hotel->image;
        }

        return response()->json($result);
    }

>>>>>>> dev
}
