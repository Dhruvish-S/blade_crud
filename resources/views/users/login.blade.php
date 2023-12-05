@extends('layout.app')
@section('title')
    User Login
@endsection
@section('content')
    <div class="container">
        <a class="btn btn-primary addUsers" href="{{ url('register') }}">Add User</a>
        <h2>Login Form</h2>
        <form method="post" action="{{ url('login') }}" onsubmit="return validateForm()">
            @csrf
            @if (Session::has('fail'))
                <div class="alert alert-danger">
                    {{ Session::get('fail') }}
                </div>
            @endif
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                    aria-describedby="emailHelp">
                <span class="text-danger">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
                <span id="email_ids"></span>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" value="{{ old('password') }}" name="password">
                <span class="text-danger">
                    @error('password')
                        {{ $message }}
                    @enderror
                </span>
                <span id="password12"></span>
            </div>
            <button type="submit" class="btn btn-primary" name="submitButton">Submit</button>
        </form>
    </div>
@endsection
