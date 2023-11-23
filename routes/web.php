<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register',['App\Http\Controllers\UserController','create'])->name('register');

Route::get('/login',['App\Http\Controllers\LoginController','create'])->name('login');

Route::post('users/store',['App\Http\Controllers\UserController','store'])->name('users/store');
