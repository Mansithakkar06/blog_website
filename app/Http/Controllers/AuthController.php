<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginindex()
    {
        return view('authentication.login');
    }
    public function attempt_login(LoginRequest $request)
    {
        $attributes=$request->only('email','password');
        if(Auth::attempt($attributes))
        {
            if(!Auth::user()->status=='active')
            {
                Auth::logout();
                $request->session()->flush();
                return redirect('/')->with('error','Login failed');
            }
            else{
                return redirect('/dashboard')->with('success','Welcome');
            }
        }
        else{
            return redirect('/')->with('error','Invalid Credentials');
        }
    }
    public function registerindex()
    {
        return view('authentication.register');
    }
    public function attempt_register(RegisterRequest $request)
    {
        $attributes=$request->validated();
        $user=User::create($attributes);
        Auth::login($user);
        return redirect('/dashboard')->with('success','Welcome');
    }
    public function forgotindex()
    {
        return view('authentication.forgot-password');
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
