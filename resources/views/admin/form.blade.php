@extends('admin.core')
@section('content')

    <div id="list">


        {!! Form::open(['url' => $route])!!}

        @foreach($fields as $field)
            @if($field['type']== 'drop_down')
                {{ Form::label(trans('app.select') )}}
                {{Form::select($field['key'],$field ['options'] )}}
                <br>
            @elseif($field['type'] == 'single_line')


                {{ Form::label($field['key'], trans('app.' . $field['key'])) }}
                {{Form::text($field['key'])}}
                <br>

            @elseif($field['type'] == 'check_box')

                @foreach($field['options'] as $option)

                {{ Form::label($option['title']) }}
                {{Form::checkbox($option['name'], $option['value'])}}
                <br>
                @endforeach


            @endif

        @endforeach





        {{ Form::submit('Create') }}
        {!! Form::close() !!}
    </div>

@endsection