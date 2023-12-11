@extends('layout.app')
@section('title')
    User List
@endsection
<div class="text textLeft">
    <h3 class="mainHeading">Welecome to the dashboard : {{ Auth::user()->first_name }}</h3>
    <a class="btn btn-primary addLogout"
        href="{{ url('logout') }}">LogOut</a>
    <hr>
</div>
@section('content')

    <div class="container dashboardContainer">
        <a class="btn btn-primary addUserDashboard"
            href="{{ url('register') }}">Add User</a>
        <table id="example" class="display table-responsive w-100" data-order='[[ 0, "desc" ]]'>
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
                    {
                        data: 'dob', name: 'dob',
                        "render": function(data) {
                            return moment(data).format('DD-MM-YYYY');
                         },
                     },
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
                ],
                columnDefs: [ {
                    'targets': [7],
                    'orderable': false,
                }]
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
