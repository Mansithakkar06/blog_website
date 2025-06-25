<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::with('categories')->get();
        return view('admin.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users=User::whereStatus('active')->get();
        $categories=Category::whereStatus('active')->get();
        return view('admin.post.create',compact('users','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $attributes=$request->validated();
        unset($attributes['category_id']);
        if($request->hasFile('image'))
        {
            $attributes['image']=$request->file('image')->store("images/post","public");
        }
        $attributes['user_id']=19;
        $post=Post::create($attributes);
        $post->categories()->attach($request->category_id);
        return redirect('post')->with("success","Post Added Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
