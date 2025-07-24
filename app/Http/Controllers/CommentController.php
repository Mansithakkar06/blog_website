<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('user')->get();
        return view('admin.comment.index', compact('comments'));
    }
    public function update(Request $request)
    {
        $attributes = $request->validate([
            'id' => 'required|exists:comments,id',
            'status' => 'required',
        ]);
        $comment = Comment::find($attributes['id']);
        $comment->update(['status' => $attributes['status']]);
        return response()->json("updated");
    }
}
