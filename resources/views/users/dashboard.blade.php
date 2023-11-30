@extends('layout.app')
@section('title')
    User List
@endsection

@section('content')
    <style>

        @media only screen and (min-width: 600px) {
            .container .table-responsive {
                padding: 20px;
                margin-left:-50px;
            }
            .table-responsive table {
                width: 100%;
                max-width: 100%;

            }
            table.dataTable{
                padding: 40px;
                margin-left:-50px;
            }
            .addUser{
                float: right;
            }

        }

        .container {
            margin-left: 6% !important;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table-responsive table {
            width: 100%;
            max-width: 100%;

        }
         table.dataTable{
                padding: 0px;
                margin-left:0px;
            }
    </style>

    <div class="container">
        <a class="btn btn-primary addUser" style="float: right; margin-right: 10px;margin-top:10px;margin-bottom:30px;"
            href="{{ url('register') }}">Add User</a>

        <table id="example" class="display table-responsive" style="width:100%">
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
                {{-- @foreach ($users as $user) --}}
                {{-- <tr> --}}
                {{-- <td>{{ $user->id }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->dob }}</td>
                    <td>{{ $user->gender }}</td>
                    <td>{{ $user->phone }}</td>
                    <td><img src="{{asset('uploads/'. $user->profile_pic)}}" alt="profile_pic" title="profile_pic" width="100" height="150"></td> --}}
                {{-- <td> --}}
                {{-- <a class="btn btn-success btn" href="{{ url('users/edit', $user->id) }}">Edit</a> --}}
                {{-- <a class="btn btn-danger" href="{{ url('users/delete', $user->id) }}" onclick="return confirm('Are you sure want to delete?')">Delete</a> --}}

                {{-- <a href="javascript:void(0);" data-href="{{ url('users/delete', $user->id) }}" class="btn btn-danger delete btn">Delete</a> --}}

                {{-- </td> --}}
                {{-- </tr> --}}
                {{-- @endforeach --}}
            </tbody>
        </table>
    </div>



    {{-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users/dashboard') }}",

                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'first_name',
                        name: 'first_name'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'dob',
                        name: 'dob'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        "data": "profile_pic",
                        "render": function (data) {
                            var img =  data;
                            return '<img src='+img+' width="40px">';
                        }

                    },
                    {
                        data: 'action',
                        name: 'action',

                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });
    </script>
    {{-- delete button click open sweet alert --}}
    <script>
        $(document).ready(function(){
            $(document).on('click', ".delete", function() {
                var id = $(this).attr("data-id") ;
                var _href = "{{ url('users/delete/') }}/"+id;
                swal({
                    title: "Are you sure want to delete user?",
                    text: "",
                    icon: "warning",
                    buttons: ["No, cancel!", "Yes, delete it!"],
                    dangerMode: true,

                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = _href;
                    }
                });
            });
        });

    </script>
@endsection
