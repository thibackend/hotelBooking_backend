<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function index()
    {
        $users = Users::all();
        return response()->json($users);
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:users',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
        ]);
        $user = Users::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $request->image,
            'address' => $request->address,
            'phone' => $request->phone,
            'status' => $request->status
        ]);
        return response()->json(['message' => 'User registered successfully',"user"=>$user]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Users::where('email', $request->email)->firstOrFail();
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'token' => $token,
                'email' => $user->email,
                'username' => $user->name,
                'avatar' => $user->image
            ]);
        }
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
}
