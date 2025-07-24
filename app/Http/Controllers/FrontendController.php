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
    public function contact()
    {
        return view('frontend.contact');
    }
    public function about()
    {
        return view('frontend.about');
    }
    public function post(Post $post)
    {
        $post = $post->load('user', 'categories');
        $comments = Comment::with([
            'user',
            'reply' => function ($q) use ($post) {
                $q->whereStatus('approved')->where("post_id", $post->id);
            }
        ])->whereStatus('approved')->where("post_id", $post->id)->where('reply_id', null)->latest()->get();
        $cmntscount = $this->getCmntsCount($post->id);
        $likescount = $this->getLikeCount($post->id);
        $likes = Like::where('post_id', $post->id)->where('user_id', Auth::id());
        $dislike = clone $likes;
        $liked = $likes->where('like', 1)->first();
        $disliked = $dislike->where('like', 0)->first();
        $categoryIds = $post->categories->pluck('id')->toArray();
        $topposts = Post::where('id', '!=', $post->id)->whereHas('categories', function ($q) use ($categoryIds) {
            $q->whereIn('id', $categoryIds);
        })->withCount('likes')
            ->orderBy("likes_count", "desc")
            ->limit(5)
            ->get();
        return view('frontend.post', compact('post', 'comments', 'cmntscount', 'likescount', 'liked', 'disliked', 'topposts'));
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
        $cmntscount = $this->getCmntsCount($attributes['post_id']);
        return response()->json($cmntscount);
    }
    public function editComment($id)
    {
        $comment = Comment::find($id);
        return response()->json($comment->description);
    }
    public function updateComment(Request $request)
    {
        $comment = Comment::find($request['cmnt_id']);
        $comment->update(['description' => $request['description']]);
        return response()->json("updated");
    }
    public function deletComment($id)
    {
        try {
            $comment = Comment::find($id);
            $postid = $comment->post_id;
            $comment->delete();
            $cmntscount = $this->getCmntsCount($postid);
            return response()->json($cmntscount);
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
        $like = Like::where("post_id", $attributes['post_id'])->where("user_id", $attributes['user_id'])->first();
        if ($request['status'] == 1) {
            if ($like == null) {
                Like::create($attributes);
            } else {
                $like->update(['like' => 1]);
            }
        } else {
            $like->delete();
        }
        $likescount = $this->getLikeCount($attributes['post_id']);
        return response()->json($likescount);
    }
    public function dislike(Request $request)
    {
        $attributes = $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);
        $attributes['user_id'] = Auth::id();
        $attributes['like'] = 0;
        $like = Like::where("post_id", $attributes['post_id'])->where("user_id", $attributes['user_id'])->first();
        if ($request['status'] == 1) {
            if ($like == null) {
                Like::create($attributes);
            } else {
                $like->update(['like' => 0]);
            }
        } else {
            $like->delete();
        }
        $likescount = $this->getLikeCount($attributes['post_id']);
        return response()->json($likescount);
    }
    public function getLikeCount($id)
    {
        $likes = Like::where('like', 1)->where('post_id', $id)->count();
        $dislikes = Like::where('like', 0)->where('post_id', $id)->count();
        return [
            'likescount' => $likes,
            'dislikecount' => $dislikes,
        ];
    }
    public function getCmntsCount($id)
    {
        return Comment::where("post_id", $id)->whereStatus("approved")->count();
    }
}
