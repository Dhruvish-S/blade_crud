@extends('layout.app')
    @section('title') @if (isset($users)) Change password @endif @endsection
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

        <form method="post" action="{{ url('postChangePassword/' . $id) }}" onsubmit="return changePassword()">
            @csrf
            <div class="mb-3">
                <label for="oldpassword" class="form-label">Current Password</label>
                <input type="password" class="form-control" id="current_password" name="current_password">
                <span id="odPassword"></span>
            </div>
            <div class="mb-3">
                <label for="newpassword" class="form-label">New Password</label>
                <input type="password" class="form-control" name="password" id="password">
                <span id="nPassword"></span>
            </div>
            <div class="mb-3">
                <label for="confirmpassword" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                <span id="cPassword"></span>
            </div>
            <button type="submit" class="btn btn-primary" name="submitButton">Submit</button>
        </form>
    </div>
@endsection
