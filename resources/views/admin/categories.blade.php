@extends('adminlte::page')

@section('htmlheader_title')
	Admin | Categories
@endsection


@section('main-content')
    <div class="row">
        <div  class="col-md-12">
            <h1 class="bordered-heading">
                All Categories
            </h1>
            <a style="margin-bottom: 20px;" href="/admin/categories/new-category" class="btn btn-primary"> New Category </a>
            <table class="table table-striped">
                <thead>
                <th>
                    Category Name (En)
                </th>
                <th>
                    Category Name (Ar)
                </th>
                <th>
                    Slug (En)
                </th>
                <th>
                    Slug (Ar)
                </th>
                <th colspan="2">
                    Actions
                </th>
                </thead>

                @forelse($categories as $cat)
                    <tr>
                        <td>
                            {{$cat->translate('en')->name}}
                        </td>
                        <td>
                            {{$cat->translate('ar')->name}}
                        </td>
                        <td>
                            {{$cat->translate('en')->slug}}
                        </td>
                        <td>
                            {{$cat->translate('ar')->slug}}
                        </td>
                        <td>
                            <a href="/admin/categories/{{$cat->id}}/edit" class="btn btn-warning"> Edit </a>

                        </td>
                        <td>

                            {!! Form::open(["action" => ["AdminController@deleteCategory", $cat->id]]) !!}
                            {!! Form::submit("Delete", ["class" => "btn btn-danger"]) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @empty
                    <p>No Categories Yet</p>
                @endforelse
            </table>
        </div>
    </div>
@endsection
