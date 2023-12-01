@extends('layout.app')
@section('title') Change Password @endsection
@section('content')

<div class="container" style="margin-top:40px">
    <a class="btn btn-primary" style="float:right"  href="{{ url('users/dashboard')}}">Back</a>
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

    <form method="post" action="{{ url('postChangePassword/'.$id) }}">
        @csrf
        <div class="mb-3">
          <label for="oldpassword" class="form-label">Current Password</label>
          <input type="text" class="form-control" name="current_password">
        </div>
        <div class="mb-3">
          <label for="newpassword" class="form-label">New Password</label>
          <input type="text" class="form-control" name="password">
        </div>
        <div class="mb-3">
            <label for="confirmpassword" class="form-label">Confirm New Password</label>
            <input type="text" class="form-control" name="password_confirmation">
          </div>
        <button type="submit" class="btn btn-primary" name="submitButton">Submit</button>
    </form>
</div>
@endsection

