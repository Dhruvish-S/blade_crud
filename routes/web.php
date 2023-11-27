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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/register',['App\Http\Controllers\UserController','create'])->name('register');
Route::post('users/store',['App\Http\Controllers\UserController','store'])->name('users/store');
Route::get('/',['App\Http\Controllers\LoginController','index'])->name('/');

Route::post('login/store',['App\Http\Controllers\LoginController','login'])->name('login/store');




Route::get('logout',['App\Http\Controllers\LogoutController','perform']);




Route::middleware('auth')->group(function () {

    // Route::get('/users',['App\Http\Controllers\UserController','index'])->name('users');
    Route::get('/users/dashboard',['App\Http\Controllers\UserController','index'])->name('users/dashboard');
    Route::get('users/delete/{id}',['App\Http\Controllers\UserController','delete']);
    Route::get('users/edit/{id}',['App\Http\Controllers\UserController','edit']);
    Route::put('users/update/{id}',['App\Http\Controllers\UserController','update']);
    Route::get('/dashboard',['App\Http\Controllers\LoginController','dashboard'])->name('dashboard');



});
