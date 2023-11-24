<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserServices;

class UserController extends Controller
{
    public function create()
    {
        return view('users/add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'dob' => 'required',
            'gender' => 'required',
            'phone' => 'required|integer|min:10',
            'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $fileName = time().'.'.$request->profile_pic->extension();
        $request->profile_pic->move(public_path('uploads'), $fileName);

        $inputArray = array(
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'dob' => $request->dob,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'profile_pic' => $fileName,
        );

        $userServices = new UserServices();
        $query = $userServices->add($inputArray);

        if($query) {
            return redirect('/users')->with('success', 'User added successfully.');
        } else {
            return redirect('/users')->with('error', 'Something went wrong.');
        }
    }
    public function index()
    {
        $userServices = new UserServices();
        $query = $userServices->get();
        return view('users/index',['users' => $query]);
    }
}
