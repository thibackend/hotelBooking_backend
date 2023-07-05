<?php

namespace App\Http\Controllers\hotel_booking_api;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserInforController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = Users::all();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:users',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
        ]);

        $user = Users::create([
            'name' => $request->name,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $request->image,
            'address' => $request->address,
            'phone' => $request->phone,
            'status' => $request->status,
        ]);

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Users::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|unique:users,name,' . $id,
            'email' => 'required|string|email|unique:users,email,' . $id,
        ]);

        $user = Users::findOrFail($id);
        $user->update($request->only('name', 'role', 'email', 'image', 'address', 'phone', 'status'));

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Users::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
