<?php

namespace App\Http\Controllers\hotel_booking_api;

use App\Http\Controllers\Controller;
use App\Models\accounts;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = accounts::all();
        return response()->json($accounts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $accounts = accounts::find($id);
        return response()->json($accounts);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $account = accounts::find($id);
        if (!$account) {
            return response()->json(["msg" => "account not found"]);
        }
        $account->user_name = $request->user_name;
        $account->email = $request->email;
        $account->password = bcrypt($request->password);

        return response()->json(["msg" => "update successfully", $account]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $account = accounts::find($id);
        if (!$account) {
            return response()->json(["msg" => "account not found"]);
        }
        $account->delete();
        return response()->json(["msg" => "delete successfully", $account]);
    }
}
