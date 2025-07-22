<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $posts = Post::with('categories', 'user')->whereStatus('published')->latest()->get();
        $topcategories = Category::withCount('posts')->orderBy('posts_count', 'desc')->limit(3)->get();
        return view('frontend.index', compact('posts', 'topcategories'));
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function category(Category $category)
    {
        $posts = $category->posts()->get();
        return view('frontend.category', compact('category', 'posts'));
    }
    public function post(Post $post)
    {
        $post = $post->load('user');
        $comments = Comment::with('user')->whereStatus('approved')->where("post_id", $post->id)->where('reply_id', null)->latest()->get();
        $liked = Comment::where('user_id', Auth::id())->where("post_id", $post->id)->first();
        return view('frontend.post', compact('post', 'comments', 'liked'));
    }
    public function comment(Request $request)
    {
        $attributes = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'reply_id' => 'nullable|exists:comments,id',
            'description' => 'required',
        ]);
        $attributes['user_id'] = Auth::id();
        $attributes['status'] = "approved";
        Comment::create($attributes);
        return response()->json("commment addded");
    }
    public function deletComment(string $id)
    {
        try {
            $comment = Comment::find($id);
            $comment->delete();
            return response()->json("comment deleted");
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function like(Request $request)
    {
        $attributes = $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);
        $attributes['user_id'] = Auth::id();
        $attributes['like'] = 1;
        Like::create($attributes);
        return response()->json("liked");
    }
    public function removeLike(string $id)
    {
        $like = Like::where("post_id", $id)->where("user_id", Auth::id())->first();
        $like->delete();
        return response()->json("like removed");
    }
}
