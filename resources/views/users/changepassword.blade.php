@extends('layout.app')
@section('title')
    User Change Password
@endsection
<div class="text textLeft">
    <h3 class="mainHeading">Welecome to the dashboard : {{ Auth::user()->first_name }}</h3>
    <hr>
</div>
@section('content')

    <div class="container changePassword">
        <a class="btn btn-primary backButton" href="{{ url('users/dashboard') }}">Back</a>
        <h1>Change password</h1>
        @if (session('message'))
            <h5 class="alert alert-success mb-2">{{ session('message') }}</h5>
        @endif

        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="post" name="changePasswordForm" id="changePasswordForm" action="{{ url('postChangePassword/' . $id) }}" onsubmit="return changePassword()">
            @csrf
            <div class="mb-3">
                <label for="oldpassword" class="form-label">Current Password</label>
                <input type="password" class="form-control" id="current_password" name="current_password" autocomplete="off">
                <i class="bi bi-eye-slash togglePassword" id="togglePassword"></i>
                <span id="odPassword"></span>
            </div>
            <div class="mb-3">
                <label for="newpassword" class="form-label">New Password</label>
                <input type="password" class="form-control" name="password" id="password" autocomplete="off">
                <i class="bi bi-eye-slash togglePassword" id="togglePassword1"></i>
                <span id="nPassword"></span>
            </div>
            <div class="mb-3">
                <label for="confirmpassword" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" autocomplete="off">
                <i class="bi bi-eye-slash togglePassword" id="togglePassword2"></i>
                <span id="cPassword"></span>
            </div>
            <button type="submit" class="btn btn-primary" name="submitButton">Submit</button>
        </form>
    </div>
    {{-- Password Hide and Show --}}
    <script>

        // current password

                const togglePassword = document.querySelector("#togglePassword");
                const password = document.querySelector("#current_password");

                togglePassword.addEventListener("click", function () {
                    // toggle the type attribute
                    const type = password.getAttribute("type") === "password" ? "text" : "password";
                    password.setAttribute("type", type);

                    // toggle the icon
                    this.classList.toggle("bi-eye");
                });

        // New password

                const togglePassword1 = document.querySelector("#togglePassword1");
                const password1 = document.querySelector("#password");

                togglePassword1.addEventListener("click", function () {
                    // toggle the type attribute
                    const type = password1.getAttribute("type") === "password" ? "text" : "password";
                    password1.setAttribute("type", type);

                    // toggle the icon
                    this.classList.toggle("bi-eye");
                });

        // Confirm Password

                const togglePassword2 = document.querySelector("#togglePassword2");
                const password2 = document.querySelector("#password_confirmation");

                togglePassword2.addEventListener("click", function () {
                    // toggle the type attribute
                    const type = password2.getAttribute("type") === "password" ? "text" : "password";
                    password2.setAttribute("type", type);

                    // toggle the icon
                    this.classList.toggle("bi-eye");
                });


    </script>
@endsection
