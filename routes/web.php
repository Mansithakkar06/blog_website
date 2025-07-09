<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group([
    'middleware'=>'auth',
],function(){
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    });
    Route::post('logout',[AuthController::class,'logout'])->name('logout');
    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::post('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user/add', [UserController::class, 'store'])->name('user.store');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('user/update/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');

    Route::resource('category', CategoryController::class);
    Route::resource('post',PostController::class);
});

Route::get('/',[AuthController::class,'loginindex'])->name('login.index');
Route::get('register',[AuthController::class,'registerindex'])->name('register.index');
Route::post('attempt-register',[AuthController::class,'attempt_register'])->name('register.attempt');
Route::post('attempt-login',[AuthController::class,'attempt_login'])->name('login.attempt');
Route::get('forgot-password',[AuthController::class,'forgotindex'])->name('password.request');
Route::post('send-resetlink',[AuthController::class,'send_resetlink'])->name('password.email');
Route::get('reset-password/{token}',[AuthController::class,'reset_password'])->name('password.reset');
Route::post('/reset-password',[AuthController::class,'update_password'])->name('password.update');
