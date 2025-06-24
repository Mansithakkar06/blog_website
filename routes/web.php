<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('admin.dashboard');
});
Route::get('user', [UserController::class, 'index'])->name('user.index');
Route::post('user/create', [UserController::class, 'create'])->name('user.create');
Route::post('user/add', [UserController::class, 'store'])->name('user.store');
Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('user/update/{user}', [UserController::class, 'update'])->name('user.update');
Route::delete('user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');

Route::resource('category', CategoryController::class);
Route::resource('post',PostController::class);
