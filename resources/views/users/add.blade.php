@extends('layout.app')
@section('title') @if (isset($users)) Edit @else Add @endif User @endsection
@section('content')

<div class="container registerContainer">
    <h2>@if (isset($users)) Edit @else Add @endif User</h2>
    @if (isset($users))
        <form action="{{ url('users/update/' . $users->id) }}" method="post" name="userForm"   enctype="multipart/form-data">
        @method('PUT')
    @else
        <form action="{{ url('users/store') }}" method="POST" enctype="multipart/form-data" id="form" name="userForm" onsubmit="return registerValidateForm()">
    @endif
    @csrf
    <div class="row">
      <div class="col-sm">
        <div class="mb-6">
            <label for="first_name" class="form-label">First name</label>
            <input type="text" class="form-control" id="first_name"  value="{{ old('first_name', $users->first_name ?? '') }}" name="first_name">
              @if ($errors->has('first_name'))
                      <li>{{ $errors->first('first_name') }}</li>
              @endif
              <span id="First_name"></span>
        </div>
      </div>
      <div class="col-sm">
        <div class="mb-6">
            <label for="last_name" class="form-label">Last name</label>
            <input type="text" class="form-control" id="last_name" value="{{ old('last_name', $users->last_name ?? '') }}" name="last_name" value="{{ old('last_name') }}">
            @if ($errors->has('last_name'))
                    <li>{{ $errors->first('last_name') }}</li>
            @endif
            <span id="Last_name"></span>
        </div>
      </div>
    </div>

    <div class="row">
        <div class="col-sm">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $users->email ?? '') }}">
                @if ($errors->has('email'))
                        <li>{{ $errors->first('email') }}</li>
                @endif
                <span id="Email_ids"></span>
            </div>
        </div>
    </div>

    <div class="row">
        @if (!isset($users))
            <div class="col-sm">
                <div class="mb-3" >
                    <label for="password" class="form-label">Password</label>
                    <input type="password" autocomplete="off"  class="form-control" id="password" name="password" value="{{ old('password') }}">
                    @if ($errors->has('password'))
                        <li>{{ $errors->first('password') }}</li>
                    @endif
                    <span id="password12"></span>
                </div>

            </div>
            <div class="col-sm">
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" autocomplete="off" class="form-control" id="confirm_password" value="{{ old('confirm_password') }}" name="confirm_password">
                    @if ($errors->has('confirm_password'))
                            <li>{{ $errors->first('confirm_password') }}</li>
                    @endif
                    <span id="Confirm_pass"></span>
                </div>
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-sm">
            <div class="mb-3">
                <label for="dob" class="form-label">Dob</label>
                <input type="date" class="form-control" id="dob" value="{{ old('dob', $users->dob ?? '') }}" max="" name="dob">
                @if ($errors->has('dob'))
                    <li>{{ $errors->first('dob') }}</li>
                @endif
                <span id="Birth_date"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm">
            <div class="mb-3 centerGender">
                <label for="gender" class="form-label">Gender: </label>
                <input class="form-check-input" type="radio" id="Male"  name="gender" value="Male" @if(isset($users->gender) == 'Male' || old('gender') == 'Male') checked @endif > Male
                <input class="form-check-input" type="radio" id="Female"  name="gender" value="Female" @if(isset($users->gender) == 'Female' || old('gender') == 'Female') checked @endif> Female
                @if ($errors->has('gender'))
                    <li>{{ $errors->first('gender') }}</li>
                @endif
                <span id="radio"></span>
            </div>
        </div>
        <div class="col-sm">
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $users->phone ?? '') }}">
                @if ($errors->has('phone'))
                    <li>{{ $errors->first('phone') }}</li>
                @endif
                <span id="Phone_number"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm">
            <div class="mb-3">
                <label for="selectImage" class="form-label">Profile_pic</label>
                <input type="file" value="{{ old('profile_pic') }}" accept="image/*"  class="form-control" id="selectImage" name="profile_pic">
               @if(isset($users->profile_pic))
                    <img src="{{asset('storage/'. $users->profile_pic)}}" id="preview" class="UpdatepreviewImage" alt="" width="100" height="100">
                    @endif
                @if ($errors->has('profile_pic'))
                    <li>{{ $errors->first('profile_pic') }}</li>
                @endif

                <img id="preview" class="previewImages" width="100" height="100" src="#" alt="your image" class="mt-3"/>
                <span id="profile_image"></span>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm">
            <div class="mb-3 bottomButton">
                @if(isset($users))
                    <button type="submit" class="btn btn-primary" name="submit" value="submit" >Update</button>
                    <a class="btn btn-primary" href="{{ url('users/dashboard') }}">Back</a>
                    <a class="btn btn-primary" href="{{ url('change-password/'.$users->id) }}">Change Password</a>
                @else
                    <button type="submit" class="btn btn-primary" id="register" name="submit" value="submit">Submit</button>
                    <a class="btn btn-primary" href="{{ url('/') }}">login</a>
                @endif
            </div>
        </div>
    </div>

    </form>
</div>
<script>
    var currentDate = new Date();
    var maxDate = new Date(currentDate.getFullYear() - 18, currentDate.getMonth(), currentDate.getDate());
    var formattedMaxDate = maxDate.toISOString().split('T')[0];
    document.getElementById("dob").setAttribute("max", formattedMaxDate);
</script>
<script>
    selectImage.onchange = evt => {
        preview = document.getElementById('preview');
        preview.style.display = 'block';
        const [file] = selectImage.files
        if (file) {
            preview.src = URL.createObjectURL(file)
        }

    }
</script>

@endsection
