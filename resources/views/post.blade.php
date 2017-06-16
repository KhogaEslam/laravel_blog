@extends('layouts.empty')

@section('main-content')

    <h1>{{ $post->title }}</h1>

    <div class="panel panel-default">

        @if($post->image)
            <div class="thumbnail originalImg">
                <img class="bigger" src="{{route("image", [$post->image])}}">
            </div>
        @endif
        <div class="panel-body">
            {{ $post->description }}
        </div>
    </div>

@endsection