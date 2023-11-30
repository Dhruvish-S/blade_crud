@extends('layout.app')
@section('title') User Register | Edit @endsection
@section('content')
<style>
@media only screen and (min-width: 600px) {
    .container {
        max-width: 900px;
    }
}
</style>
<div class="container" style="border:2px solid black">
    <h2 style="margin:30px">@if (isset($users)) Edit @else Add @endif User</h2>
    @if (isset($users))
        <form action="{{ url('users/update/' . $users->id) }}" method="post" name="userForm"  enctype="multipart/form-data">
        @method('PUT')
    @else
        <form action="{{ url('users/store') }}" method="POST" enctype="multipart/form-data" id="form" name="userForm" onsubmit="return validateForm()">
    @endif
    @csrf
    <div class="row">
      <div class="col-sm">
        <div class="mb-6">
            <label for="first_name" class="form-label">First name</label>
            <input type="text" class="form-control" id="first_name"  value="{{ old('first_name', $users->first_name ?? '') }}" name="first_name">
              @if ($errors->has('first_name'))
                      <li style="color:red">{{ $errors->first('first_name') }}</li>
              @endif
              <span id="firstname" style="color:blue; font-weight:500"> </span>
        </div>
      </div>
      <div class="col-sm">
        <div class="mb-6">
            <label for="last_name" class="form-label">Last name</label>
            <input type="text" class="form-control" id="last_name" value="{{ old('last_name', $users->last_name ?? '') }}" name="last_name" value="{{ old('last_name') }}">
            @if ($errors->has('last_name'))
                    <li style="color:red">{{ $errors->first('last_name') }}</li>
            @endif
            <span id="lastname" style="color:blue; font-weight:500"> </span>
        </div>
      </div>
    </div>

    <div class="row">
        <div class="col-sm">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $users->email ?? '') }}">
                @if ($errors->has('email'))
                        <li style="color:red">{{ $errors->first('email') }}</li>
                @endif
                <span id="emailids" style="color:blue; font-weight:500"> </span>
            </div>
        </div>
    </div>

    <div class="row">
        @if (!isset($users))
            <div class="col-sm">
                <div class="mb-3" >
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                    @if ($errors->has('password'))
                        <li style="color:red">{{ $errors->first('password') }}</li>
                    @endif
                </div>
                <span id="password12" style="color:blue; font-weight:500"></span>
            </div>
            <div class="col-sm">
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" value="{{ old('confirm_password') }}" name="confirm_password">
                    @if ($errors->has('confirm_password'))
                            <li style="color:red">{{ $errors->first('confirm_password') }}</li>
                    @endif
                    <span id="confrmpass" style="color:blue; font-weight:500"> </span>
                </div>
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-sm">
            <div class="mb-3">
                <label for="dob" class="form-label">Dob</label>
                {{-- <input type="date" class="form-control" id="dob" value="{{ old('dob', $users->dob ?? '') }}" max="{{ isset($yearDifference) ?? Date('d-m-Y') }}" name="dob"> --}}
                <input type="date" class="form-control" id="dob" value="{{ old('dob', $users->dob ?? '') }}" max="" name="dob">
                @if ($errors->has('dob'))
                    <li style="color:red">{{ $errors->first('dob') }}</li>
                @endif
                <span id="birthdate" style="color:blue; font-weight:500"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm">
            <div class="mb-3" style="margin-top:30px">
                <label for="gender" class="form-label">Gender: </label>
                <input class="form-check-input" type="radio" id="Male"  name="gender" value="Male" @if(isset($users->gender) == 'Male' || old('gender') == 'Male') checked @endif > Male
                <input class="form-check-input" type="radio" id="Female"  name="gender" value="Female" @if(isset($users->gender) == 'Female' || old('gender') == 'Female') checked @endif> Female
                @if ($errors->has('gender'))
                    <li style="color:red">{{ $errors->first('gender') }}</li>
                @endif
                <span id="radio" style="color:blue; font-weight:500"></span>
            </div>
        </div>
        <div class="col-sm">
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $users->phone ?? '') }}">
                @if ($errors->has('phone'))
                    <li style="color:red">{{ $errors->first('phone') }}</li>
                @endif
                <span id="phonenumber" style="color:blue; font-weight:500"> </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm">
            <div class="mb-3">
                <label for="selectImage" class="form-label">Profile_pic</label>
                <input type="file" value="{{ old('profile_pic') }} ||" accept="image/*"  class="form-control" id="selectImage" name="profile_pic">
               @if(isset($users->profile_pic))
                    <img src="{{asset('uploads/'. $users->profile_pic)}}" id="preview" alt="" width="100" height="100">
                @endif
                @if ($errors->has('profile_pic'))
                    <li style="color:red">{{ $errors->first('profile_pic') }}</li>
                @endif

                <img id="preview" width="100" height="100" src="#" alt="your image" class="mt-3" style="display:none;"/>
                <span id="profile_image" style="color:blue; font-weight:500"> </span>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm">
            <div class="mb-3" style="margin-top:30px">
                @if(isset($users))
                    <button type="submit" class="btn btn-primary" name="submit" value="submit" >Update</button>
                    <a class="btn btn-primary" href="{{ url('users/dashboard') }}">Back</a>
                @else
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                    <a class="btn btn-primary" href="{{ url('/') }}">login</a>
                @endif
            </div>
        </div>
    </div>


    </form>
</div>

</body>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script>
    var currentDate = new Date();
    var maxDate = new Date(currentDate.getFullYear() - 18, currentDate.getMonth(), currentDate.getDate());
    var formattedMaxDate = maxDate.toISOString().split('T')[0];
    document.getElementById("dob").setAttribute("max", formattedMaxDate);
</script>
{{--
    <script>
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('dob').setAttribute('max', today);
    </script> --}}

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

            // var pattern=/[0-9]{digit}/;
            var genValue = false;
            // var re = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;

            var regularExpression = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
            var isContainsUppercase = /^(?=.*[A-Z]).*$/;
            var isContainsLowercase = /^(?=.*[a-z]).*$/;
            var isContainsNumber = /^(?=.*[0-9]).*$/;
            var isContainsSymbol =/^(?=.*[~`!@#$%^&*()--+={}\[\]|\\:;"'<>,.?/_₹]).*$/;
            var isNonWhiteSpace = /^\S*$/;


// Firstname validation
            const errorMessage = (
                    first_name == "" ? "** Please fill the First name field" :
                    first_name.length <= 2 || first_name.length > 20 ? "*Firstname length must be between 2 and 20*" :
                    !isNaN(first_name) ? "** only characters are allowed" :
                    ""
            );
            document.getElementById('firstname').innerHTML = errorMessage;
            if(errorMessage != ""){
                return false;
            }
// Lastname validation
            const errorMessage1 = (
                last_name == "" ? "** Please fill the Last name field" :
                last_name.length <= 2 || last_name.length > 20 ? "*Lastname length must be between 2 and 20*" :
                    !isNaN(last_name) ? "** only characters are allowed" :
                    ""
            );
            document.getElementById('lastname').innerHTML = errorMessage1;
            if(errorMessage1 != ""){
                return false;
            }
// Email validation
            const errorMessage2 = (
                emails == "" ? "** Please fill the email" :
                emails.charAt(emails.length-4)!='.' && emails.charAt(emails.length-3)!='.' ? "*Invalid Position*" :
                    ""
            );
            document.getElementById('emailids').innerHTML = errorMessage2;
            if(errorMessage2 != ""){
                return false;
            }

// Password validation
            const errorMessage3 = (
                pass == "" ? "** Please fill the password field" :
                pass.length<8 ? "** Passwords length must be 8 Characters" :
                !isContainsUppercase.test(pass) ? "** one Uppercase are allowed" :
                !isContainsLowercase.test(pass) ? "** one Lowercase are allowed" :
                !isContainsNumber.test(pass) ? "** one Numbers are allowed" :
                !isContainsSymbol.test(pass) ? "** one Symbols are allowed" :
                !isNonWhiteSpace.test(pass) ? "** Whitespaces are not allowed" :
                ""
            );
            document.getElementById('password12').innerHTML = errorMessage3;
            if(errorMessage3 != ""){
                return false;
            }
// Confirm password validation
            const errorMessage4 = (
                confirmpass == "" ? "** Please fill the confirmpass field" :
                pass !=confirmpass ? "** Password does not match the confirm password" :
                confirmpass.length<8 ? "** confirmpass length must be 8 Characters" :
                ""
            );
            document.getElementById('confrmpass').innerHTML = errorMessage4;
            if(errorMessage4 != ""){
                return false;
            }

//Date of birth validation
        if(birthdate == ""){
            document.getElementById('birthdate').innerHTML =" ** Please fill the Date of birth field";
            return false;
        }
        // underAgeValidate(birthdate);

        var dobInput = document.getElementById("dob");
        var selectedDate = new Date(dobInput.value);
        var today = new Date();
        var age = today.getFullYear() - selectedDate.getFullYear();
        if (
            today.getMonth() < selectedDate.getMonth() ||
            (today.getMonth() === selectedDate.getMonth() && today.getDate() < selectedDate.getDate())
        ) {
            age--;
        }
        if (age < 18) {
            document.getElementById('birthdate').innerHTML = "** The date difference is less than -18 years";
            return false;
        }
        else{
            document.getElementById('birthdate').innerHTML ="";
        }

//Gender validation
        if (!document.querySelector('input[name="gender"]:checked')) {
                document.getElementById('radio').innerHTML = " ** Please select the gender";
        return false;
        }
        else{
            document.getElementById('radio').innerHTML = "";
        }
//Phone validation
            const errorMessage5 = (
                phone == "" ? "** Please add the Phone number" :
                isNaN(phone) ? "**  user must write digits only not characters" :
                phone.length!=10 ? "** Mobile Number must be 10 digits only" :
                ""
            );
            document.getElementById('phonenumber').innerHTML = errorMessage5;
            if(errorMessage5 != ""){
                return false;
            }

// Profile pic

            if(profile_pi == ""){
				document.getElementById('profile_image').innerHTML =" ** Please select image";
				return false;
			}
            var fileInput = document.getElementById("selectImage");
            var fileName = fileInput.value;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
            if (!allowedExtensions.exec(fileName)) {
                document.getElementById('profile_image').innerHTML = "** Only JPG, JPEG, and PNG files are allowed";
                return false;
            }

    }


    </script>
</html>
@endsection
