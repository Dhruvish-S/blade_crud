<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserServices;
use Storage;
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
            'phone' => 'required|integer|max:11|min:10',
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
    public function delete($id)
    {
        $userServices = new UserServices();
        $query = $userServices->delete($id);
        if($query) {
            return redirect('/users')->with('success', 'User deleted successfully.');
        } else {
            return redirect('/users')->with('error', 'Something went wrong.');
        }
    }
    public function edit($id)
    {
        $userServices = new UserServices();
        $query = $userServices->getById($id);

        return view('users/add',['users' => $query[0]]);
    }
    public function update(Request $request, $id)
    {

        $request->validate([
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'email' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'phone' => 'required|integer',
            'profile_pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);


        if($request->file('profile_pic'))
        {
            // echo 'if';
            // $fileName = time().'.'.$request->file('profile_pic')->extension();
            // $request->file('profile_pic')->move(public_path('uploads'), $fileName);

            $fileName = time().'.'.$request->profile_pic->extension();
            $request->profile_pic->move(public_path('uploads'), $fileName);

        }

        $inputArray = array(
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'dob' => $request->dob,
            'gender' => $request->gender,
            'phone' => $request->phone,
        );

        if($request->file('profile_pic')){
            $inputArray['profile_pic'] = $fileName;
        }
        $userServices = new UserServices();
        $query = $userServices->update($id,$inputArray);

        if($query) {
            return redirect('/users')->with('success', 'User updated successfully.');
        } else {
            return redirect('/users')->with('error', 'Something went wrong.');
        }

    }

}

