@extends('adminlte::page')

@section('htmlheader_title')
    Admin | Edit User
@endsection


@section('main-content')
    <h1 class="bordered-heading">
        Edit User
    </h1>
    {!! Form::model($user,["action" => ["AdminController@updateUser", $user]]) !!}
    @include("admin._user", ["submitButton" => "Edit User", "edit" => false])
    {!! Form::close() !!}
@endsection
