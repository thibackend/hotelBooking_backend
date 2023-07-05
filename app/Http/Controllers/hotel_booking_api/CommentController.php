<?php

namespace App\Http\Controllers\hotel_booking_api;

use App\Http\Controllers\Controller;
use App\Models\comments;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return comments::all();
    }

    public function store(Request $request)
    {
        $comment = comments::create($request->all());
        return $comment;
    }

    public function show($id)
    {
        $comment = comments::findOrFail($id);
        return $comment;
    }

    public function update(Request $request, $id)
    {
        $comment = comments::findOrFail($id);
        $comment->update($request->all());
        return $comment;
    }

    public function destroy($id)
    {
        $comment = comments::findOrFail($id);
        $comment->delete();
        return response()->json(null, 204);
    }
}
