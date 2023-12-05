<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;


Route::middleware('guest')->group(function () {
    Route::get('/',['App\Http\Controllers\LoginController','login'])->name('/');
    Route::post('login',['App\Http\Controllers\LoginController','authenticate'])->name('login');
    Route::get('verify/{id}',['App\Http\Controllers\LoginController','verify'])->name('verify');
});

Route::post('/checkUniqueEmail',['App\Http\Controllers\UserController','checkUniqueEmail'])->name('users/uniqueEmail');

Route::get('/register',['App\Http\Controllers\UserController','create'])->name('register');
Route::post('users/store',['App\Http\Controllers\UserController','store'])->name('users/store');
Route::get('logout',['App\Http\Controllers\LogoutController','perform']);
Route::middleware(['auth','verified'])->group(function () {

    // Route::get('/users',['App\Http\Controllers\UserController','index'])->name('users');
    Route::get('users/dashboard',['App\Http\Controllers\UserController','index'])->name('users/dashboard');


    Route::get('users/delete/{id}',['App\Http\Controllers\UserController','delete'])->name('delete');
    Route::get('users/edit/{id}',['App\Http\Controllers\UserController','edit']);
    Route::put('users/update/{id}',['App\Http\Controllers\UserController','update']);
    Route::get('/dashboard',['App\Http\Controllers\LoginController','dashboard'])->name('dashboard');


    Route::get('change-password/{id}', [UserController::class, 'changePassword'])->name('changePassword');
    Route::post('postChangePassword/{id}', [UserController::class, 'changePasswordSave'])->name('postChangePassword');
});


