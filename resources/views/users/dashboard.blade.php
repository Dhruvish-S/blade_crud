@extends('layout.app')

@section('content')
<title>Dashboard</title>
<body>
    <div class="container">
        <a class="btn btn-primary" style="float: right; margin-right: 10px;margin-top:10px;margin-bottom:30px;" href="{{ url('register')}}">Add User</a>

        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>id</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Dob</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Profile Pic</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->dob }}</td>
                    <td>{{ $user->gender }}</td>
                    <td>{{ $user->phone }}</td>
                    <td><img src="{{asset('uploads/'. $user->profile_pic)}}" alt="profile_pic" title="profile_pic" width="100" height="150"></td>
                    <td>
                        <a class="btn btn-success" href="{{ url('users/edit', $user->id) }}">Edit</a>
                        <a class="btn btn-danger" href="{{ url('users/delete', $user->id) }}" onclick="return confirm('Are you sure want to delete?')">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</body>
</html>
@endsection
