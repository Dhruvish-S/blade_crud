@extends('layout.app')
@section('title') User Login @endsection
@section('content')

<div class="container" style="margin-top:40px">
    <a class="btn btn-primary" style="float:right"  href="{{ url('register')}}">Add User</a>
    <h1>Login Form</h1>
    <form method="post" action="{{ url('login') }}" onsubmit="return validateForm()">
        @csrf
        @if(Session::has('fail'))
            <div class="alert alert-danger">
                {{ Session::get('fail') }}
            </div>
        @endif
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" aria-describedby="emailHelp">
            <span class="text-danger">@error('email'){{ $message }}
            @enderror</span>
            <span id="emailids" style="color:blue; font-weight:500"></span>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" value="{{ old('password') }}" name="password">
         <span class="text-danger">@error('password'){{ $message }}@enderror</span>
         <span id="password12" style="color:blue; font-weight:500"></span>
        </div>
        <button type="submit" class="btn btn-primary" name="submitButton">Submit</button>
    </form>
</div>
@endsection

