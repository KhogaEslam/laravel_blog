{!! TranslatableBootForm::text('Title', 'title')->required()->unique() !!}
{!! TranslatableBootForm::text('Description', 'description')->required()->unique() !!}
{!! BootForm::select('Category', 'category')->options(\App\Category::all()->pluck('name','id'))->required()->unique() !!}
{!! Form::file('image', array('multiple'=>false)) !!}

@foreach($errors->all() as $error)
    <p>{{$error}}</p>
@endforeach