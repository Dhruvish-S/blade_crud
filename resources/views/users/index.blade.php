<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>
    <div class="text" style="margin-bottom: 60px">
        <h1 style="margin: 20px">List Users</h1>
        <td><a class="btn btn-primary" style="float: right; margin-right: 50px" href="{{ url('register')}}">Add User</a></td>
    </div>

<div class="container">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">First name</th>
            <th scope="col">Last name</th>
            <th scope="col">Email</th>
            <th scope="col">Dob</th>
            <th scope="col">Gender</th>
            <th scope="col">Phone</th>
            <th scope="col">Profile Pic</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->dob }}</td>
                    <td>{{ $user->gender }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                        <img src="{{asset('uploads/'. $user->profile_pic)}}"width="100" height="150">
                    </td>
                    <td><a class="btn btn-success" href="{{ url('users/edit', $user->id) }}">Edit</a></td>
                    <td><a class="btn btn-danger" href="{{ url('users/delete', $user->id) }}" onclick="return confirm('Are you sure want to delete?')">Delete</a></td>

                </tr>
          @endforeach
        </tbody>
      </table>
</div>
</body>
</html>
