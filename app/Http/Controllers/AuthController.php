<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function loginindex()
    {
        return view('authentication.login');
    }
    public function attempt_login(LoginRequest $request)
    {
        $attributes = $request->only('email', 'password');
        if (Auth::attempt($attributes)) {
            if (!Auth::user()->status == 'active') {
                Auth::logout();
                $request->session()->flush();
                return redirect()->route('login.index')->with('error', 'Login failed');
            } else {
                return redirect()->route('dashboard')->with('success', 'Welcome');
            }
        } else {
            return redirect()->route('login.index')->with('error', 'Invalid Credentials');
        }
    }
    public function registerindex()
    {
        return view('authentication.register');
    }
    public function attempt_register(RegisterRequest $request)
    {
        $attributes = $request->validated();
        $user = User::create($attributes);
        Auth::login($user);
        return redirect()->route('dashboard')->with('success', 'Welcome');
    }
    public function forgotindex()
    {
        return view('authentication.forgot-password');
    }
    public function send_resetlink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);
        $status = Password::sendResetLink($request->only('email'));
        return $status === Password::ResetLinkSent
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
    public function reset_password(string $token)
    {
        return view('authentication.reset-password', ['token' => $token]);
    }
    public  function update_password(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PasswordReset
            ? redirect()->route('login.index')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.index');
    }
}
