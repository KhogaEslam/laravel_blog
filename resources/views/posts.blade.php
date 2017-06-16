@extends('layouts.empty')

@section('main-content')
@forelse ($posts as $post)
    <p class="panel panel-default">
        <p class="panel-heading">
            <a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a>
        </p>

        <p class="panel-body">
            {{ \Illuminate\Support\Str::words($post->description,10) }}
        </p>
        <p class="panel-footer text-right">
            <a href="{{ route('post.show', $post->id) }}">
                {{ trans('app.view_more') }}
            </a>
        </p>
    </p>
@empty
    <p class="panel panel-default">
    <p class="panel-heading">
        No Posts Yet!
    </p>
@endforelse

@endsection