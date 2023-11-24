<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function create()
    {
        return view('users/login');
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->input('email'))->first();
        if ($user && Hash::check($request->input('password'), $user->password)) {
            $request->session()->put('loginId' , $user->id);
            return redirect()->route('dashboard');
        }
        else{
            return back()->with([
                'fail' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function dashboard(){
        return view('users/dashboard');
    }
}
