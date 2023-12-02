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
    <div class="container" style="border:none">
        <a class="btn btn-primary addUserDashboard"
            href="{{ url('register') }}">Add User</a>
        <a class="btn btn-primary addLogoutDashboard"  href="{{ url('logout') }}">LogOut</a>
        <table id="example" class="display table-responsive w-100">
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
            <tbody></tbody>
        </table>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users/dashboard') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'first_name', name: 'first_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'email', name: 'email' },
                    { data: 'dob', name: 'dob' },
                    { data: 'gender', name: 'gender' },
                    { data: 'phone', name: 'phone' },
                    {
                        "data": "profile_pic",
                        "render": function (data) {
                            var img =  data;
                            return '<img src='+img+' width="40px">';
                        }
                    },
                    { data: 'action', name: 'action', orderable: false, searchable: false},
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
