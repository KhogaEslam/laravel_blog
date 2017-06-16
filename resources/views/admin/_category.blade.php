{!! TranslatableBootForm::text('Name', 'name')->required()->unique() !!}
{!! TranslatableBootForm::text('Slug', 'slug')->required()->unique() !!}


@foreach($errors->all() as $error)
    <p>{{$error}}</p>
@endforeach