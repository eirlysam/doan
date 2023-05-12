@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                LIỆT KÊ USERS
            </h2>
            <?php
            $message = Session::get('message');
            if($message){
                echo $message;
                Session::put('message',null);
            }
            ?>
            
        </div>
        <div class="body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                        <tr>
                            <th>Tên user</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Password</th>
                            <th>Author</th>
                            <th>Admin</th>
                            <th>User</th>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tên user</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Password</th>
                            <th>Author</th>
                            <th>Admin</th>
                            <th>User</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($admin as $key => $user)
                        <form action="{{url('/assign-roles')}}" method="post">
                            @csrf
                            <tr>
                                <td>{{$user->admin_name}}</td>
                                <td>{{$user->admin_email}} <input type="hidden" name="admin_email" value="{{$user->admin_email}}"></td>
                                <td>{{$user->admin_phone}}</td>
                                <td>{{$user->admin_password}}</td>

                                <!-- <td><input type="checkbox" name="author_role" {{$user->hasRole('author') ? 'checked' : ''}}></td>
                                <td><input type="checkbox" name="admin_role" {{$user->hasRole('admin') ? 'checked' : ''}}></td>
                                <td><input type="checkbox" name="user_role" {{$user->hasRole('user') ? 'checked' : ''}}></td> -->
                                <!-- <td>
                                    <input type="checkbox" name="author_role" checked>
                                </td> -->
                                
                                <td align="center">
                                    <input type="submit" value="Assign-roles" class="btn btn-success">
                                </td>
                            </tr>
                        </form>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection