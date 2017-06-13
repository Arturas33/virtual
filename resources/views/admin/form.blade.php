

@extends('admin.core')
@section('content')

<div id="list">




    {!! Form::open(['url' => $route])!!}

    @foreach($fields as $field)
        @if($field['type']== 'drop_down')
            {{Form::select($field['key'],$field ['options'] )}}
        @else

            {{Form::text($field['key'])}}

        @endif

    @endforeach





    {{ Form::submit('Create') }}
    {!! Form::close() !!}
</div>

@endsection