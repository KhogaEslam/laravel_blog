@extends('layouts.empty')

@section('main-content')
@forelse($categories as $category)
    <p class="panel panel-default">
    <p class="panel-heading">
        <a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
    </p>
    </p>
@empty
    <p class="panel panel-default">
    <p class="panel-heading">
        No categories Found!
    </p>
    </p>
@endforelse
@endsection