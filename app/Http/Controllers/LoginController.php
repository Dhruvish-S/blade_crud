<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Verified;
use Carbon\Carbon;
use App\Services\UserServices;

class LoginController extends Controller
{
    public function login()
    {
        return view('users/login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'email:rfc,dns|required|unique:users,email|email',
            'password' => 'required|min:8|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('users/dashboard');
        }
        return back()->with([
            'fail' => 'The provided credentials do not match our records.',
        ]);

    }
    public function dashboard()
    {
        return view('users/dashboard');
    }

    public function verify(Request $request, $id)
    {
        event(new Verified($request->user()));
        $time = Carbon::now();
        $timeStamp = $time->toDateTimeString();
        $inputArray = array(
            'email_verified_at' => $timeStamp,
        );
        if ($inputArray) {
            $userServices = new UserServices();
            $query = $userServices->update($id, $inputArray);
            if ($query) {
                return redirect('/');
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
}
