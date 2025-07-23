<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group([
    'middleware' => 'auth',
], function () {
    Route::get('dashboard', [FrontendController::class, 'dashboard'])->name('dashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::post('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user/add', [UserController::class, 'store'])->name('user.store');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('user/update/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');

    Route::resource('category', CategoryController::class);
    Route::resource('post', PostController::class);
    Route::post('comment', [FrontendController::class, 'comment'])->name('frontend.comment');
    Route::delete('comment/delete/{id}', [FrontendController::class, 'deletComment'])->name('frontend.deleteComment');
    Route::post('like', [FrontendController::class, 'like'])->name('frontend.like');
    Route::post('dislike', [FrontendController::class, 'dislike'])->name('frontend.dislike');
    Route::get('comment/edit/{id}', [FrontendController::class, 'editComment'])->name('frontend.editcomment');
    Route::post('comment/update', [FrontendController::class, 'updateComment'])->name('frontend.updatecomment');
});

Route::get('login', [AuthController::class, 'loginindex'])->name('login.index');
Route::get('register', [AuthController::class, 'registerindex'])->name('register.index');
Route::post('attempt-register', [AuthController::class, 'attempt_register'])->name('register.attempt');
Route::post('attempt-login', [AuthController::class, 'attempt_login'])->name('login.attempt');
Route::get('forgot-password', [AuthController::class, 'forgotindex'])->name('password.request');
Route::post('send-resetlink', [AuthController::class, 'send_resetlink'])->name('password.email');
Route::get('reset-password/{token}', [AuthController::class, 'reset_password'])->name('password.reset');
Route::post('reset-password', [AuthController::class, 'update_password'])->name('password.update');
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('category/{category:slug}', [FrontendController::class, 'category'])->name('frontend.category');
Route::get('post/{post:slug}', [FrontendController::class, 'post'])->name('frontend.post');
