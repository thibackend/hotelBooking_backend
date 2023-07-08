<?php

namespace App\Http\Controllers\hotel_booking_api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\comments;
use App\Models\Users;

class ReviewRoomController extends Controller
{
    //

    public function index(Request $request)
    {
        return response()->json(comments::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = $request->user_id;
        $room_id = $request->room_id;
        $content = $request->content;
        $user = Users::where("id", $user_id)->first();
        if ($user) {
            $comment = new comments();
            $comment->user_id = $user->id;
            $comment->room_id = $room_id;
            $comment->content = $content;
            $comment->save();
            $data = $this->show($request->room_id);
            return response()->json($data);
        }
        return response()->json([
            "status" => 500
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user_comment = comments::where("room_id", $id)
            ->join("users", "comments.user_id", "=", "users.id")
            ->join("rooms", "comments.room_id", "=", "rooms.id")
            ->select("users.id", "users.name", "users.image", "comments.content", "comments.created_at")
            ->groupBy("users.id", "users.name", "users.image", "comments.content", "comments.created_at")
            ->get();
        return response()->json($user_comment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
