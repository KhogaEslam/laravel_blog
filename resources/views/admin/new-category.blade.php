@extends('adminlte::page')

@section('htmlheader_title')
    Admin | New Category
@endsection


@section('main-content')
    <h1 class="bordered-heading">
        New Category
    </h1>

    {!! TranslatableBootForm::open()->action(route('admin.create-category')) !!}
    @include("admin._category")
    {!! BootForm::submit('Submit') !!}
    {!! TranslatableBootForm::close() !!}

@endsection
