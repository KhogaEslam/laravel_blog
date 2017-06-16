@extends('adminlte::page')

@section('htmlheader_title')
    Admin | Edit Category
@endsection


@section('main-content')
    <h1 class="bordered-heading">
        Edit Category
    </h1>
    {!! TranslatableBootForm::open()->action(route('admin.update-category',$category)) !!}
    {{ TranslatableBootForm::bind($category) }}
    @include("admin._category")
    {!! BootForm::submit('Submit') !!}
    {!! TranslatableBootForm::close() !!}
@endsection
