<?php

namespace App\Http\Controllers\hotel_booking_api;

use App\Http\Controllers\Controller;
use App\Models\TypeRoom;
use Illuminate\Http\Request;

class TypeRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $typeroom = TypeRoom::all();
        return response()->json($typeroom);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $typeroom = new TypeRoom();
        $typeroom->id = $request->input('id');
        $typeroom->name = $request->input('name');
        $typeroom->desc = $request->input('desc');
        $typeroom->save();
        return response()->json(["msg"=>"Add successfull", "data"=>$typeroom]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $typeroom = TypeRoom::find($id);
        return response()->json($typeroom);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $typeroom =TypeRoom::find($id);
        $typeroom->name = $request->input('name');
        $typeroom->desc = $request->input('desc');
        $typeroom->save();
        return response()->json(["msg"=>"Upadate successfull", "data"=>$typeroom]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $typeroom =TypeRoom::find($id);
        $typeroom->delete();
        return response()->json(["msg"=>"delete successfull", "data"=>$typeroom]);

    }
}
