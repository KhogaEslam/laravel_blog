@extends('adminlte::page')

@section('htmlheader_title')
    Admin | Edit Post
@endsection


@section('main-content')
    <h1 class="bordered-heading">
        Edit Category
    </h1>
    {!! TranslatableBootForm::open()->action(route('admin.update-post',$post)) !!}
    {{ TranslatableBootForm::bind($post) }}
    @include("admin._post")
    {!! BootForm::submit('Submit') !!}
    {!! TranslatableBootForm::close() !!}
@endsection
