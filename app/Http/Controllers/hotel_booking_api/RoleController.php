<?php

namespace App\Http\Controllers\hotel_booking_api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Role::all();
        return response()->json($role);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = new Role();
        $role->id = $request->input("id");
        $role->name = $request->input("name");
        $role->desc = $request->input("desc");
        $role->save();
        return response()->json(["msg" => "Successfull",$role]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);
        return response()->json($role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::find($id);
        $role->id = $request->input("id");
        $role->name = $request->input("name");
        $role->desc = $request->input("desc");
        $role->save();
        return response()->json(["msg"=>"update successful","data"=>$role]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        $role ->delete();
        return response()->json(["msg"=>"delete Successful",$role]);
    }
}
