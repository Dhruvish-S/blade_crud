<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\Verified;
use Carbon\Carbon;
use App\Services\UserServices;
use Illuminate\Support\Facades\Session;


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
            $request->session()->regenerate();
            if(Auth::check()){
                return redirect()->intended('users/dashboard');
            }
        }
        return back()->with([
            'fail' => 'The provided credentials do not match our records.',
        ]);

    }
    public function dashboard(){
        return view('users/dashboard');
    }

    public function verify(Request $request,$id){
            event(new Verified($request->user()));
            $time             = Carbon::now();
            $timeStamp        = $time->toDateTimeString();
            $inputArray = array(
                'email_verified_at' => $timeStamp,
            );
            // dd($inputArray);
            if($inputArray ){
                $userServices = new UserServices();
                $query = $userServices->update($id,$inputArray);
                if($query){
                    // dd($query);
                    return redirect('/');
                }else{
                    dd();
                    return redirect('/');
                }
            }else{
                dd();
                return redirect('/');
            }



    }
}
