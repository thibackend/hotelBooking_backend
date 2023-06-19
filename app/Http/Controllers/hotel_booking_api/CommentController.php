<?php

namespace App\Http\Controllers\hotel_booking_api;

use App\Http\Controllers\Controller;
use App\Models\comments;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comment = comments::all();
        return response()->json([$comment]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $comment = new comments();

        $comment->comment = $request->comment;
        $comment->hotel_id = $request->hotel_id;
        $comment->account_id = $request->account_id;
        if ($comment->save()) {
            return response()->json(["msg" => "add successful", $comment]);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comment = comments::find($id);
        if (!$comment) {
            return response()->json(["msg" => "comment not found"]);
        }
        return response()->json([$comment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $comment = comments::find($id);
        if (!$comment) {
            return response()->json(["msg" => "comment not found"]);
        }
        $comment->comment = $request->comment;
        $comment->save();
        return response()->json(['msg' => "update successfully", $comment]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = comments::find($id);
        if (!$comment) {
            return response()->json(["msg" => "comment not found"]);
        }
        $comment->delete();
        return response()->json(['msg' => "delete successfully", $comment]);
    }
}
