@extends('layout.app')
@section('title') @if (isset($users)) Edit @else Add @endif User @endsection
@section('content')

<div class="container registerContainer">
    <h2>@if (isset($users)) Edit @else Add @endif User</h2>
    @if (isset($users))
        <form action="{{ url('users/update/' . $users->id) }}" method="post" name="userForm" id="form"   enctype="multipart/form-data" onsubmit="return registerValidateForm()">
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
              <span id="First_nameUpdate"></span>
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
                <input type="date" class="form-control" onchange="validateAge()" id="dob" value="{{ old('dob', $users->dob ?? '') }}"  name="dob">
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
                @if(isset($users->gender))

                    <input class="form-check-input" type="radio" id="Female"  name="gender" value="Female" @if($users->gender == 'Female' ) checked @endif> Female
                    <input class="form-check-input" type="radio" id="Male"  name="gender" value="Male" @if($users->gender == 'Male' ) checked @endif > Male
                @else
                    <input class="form-check-input" type="radio" id="Female"  name="gender" value="Female" @if(old('gender') == 'Female') checked @endif> Female
                    <input class="form-check-input" type="radio" id="Male"  name="gender" value="Male" @if(old('gender') == 'Male') checked @endif > Male
                @endif

                {{-- <input class="form-check-input" type="radio" id="Female"  name="gender" value="Female" @if(isset($users->gender) == 'Female'  || old('gender') == 'Female') checked @endif> Female
                <input class="form-check-input" type="radio" id="Male"  name="gender" value="Male" @if(isset($users->gender) == 'Male' || old('gender') == 'Male') checked @endif > Male --}}
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
                    <button type="submit" class="btn btn-primary" name="submit" value="submit" id="update">Update</button>
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
    let users = '';
    @isset($users)
         users = {!! json_encode($users) !!};
    @endisset
         console.log(users == '');
         console.log(users['id']);
         console.log(users);
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
{{-- Email exist or not validation --}}

<script>
    $(document).ready(function(){

     $('#email').blur(function(){
      var Email_ids = '';
      var email = $('#email').val();
      var _token = $('input[name="_token"]').val();
      var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      if(!filter.test(email))
      {
            $('#Email_ids').html('<label class="textColorAjax">Invalid Email</label>');
            $('#email').addClass('has-error');
            $('#register').attr('disabled', 'disabled');
            $('#update').attr('disabled', 'disabled');
      }
      else
      {
        $.ajax({
            url:"/checkUniqueEmail",
            method:"POST",
            data:{email:email, _token:_token, editUserId:users['id']},

            success:function(result)
            {
                if(result.isUnique === true)
                {
                    $('#Email_ids').html('');
                    $('#email').removeClass('has-error');
                    $('#register').attr('disabled', false);
                    $('#update').attr('disabled', false);
                }
                else
                {
                    $('#Email_ids').html('<label class="textColorAjax">Email is exist</label>');
                    $('#email').addClass('has-error');
                    $('#register').attr('disabled', 'disabled');
                    $('#update').attr('disabled', 'disabled');
                }
            }
        })
      }
     });

    });
    </script>

    {{-- dateofbirth select 18 years --}}
<script>
    $(function(){
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;// jan=0; feb=1 .......
        var day = dtToday.getDate();
        var year = dtToday.getFullYear() - 18;
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
    	var minDate = year + '-' + month + '-' + day;
        var maxDate = year + '-' + month + '-' + day;
    	$('#dob').attr('max', maxDate);
    });
</script>

<script>
    function validateAge() {
      var selectedDate = new Date(document.getElementById('dob').value);
      var minDate = new Date();
      minDate.setFullYear(minDate.getFullYear() - 18);
      if (selectedDate > minDate) {
        document.getElementById('dob').value = '';
        $('#Birth_date').html('<label class="textColorAjax">The date difference is less than -18 years ...</label>');
      }
    }
  </script>

@endsection
