@extends('adminlte::page')

@section('htmlheader_title')
    Admin | New User
@endsection


@section('main-content')
    <h1 class="bordered-heading">
        New User
    </h1>
    {!! Form::open(["action" => ["AdminController@createUser"]]) !!}
    @include("admin._user", ["submitButton" => "Add new User", "edit" => false])
    {!! Form::close() !!}
@endsection
