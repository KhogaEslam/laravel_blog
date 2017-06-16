@extends('adminlte::page')

@section('htmlheader_title')
	Admin | Users
@endsection


@section('main-content')
    <div class="row">
        <div  class="col-md-12">
            <h1 class="bordered-heading">
                All Users
            </h1>
            <div>
                <a href="/admin/users/new-user" class="btn btn-primary"> New User </a>
            </div>
            <table class="table table-striped">
                <thead>
                <th>
                    User Name
                </th>
                <th>
                    Email Address
                </th>
                <th colspan="2">
                    Actions
                </th>
                </thead>
                @foreach($users as $user)
                    <tr>

                        <td>
                            {{$user->name}}
                        </td>
                        <td>
                            {{$user->email}}
                        </td>
                        <td>
                            <a href="/admin/users/{{$user->id}}/edit" class="btn btn-warning"> Edit </a>
                        </td>
                        <td>
                            {!! Form::open(["action" => ["AdminController@deleteUser", $user->id]]) !!}
                            {!! Form::submit("Delete", ["class" => "btn btn-danger"]) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
