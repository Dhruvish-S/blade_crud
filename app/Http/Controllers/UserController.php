<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserServices;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Jobs\UserRegisterJob;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function checkUniqueEmail(Request $request) {
        $checkEmail = User::where('email', $request['email']);
        if($request->editUserId){
            $checkEmail = $checkEmail->whereNot('id', $request->editUserId);
        }
        $checkEmail = $checkEmail->first();
        if ($checkEmail) {
            return response()->json(['isUnique' => false,'email'=>$request['email']]);
        }else{
            return response()->json(['isUnique' => true,'email'=>$request['email']]);
        }
    }

    public function create()
    {
        return view('users/add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|alpha|min:2|max:20',
            'last_name' => 'required|alpha|min:2|max:20',
            'email' => 'required|email|email:rfc,dns|unique:users,email',
            'password' => 'required|min:8|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
            'confirm_password' => 'required|same:password',
            'dob' => 'required|date|before:-18 years',
            'gender' => 'required',
            'phone' => 'required|integer|digits:10',
            'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $fileName = time() . '.' . $request->profile_pic->extension();
        Storage::disk('public')->put($fileName, File::get($request->profile_pic));
        // $request->profile_pic->storeAs('public/uploads',$fileName);

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

        // Mail::send('users/welcomeemail', $email_data, function ($message) use ($email_data) {
        //     $message->to($email_data['email'], $email_data['first_name'], $email_data['last_name'])
        //         ->subject('Welcome to Register User')
        //         ->from('dsorathiya@patoliyainfotech.com', 'RegisterUser');
        // });

        dispatch(new UserRegisterJob($email_data));
        Auth::logout();
        return redirect('/');

    }
    public function index(Request $request)
    {
        $userServices = new UserServices();
        if ($request->ajax())
        {
            $data = $userServices->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('profile_pic', function ($row) {
                    // $data = asset('storage/uploads/' . $row->profile_pic);
                    $data = Storage::url($row->profile_pic);
                    return $data;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a class="btn btn-success btn" href=' . url('users/edit', $row->id) . '>Edit</a>
                    <button href="javascript:void(0);" class="btn btn-danger delete" id="delete" data-id=' . $row->id . '>Delete</button>';

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
        if ($query == 1)
        {
            return redirect('/users/dashboard')->with('success', 'User deleted successfully.');
        } else
        {
            return redirect('/users/dashboard')->with('error', 'Something went wrong.');
        }
    }
    public function edit($id)
    {
        $userServices = new UserServices();
        $query = $userServices->getById($id);

        return view('users/add', ['users' => $query[0]]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|alpha|min:2|max:20',
            'last_name' => 'required|alpha|min:2|max:20',
            'email' => 'email:rfc,dns|required|email',
            'dob' => 'required|date|before:-18 years',
            'gender' => 'required',
            'phone' => 'required|integer|digits:10',
            'profile_pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $userServices = new UserServices();
        $singleUserRecord = $userServices->getById($id);

        if ($request->file('profile_pic'))
        {
            if (File::exists(public_path('storage/') . $singleUserRecord[0]->profile_pic))
            {
                File::delete(public_path('storage/') . $singleUserRecord[0]->profile_pic);
            }
            $fileName = time() . '.' . $request->profile_pic->extension();
            // $request->profile_pic->storeAs('public/uploads',$fileName);
            Storage::disk('public')->put($fileName, File::get($request->profile_pic));
        }

        $inputArray = array(
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'phone' => $request->phone,
        );

        if ($request->file('profile_pic'))
        {
            $inputArray['profile_pic'] = $fileName;
        }

        $query = $userServices->update($id, $inputArray);

        if ($query)
        {
            return redirect('/users/dashboard')->with('success', 'User updated successfully.');
        } else
        {
            return redirect('/users/dashboard')->with('error', 'Something went wrong.');
        }

    }

    public function changePassword(Request $request, $id)
    {
        $id = $request->id;
        return view('users/changepassword', ['id' => $id]);
    }
    public function changePasswordSave(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'current_password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/']
        ]);
        $currentPasswordStatus = Hash::check($request->current_password, $user->password);

        if ($currentPasswordStatus)
        {

            $user->update([
                'password' => Hash::make($request->password),
            ]);
            return redirect()->back()->with('message', 'Password Updated Successfully');

        } else
        {

            return redirect()->back()->with('message', 'Current Password does not match with Old Password');
        }
    }

}

