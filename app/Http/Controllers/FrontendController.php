<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

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
        return view('frontend.post', compact('post'));
    }
}
