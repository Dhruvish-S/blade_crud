@extends('layout.app')
@section('title')
    Email Verification
@endsection
@section('content')
    <div class="d-flex justify-content-center align-items-center  w-100" style="height:500px;">
        <div class="bg-light box card" style="width: 500px; height: 400px;  box-shadow: 5px 4px 2px 3px;">
            <div class="icon" style="display: flex;align-items: center;justify-content: center;">
                <i class="bi bi-envelope" style="font-size: 46px;color: black;padding: 10px;"></i>
            </div>

            <h4 style="text-align: center;padding: 20px;color: blue; font-size: 30px;font-weight:800">Email Verification
            </h4>
            <p style="text-align: center;font-weight:800;font-size:16px;color:blue">Thanks for signup with us,click on
                the button below to <br />verify your email address.</p>
            <p style="text-align: center;font-weight:800;font-size:22px;color:blue">{{ $first_name }}
                {{ $last_name }}</p><br><br>
            <div class="button" style="display:flex;align-items: center;justify-content: center;">
                <a href="{{ url('verify/' . $id) }}"
                    style="font-weight:800;font-size:16px;color:white;background-color:black;padding:10px;border-radius:5px;">Verify
                    Email</a>
            </div>
        </div>
    </div>
@endsection
