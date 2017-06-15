@extends('admin.core')
@section('content')

    <div id="list">


        {!! Form::open(['url' => $route])!!}

        @foreach($fields as $field)
            {{ Form::label($field['key'], trans('app.' . $field['key'])) }}
            @if($field['type']== 'drop_down')
                @if($field['key'] == 'language_code')





                        {{Form::select($field['key'],$field ['options'] )}}
                    <br>


                @else
                    {{Form::select($field['key'],$field ['options'], null,['placeholder'] )}}
                    <br>
                @endif

            @elseif($field['type'] == 'single_line')


                @if(isset($record[$field['key']]))
                    {{Form::text($field['key'], $record[$field['key']])}}
                @else
                    {{Form::text($field['key'])}}
                    <br>
                @endif


            @elseif($field['type'] == 'check_box')

                @foreach($field['options'] as $option)

                    {{Form::checkbox($option['name'], $option['value'])}}
                    <br>
                @endforeach


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