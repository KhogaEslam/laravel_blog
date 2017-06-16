@extends('adminlte::page')

@section('htmlheader_title')
    Admin | Posts
@endsection


@section('main-content')
    <div class="row">
        <div  class="col-md-12">
            <h1 class="bordered-heading">
                All Posts
            </h1>
            <a style="margin-bottom: 20px;" href="/admin/posts/new-post" class="btn btn-primary"> New Post </a>
            <table class="table table-striped">
                <thead>
                <th>
                    Post Title (En)
                </th>
                <th>
                    Post Title (Ar)
                </th>
                <th>
                    Category (En)
                </th>
                <th>
                    Category (Ar)
                </th>
                <th>
                    Description (En)
                </th>
                <th>
                    Description (Ar)
                </th>
                <th>
                    Image
                </th>
                <th colspan="2">
                    Actions
                </th>
                </thead>

                @forelse($posts as $post)
                    <tr>
                        <td>
                            {{$post->translate('en')->title}}
                        </td>
                        <td>
                            {{$post->translate('ar')->title}}
                        </td>
                        <td>
                            {{$post->category()->get()->first()->translate('en')->name}}
                        </td>
                        <td>
                            {{$post->category()->get()->first()->translate('ar')->name}}
                        </td>
                        <td>
                            {{$post->translate('en')->description}}
                        </td>
                        <td>
                            {{$post->translate('ar')->description}}
                        </td>
                        <td>
                            <img src="{{route("image", [$post->image])}}" style="width:auto;height:50px;display: block;text-align:center;margin-right:auto;margin-left:auto" alt="No image provided">
                        </td>
                        <td>
                            <a href="/admin/posts/{{$post->id}}/edit" class="btn btn-warning"> Edit </a>

                        </td>
                        <td>

                            {!! Form::open(["action" => ["AdminController@deletePost", $post->id]]) !!}
                            {!! Form::submit("Delete", ["class" => "btn btn-danger"]) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @empty
                    <p>No Posts Yet</p>
                @endforelse
            </table>
        </div>
    </div>
@endsection
