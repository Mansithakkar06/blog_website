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
        try {
            $users = User::all();
            return view('admin.user.index', compact('users'));
        } catch (Exception $e) {
            return $e->getMessage();
        }
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
        try {
            $attributes = $request->validated();
            if ($request->hasFile('image')) {
                $attributes['image'] = $request->file('image')->store('images/users', 'public');
            }
            User::create($attributes);
            return response()->json("user added successfully");
        } catch (Exception $e) {
            return $e->getMessage();
        }
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
        try {
            $user = User::where('id', $id)->first();
            return view('admin.user.edit', compact('user'));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        try {
            $attributes = $request->validated();
            if($request->password==null)
            {
                unset($attributes['password']);
            }
            if ($request->hasFile('image'))
                if ($user->image != '') { {
                        $path = public_path('storage/' . $user->getRawOriginal('image'));
                        if (file_exists($path)) {
                            unlink($path);
                        }
                        $attributes['image'] = $request->file('image')->store('images/users', 'public');
                    }
                }
            $user->update($attributes);
            return response()->json("user updated successfully");
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
            $user = User::where('id', $id)->first();
            if ($user->image != '') {
                $path = public_path('storage/' . $user->getRawOriginal('image'));
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $user->delete();
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
