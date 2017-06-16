@extends('admin.core')
@section('content')

    <div id="list">


        {!! Form::open(['url' => $route])!!}

        @foreach($fields as $field)
            {{ Form::label($field['key'], trans('app.' . $field['key'])) }}



            @if($field['type']== 'drop_down')
                @if(isset($record[$field['key']]))
                    @if($field['key'] == 'language_code')

                        {{Form::select($field['key'], $field ['options'], $record[$field['key']] )}}
                        <br>
                    @else

                        {{Form::select($field['key'],$field ['options'],$record[$field['key']] , null,['placeholder'] )}}
                        <br>

                    @endif
                @else



                    @if($field['key'] == 'language_code')

                        {{Form::select($field['key'], $field ['options'])}}
                        <br>
                    @else

                        {{Form::select($field['key'],$field ['options'], null,['placeholder'] )}}
                        <br>

                    @endif



                @endif



            @elseif($field['type'] == 'single_line')

                @if(isset($record[$field['key']]))
                    @if($field['key'] == 'description_long')
                        {{Form::textarea($field['key'], $record[$field['key']])}}
                        <br>
                    @else
                        {{Form::text($field['key'],$record[$field['key']])}}
                        <br>
                    @endif
                @endif

                @if($field['key']=='description_long')
                    {{Form::textarea($field['key'])}}
                    <br>
                @else
                    {{Form::text($field['key'])}}
                    <br>
                @endif


            @elseif($field['type'] == 'check_box')

                @if(isset($record[$field['key']]))

                    @foreach($field['options'] as $option)
                        {{Form::checkbox($option['name'], $option['value'], $record[$field['key']])}}
                        <br>
                    @endforeach

                @else

                    @foreach($field['options'] as $option)
                        {{Form::checkbox($option['name'], $option['value'])}}
                        <br>
                    @endforeach
                @endif


            @endif


        @endforeach


        {{ Form::submit('Create') }}
        {!! Form::close() !!}
    </div>

@endsection
@section('scripts')
    <script>

        $('#language_code').bind(
            'change', function () {

                window.location.href = '?language_code=' + $('#language_code').val();
                $('#language_code').val()
            }
        )


        // console.log($('#language_code'));

    </script>
@endsection