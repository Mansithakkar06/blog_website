<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::all();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $attributes=$request->validated();
        if($request->hasFile('image'))
        {
            $attributes['image']=$request->file('image')->store("images/category","public");
        }
        Category::create($attributes);
        return response()->json("category added successfully");
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
        $category=Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $attributes=$request->validated();
        if($request->hasFile('image')){
            if($category->image!=''){
                $path=public_path('storage/'.$category->getRawOriginal('image'));
                if(file_exists($path)){
                    unlink($path);
                }
            }
            $attributes['image']=$request->file('image')->store("images/category","public");
        }
        $category->update($attributes);
        return response()->json("Category Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category=Category::where('id',$id)->first();
        if($category->image!=null){
            $path=public_path('storage/'.$category->getRawOriginal('image'));
            if(file_exists($path)){
                unlink($path);
            }
        }
        $category->delete();
        return response()->json("category deleted successfully");
    }
}
