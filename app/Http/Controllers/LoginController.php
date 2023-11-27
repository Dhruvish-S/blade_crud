<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    public function create()
    {
        return view('users/login');
    }
    public function store(Request $request)
    {
        // $request->validate([
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);

        // $user = User::where('email', $request->input('email'))->first();
        // if ($user && Hash::check($request->input('password'), $user->password)) {
        //     $request->session()->put('loginId' , $user->id,);
        //     return redirect()->route('dashboard');

        // }
        // else{
        //     return back()->with([
        //         'fail' => 'The provided credentials do not match our records.',
        //     ]);
        // }


        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

    }
    public function dashboard(){
        return view('users/dashboard');
    }
}
