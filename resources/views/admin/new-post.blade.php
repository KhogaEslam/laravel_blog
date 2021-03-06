@extends('adminlte::page')

@section('htmlheader_title')
    Admin | New Post
@endsection


@section('main-content')
    <h1 class="bordered-heading">
        New Category
    </h1>

    {!! TranslatableBootForm::open()->action(route('admin.create-post'))->multipart() !!}
    @include("admin._post")
    {!! BootForm::submit('Submit') !!}
    {!! TranslatableBootForm::close() !!}

@endsection
