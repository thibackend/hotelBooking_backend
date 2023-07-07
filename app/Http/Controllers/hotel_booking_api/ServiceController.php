<?php

namespace App\Http\Controllers\hotel_booking_api;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function SelectServiceById(Request $ServiceIds)
    {
        $data = [];
        foreach ($ServiceIds->all() as $key => $value) {
            $add = Services::find($value);
            array_push($data, $add);
        }
        return response()->json($data);
        // return response()->json($ServiceIds->all());
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Services::all();
        return response()->json($services);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $service = Services::create($request->all());
        return response()->json($service, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Services::findOrFail($id);
        return response()->json($service);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = Services::findOrFail($id);
        $service->update($request->all());
        return response()->json($service);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Services::findOrFail($id)->delete();
        return response()->json(['message' => 'Service deleted successfully']);
    }
}
