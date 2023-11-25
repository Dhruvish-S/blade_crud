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
            <form action="{{ url('users/update/' . $users->id) }}" method="post" name="userForm"  enctype="multipart/form-data">
            @method('PUT')
        @else
            <form action="{{ route('users/store') }}" method="POST" enctype="multipart/form-data" id="form" name="userForm" onsubmit="return validateForm()">
        @endif

        @csrf
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">First name</label>
          <input type="text" class="form-control" id="first_name"  value="{{ old('first_name', $users->first_name ?? '') }}" name="first_name" aria-describedby="emailHelp">
            @if ($errors->has('first_name'))
                    <li style="color:red">{{ $errors->first('first_name') }}</li>
            @endif
            <span id="firstname" style="color:blue; font-weight:500"> </span>
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Last name</label>
            <input type="text" class="form-control" id="last_name" value="{{ old('last_name', $users->last_name ?? '') }}" name="last_name" value="{{ old('last_name') }}" aria-describedby="emailHelp">
            @if ($errors->has('last_name'))
                    <li style="color:red">{{ $errors->first('last_name') }}</li>
            @endif
            <span id="lastname" style="color:blue; font-weight:500"> </span>
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $users->email ?? '') }}" aria-describedby="emailHelp">
            @if ($errors->has('email'))
                    <li style="color:red">{{ $errors->first('email') }}</li>
            @endif
            <span id="emailids" style="color:blue; font-weight:500"> </span>
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


        <span id="password12" style="color:blue; font-weight:500"></span>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" value="{{ old('confirm_password') }}" name="confirm_password">
            @if ($errors->has('confirm_password'))
                    <li style="color:red">{{ $errors->first('confirm_password') }}</li>
            @endif
            <span id="confrmpass" style="color:blue; font-weight:500"> </span>
        </div>
    @endif

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Dob</label>
            <input type="date" class="form-control" id="dob" value="{{ old('dob', $users->dob ?? '') }}" name="dob">
            @if ($errors->has('dob'))
                <li style="color:red">{{ $errors->first('dob') }}</li>
            @endif
            <span id="birthdate" style="color:blue; font-weight:500"> </span>
        </div>

    {{-- @if (isset($users))
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Gender: </label>
            <input class="form-check-input" type="radio" id="Male"  name="gender" value="Male" {{ $users->gender == 'Male' ? 'checked' : '' }} > Male
            <input class="form-check-input" type="radio" id="Female"  name="gender" value="Female" {{ $users->gender == 'Female' ? 'checked' : '' }}> Female
            @if ($errors->has('gender'))
                <li style="color:red">{{ $errors->first('gender') }}</li>
            @endif
        </div>
    @else --}}
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Gender: </label>
            <input class="form-check-input" type="radio" id="Male"  name="gender" value="Male" @if(old('gender') == 'Male') checked @endif > Male
            <input class="form-check-input" type="radio" id="Female"  name="gender" value="Female" @if(old('gender') == 'Female') checked @endif > Female
            @if ($errors->has('gender'))
                <li style="color:red">{{ $errors->first('gender') }}</li>
            @endif
            <span id="radio" style="color:blue; font-weight:500"></span>
        </div>

    {{-- @endif --}}

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $users->phone ?? '') }}">
            @if ($errors->has('phone'))
                <li style="color:red">{{ $errors->first('phone') }}</li>
            @endif
            <span id="phonenumber" style="color:blue; font-weight:500"> </span>
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
        <span id="profile_image" style="color:blue; font-weight:500"> </span>

    </div>

    @endif

        <button type="submit" class="btn btn-primary" name="submit" value="submit" id="btn">Submit</button>
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


        function validateForm()
        {
            var first_name = document.getElementById('first_name').value;
            var last_name = document.getElementById('last_name').value;
            var emails = document.getElementById('email').value;
            var pass = document.getElementById('password').value;
            var confirmpass = document.getElementById('confirm_password').value;
            var birthdate = document.getElementById('dob').value;
            var gender = document.getElementsByName('gender');
            var phone = document.getElementById('phone').value;
            var profile_pi = document.getElementById('selectImage').value;

            var pattern=/[0-9]{digit}/;
            var genValue = false;
            var re = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;


// Firstname validation

            if(first_name == ""){
				document.getElementById('firstname').innerHTML =" ** Please fill the First name field";
				return false;
			}else if((first_name.length <= 2) || (first_name.length > 20)) {
				document.getElementById('firstname').innerHTML =" *Firstname lenght must be between  2 and 20* ";
				return false;
			}else{
                document.getElementById('firstname').innerHTML ="";

            }

// Lastname validation

            if(last_name == ""){
				document.getElementById('lastname').innerHTML =" ** Please fill the Last name field";
				return false;
			}else if((last_name.length <= 2) || (last_name.length > 20)) {
				document.getElementById('lastname').innerHTML =" *Lastname lenght must be between  2 and 20* ";
				return false;
			}else{
                document.getElementById('lastname').innerHTML ="";

            }

// Email validation

            if(emails == ""){
				document.getElementById('emailids').innerHTML =" ** Please fill the email idx` field";
				return false;
			}
			else if(emails.indexOf('@') <= 0 ){
				document.getElementById('emailids').innerHTML =" ** @ Invalid Position";
				return false;
			}

			else if((emails.charAt(emails.length-4)!='.') && (emails.charAt(emails.length-3)!='.')){
				document.getElementById('emailids').innerHTML =" ** . Invalid Position";
				return false;
			}
            else{
                document.getElementById('emailids').innerHTML ="";
            }

// Password validation

            if(pass == ""){
				document.getElementById('password12').innerHTML =" ** Please fill the password field";
				return false;
			}
			else if((pass.length <= 5) || (pass.length > 20)) {
				document.getElementById('password12').innerHTML =" ** Passwords lenght must be between  5 and 20";
				return false;
			}
            else{
                document.getElementById('password12').innerHTML ="";
            }



// Confirm password validation

            if(pass!=confirmpass){
				document.getElementById('confrmpass').innerHTML =" ** Password does not match the confirm password";
				return false;
			}
			else if(confirmpass == ""){
				document.getElementById('confrmpass').innerHTML =" ** Please fill the confirmpassword field";
				return false;
			}
            else{
                document.getElementById('confrmpass').innerHTML ="";
            }

//Date of birth validation=


            // if(birthdate == ""){
            //     document.getElementById('birthdate').innerHTML =" ** Please fill the Date of birth field";
            //     return false;
            // }



        underAgeValidate(birthdate)


        return false

//Gender validation

        for(var i=0; i<gender.length;i++){
            if(gender[i].checked == true){
                genValue = true;
            }
        }
        if(!genValue){
            document.getElementById('radio').innerHTML =" ** Please select the gender";
            return false;
        }
        else{
            document.getElementById('radio').innerHTML ="";
        }

//Phone validation

            if(phone == ""){
				document.getElementById('phonenumber').innerHTML =" ** Please add the Phone number";
				return false;
			}
            else if(isNaN(phone)){
				document.getElementById('phonenumber').innerHTML =" ** user must write digits only not characters";
				return false;
			}
            else if(phone.length!=10){
				document.getElementById('phonenumber').innerHTML =" ** Mobile Number must be 10 digits only";
				return false;
			}
            else{
                document.getElementById('phonenumber').innerHTML ="";
            }

// Profile pic

            if(profile_pi == ""){
				document.getElementById('profile_image').innerHTML =" ** Please select image";
				return false;
			}
            var fileName = document.getElementById("selectImage").value,
                idxDot = fileName.lastIndexOf(".") + 1,
                extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
            if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
                alert('form submitted')
            }else{
                // alert("Only jpg/jpeg and png files are allowed!");
                document.getElementById('profile_image').innerHTML =" ** Only jpg/jpeg and png files are allowed";
                return false;
            }

    }

    function underAgeValidate(birthday) {

        var today = new Date();
        var nowyear = today.getFullYear();
        var nowmonth = today.getMonth();
        var nowday = today.getDate();
        // var b = document.getElementById('<%=TextBox2.ClientID%>').value;



        var birth = new Date(birthday);

        var birthyear = birth.getFullYear();
        var birthmonth = birth.getMonth();
        var birthday = birth.getDate();

        var age = nowyear - birthyear;
        var age_month = nowmonth - birthmonth;
        var age_day = nowday - birthday;


        if (age < 18) {
            alert("User date of birth not correct")
            return false;
        }
        if (age_month < 0 || (age_month == 0 && age_day < 0)) {
            age = parseInt(age) - 1;


        }
        if ((age == 18 && age_month <= 0 && age_day <= 0) || age < 18) {
            alert("Age should be more than 18 years.Please enter a valid Date of Birth");
            return false;
        }
    };

    </script>
</html>
