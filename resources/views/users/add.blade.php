<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>
<div class="container" style="margin-top: 40px">

     <h2>@if (isset($users)) Edit @else Add @endif User</h2>

        @if (isset($users))
            <form action="{{ url('users/update/' . $users->id) }}" method="post"  enctype="multipart/form-data">
            @method('PUT')
        @else
            <form action="{{ route('users/store') }}" method="POST" enctype="multipart/form-data">
        @endif

        @csrf
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">First name</label>
          <input type="text" class="form-control" id="first_name"  value="{{ old('first_name', $users->first_name ?? '') }}" name="first_name" aria-describedby="emailHelp">
            @if ($errors->has('first_name'))
                    <li style="color:red">{{ $errors->first('first_name') }}</li>
            @endif
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Last name</label>
            <input type="text" class="form-control" id="last_name" value="{{ old('last_name', $users->last_name ?? '') }}" name="last_name" value="{{ old('last_name') }}" aria-describedby="emailHelp">
            @if ($errors->has('last_name'))
                    <li style="color:red">{{ $errors->first('last_name') }}</li>
            @endif
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $users->email ?? '') }}" aria-describedby="emailHelp">
            @if ($errors->has('email'))
                    <li style="color:red">{{ $errors->first('email') }}</li>
            @endif
        </div>

    @if (isset($users))
        <div class="mb-3" style="display: none">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
            @if ($errors->has('password'))
                    <li style="color:red">{{ $errors->first('password') }}</li>
            @endif
        </div>

        <div class="mb-3" style="display:none">
            <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" value="{{ old('confirm_password') }}" name="confirm_password">
            @if ($errors->has('confirm_password'))
                    <li style="color:red">{{ $errors->first('confirm_password') }}</li>
            @endif
        </div>
    @else

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
            @if ($errors->has('password'))
                <li style="color:red">{{ $errors->first('password') }}</li>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" value="{{ old('confirm_password') }}" name="confirm_password">
            @if ($errors->has('confirm_password'))
                    <li style="color:red">{{ $errors->first('confirm_password') }}</li>
            @endif
        </div>
    @endif

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Dob</label>
            <input type="date" class="form-control" id="dob" value="{{ old('dob', $users->dob ?? '') }}" name="dob">
            @if ($errors->has('dob'))
                <li style="color:red">{{ $errors->first('dob') }}</li>
            @endif
        </div>

    @if (isset($users))
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Gender: </label>
            <input class="form-check-input" type="radio" id="Male"  name="gender" value="Male" {{ $users->gender == 'Male' ? 'checked' : '' }} > Male
            <input class="form-check-input" type="radio" id="Female"  name="gender" value="Female" {{ $users->gender == 'Female' ? 'checked' : '' }}> Female
            @if ($errors->has('gender'))
                <li style="color:red">{{ $errors->first('gender') }}</li>
            @endif
        </div>
    @else
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Gender: </label>
            <input class="form-check-input" type="radio" id="Male"  name="gender" value="Male" @if(old('gender') == 'Male') checked @endif > Male
            <input class="form-check-input" type="radio" id="Female"  name="gender" value="Female" @if(old('gender') == 'Female') checked @endif > Female
            @if ($errors->has('gender'))
                <li style="color:red">{{ $errors->first('gender') }}</li>
            @endif
        </div>
    @endif

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $users->phone ?? '') }}">
            @if ($errors->has('phone'))
                <li style="color:red">{{ $errors->first('phone') }}</li>
            @endif
        </div>
    @if (isset($users))
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Profile_pic</label>
            <input
                type="file"
                name="profile_pic"
                id="selectImage"
                accept="image/*"
                class="form-control"
            /><br/>
            <img src="{{asset('uploads/'. $users->profile_pic)}}" id="preview" alt="" width="100" height="100">
            @if ($errors->has('profile_pic'))
                <li style="color:red">{{ $errors->first('profile_pic') }}</li>
            @endif
        </div>
    @else

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Profile_pic</label>
        <input type="file" value="{{ old('profile_pic') }}" accept="image/*"  class="form-control" id="selectImage" name="profile_pic">
        @if ($errors->has('profile_pic'))
            <li style="color:red">{{ $errors->first('profile_pic') }}</li>
        @endif

        <img id="preview" width="100" height="100" src="#" alt="your image" class="mt-3" style="display:none;"/>

    </div>

    @endif

        <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
      </form>
</div>

</body>



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
</html>
