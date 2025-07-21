<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $sort_by = request('sort_by', 'id');
            $direction = request('direction', 'asc');
            $allowedSorts = ['id', 'title', 'status'];
            $allowedDirections = ['asc', 'desc'];

            $sort_by = in_array($sort_by, $allowedSorts) ? $sort_by : 'id';
            $direction = in_array($direction, $allowedDirections) ? $direction : 'asc';

            $posts = Post::with('categories', 'user')
                ->orderBy($sort_by, $direction)
                ->get();
            return view('admin.post.index', compact('posts', 'sort_by', 'direction'));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            // $users = User::whereStatus('active')->get();
            $categories = Category::whereStatus('active')->get();
            return view('admin.post.create', compact('categories'));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        try {
            $attributes = $request->validated();
            unset($attributes['category_id']);
            $attributes['slug'] = Str::slug($request->title);
            $attributes['image'] = $request->file('image')->store("images/post", "public");
            $attributes['user_id'] = Auth::id();
            $post = Post::create($attributes);
            $post->categories()->attach($request->category_id);
            return redirect('post')->with("success", "Post Added Successfully");
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::whereId($id)->first();
        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $post = Post::where('id', $id)->first();
            $categories = Category::whereStatus('active')->get();
            return view('admin.post.edit', compact('categories', 'post'));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        try {
            $attributes = $request->validated();
            $attributes['slug'] = Str::slug($request->title);
            unset($attributes['category_id']);
            unset($attributes['image']);
            if ($request->hasFile('image')) {
                $path = public_path('storage/' . $post->getRawOriginal('image'));
                if (file_exists($path)) {
                    unlink($path);
                }
                $attributes['image'] = $request->file('image')->store('images/post', "public");
            }
            $attributes['user_id'] = Auth::id();
            $post->update($attributes);
            $post->categories()->sync($request->category_id);
            return redirect('post')->with("success", "Post Updated Successfully");
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $post = Post::where('id', $id)->first();
            $path = public_path('storage/' . $post->getRawOriginal('image'));
            if (file_exists($path)) {
                unlink($path);
            }
            $post->delete();
            $post->categories()->detach();
            return response()->json("post deleted successfully");
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
