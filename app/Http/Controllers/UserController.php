<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::all();
        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $attributes = $request->validated();
        $attributes['image'] = $request->file('image')->store('images/users', 'public');
        User::create($attributes);
        return response()->json("user added successfully");
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
        $user=User::where('id',$id)->first();
        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request)
    {
        $attributes = $request->validated();
        $attributes['image'] = $request->file('image')->store('images/users', 'public');
        $user=User::where('id',$request->id)->first();
        $user->update($attributes);
        return response()->json("user updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=User::where('id',$id)->first();
        $user->delete();
        return true;
    }
}
