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


                {{ Form::label($field['key'], trans('app.' . $field['key'])) }}
                {{Form::checkbox('key', 'value')}}
                <br>



            @endif

        @endforeach





        {{ Form::submit('Create') }}
        {!! Form::close() !!}
    </div>

@endsection