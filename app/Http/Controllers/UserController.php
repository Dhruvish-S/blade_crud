<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserServices;
use Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Auth;
use DataTables;
use Mail;

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
            'email' => 'email:rfc,dns|required|unique:users,email|email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password|min:8',
            'dob' => 'required|date|before:-18 years',
            'gender' => 'required',
            'phone' => 'required|integer|digits:10',
            'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $fileName = time().'.'.$request->profile_pic->extension();
        $request->profile_pic->move(public_path('uploads'), $fileName);

        $inputArray = array(
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dob' => $request->dob,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'profile_pic' => $fileName,
        );

        $userServices = new UserServices();
        $query = $userServices->add($inputArray);

        $email_data = array(
            'id' => $query->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
        );

        Mail::send('users/welcomeemail', $email_data, function ($message) use ($email_data) {
            $message->to($email_data['email'], $email_data['first_name'], $email_data['last_name'])
                ->subject('Welcome to Register User')
                ->from('dhruvishpatoliya638@gmail.com', 'RegisterUser');
        });
        Auth::logout();
            return redirect('/');

    }
    public function index(Request $request)
    {
        $userServices = new UserServices();
        // $query = $userServices->get();
        // return view('users/dashboard',['users' => $query]);
        // // return view('users/index',['users' => $query]);

        if ($request->ajax()) {
            $data = $userServices->get();
            return Datatables::of($data)->addIndexColumn()
            ->addColumn('profile_pic', function($row){
                $data = asset('uploads/'.$row->profile_pic);
                return $data;
            })
                ->addColumn('action', function($row){
                    $btn = '<a class="btn btn-success btn" href=' . url('users/edit', $row->id) . '>Edit</a>
                    <button href="javascript:void(0);" class="btn btn-danger delete" id="delete" data-id='. $row->id .'>Delete</button>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('users/dashboard');

    }
    public function delete($id)
    {
        $userServices = new UserServices();
        $query = $userServices->delete($id);
        if($query == 1) {
            return redirect('/users/dashboard')->with('success', 'User deleted successfully.');
        } else {
            return redirect('/users/dashboard')->with('error', 'Something went wrong.');
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
        $userServices = new UserServices();
        $singleUserRecord = $userServices->getById($id);


        if($request->file('profile_pic'))
        {
            // echo 'if';
            // $fileName = time().'.'.$request->file('profile_pic')->extension();
            // $request->file('profile_pic')->move(public_path('uploads'), $fileName);

            if(File::exists(public_path('uploads/').$singleUserRecord[0]->profile_pic)) {
                File::delete(public_path('uploads/').$singleUserRecord[0]->profile_pic);
            }

            $fileName = time().'.'.$request->profile_pic->extension();
            $request->profile_pic->move(public_path('uploads'), $fileName);

        }

        $inputArray = array(
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'phone' => $request->phone,
        );

        if($request->file('profile_pic')){
            $inputArray['profile_pic'] = $fileName;
        }

        $query = $userServices->update($id,$inputArray);

        if($query) {
            return redirect('/users/dashboard')->with('success', 'User updated successfully.');
        } else {
            return redirect('/users/dashboard')->with('error', 'Something went wrong.');
        }

    }

}

