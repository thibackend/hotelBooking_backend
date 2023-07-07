<?php

namespace App\Http\Controllers\hotel_booking_api;

use App\Http\Controllers\Controller;
use App\Models\Bills;
use Illuminate\Http\Request;

class BillController extends Controller
{

    // function giúp chèn dữ liệu vào bảng booking và bảng bills.
    public function postBookBill(Request $dataBookBill)
    {
        return response()->json($dataBookBill->all());
    }




    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills0 = Bills::all();
        $bills1 = [];
        foreach ($bills0 as $key => $value) {
            $value['services'] = json_decode($value['services']);
            array_push($bills1, $value);
        }
        return response()->json($bills1);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // vì là kiểu dữ liệu json nên phải  dùng hàn 
        // json encode và json decode để thực hiện lưu lại ==----------------
        // $services = ['service1', 'service2'];
        // $bill = new Bills;
        // $bill->services = json_encode($services);
        // $bill->save();
        // $bill = Bills::find(1);
        // $services = json_decode($bill->services);
        // --------------------------------------------------------------
        $bill = new Bills;
        $bill->booking_id = $request->booking_id;
        $bill->services = json_encode($request->services);
        $bill->room_rate = $request->room_rate;
        $bill->total_night = $request->total_night;
        $bill->total = $request->total;
        $bill->payment_method = $request->payment_method;
        $bill->save();
        return response()->json($bill, 201);
        // json_decode($bill->services)
    }

    /**
     * Display the specified resource.
     */
    public function show(string $bills)
    {
        $bill = Bills::findOrFail($bills);
        $bill->services = json_decode($bill->services);
        return response()->json($bill);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $bills)
    {
        $bill = Bills::findOrFail($bills);
        $bill->booking_id = $request->booking_id;
        $bill->services = json_encode($request->services);
        $bill->room_rate = $request->room_rate;
        $bill->total_night = $request->total_night;
        $bill->total = $request->total;
        $bill->payment_method = $request->payment_method;
        $bill->save();
        return response()->json($bill, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $bills)
    {
        $bill = Bills::findOrFail($bills);
        $bill->delete();
        return response()->json(null, 204);
    }
}
