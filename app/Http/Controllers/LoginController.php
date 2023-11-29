<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class LoginController extends Controller
{
    public function login()
    {
        return view('users/login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            Auth::user();
            $request->session()->regenerate();
            return redirect()->intended('users/dashboard');
        }

        return back()->with([
            'fail' => 'The provided credentials do not match our records.',
        ]);

    }
    public function dashboard(){
        return view('users/dashboard');
    }
}
