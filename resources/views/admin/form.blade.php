@extends('admin.core')
@section('content')

    <div id="list">


        {!! Form::open(['url' => $route, 'files' => true])!!}

        @foreach($fields as $field)
            {{ Form::label($field['key'], trans('app.' . $field['key'])) }}



            @if($field['type']== 'drop_down')
                @if(isset($record[$field['key']]))
                    @if($field['key'] == 'language_code' || $field['key'] == 'category_id' )

                        <div class="form-group">
                            {{Form::select($field['key'], $field ['options'], $record[$field['key']] )}}
                        </div>
                    @else
                        <div class="form-group">
                            {{Form::select($field['key'],$field ['options'], $record[$field['key']], ['placeholder' =>''] )}}
                        </div>

                    @endif
                @else

                    @if($field['key'] == 'language_code' || $field['key'] == 'category_id')
                        <div class="form-group">
                            {{Form::select($field['key'], $field ['options'])}}
                        </div>
                    @else
                        <div class="form-group">
                            {{Form::select($field['key'],$field ['options'], null, ['placeholder' =>''] )}}
                        </div>

                    @endif



                @endif



            @elseif($field['type'] == 'single_line')

                @if(isset($record[$field['key']]))
                    @if($field['key'] == 'description_long')
                        <div class="form-group">
                            {{Form::textarea($field['key'], $record[$field['key']])}}
                        </div>
                    @else
                        <div class="form-group">
                            {{Form::text($field['key'],$record[$field['key']])}}
                        </div>
                    @endif
                @else

                    @if($field['key']=='description_long')
                        <div class="form-group">
                            {{Form::textarea($field['key'])}}
                        </div>
                    @else
                        <div class="form-group">
                            {{Form::text($field['key'])}}
                        </div>
                    @endif
                @endif

            @elseif($field['type'] == 'check_box')

                @if(isset($record[$field['key']]))

                    @foreach($field['options'] as $option)
                        <div class="form-group">
                            {{Form::checkbox($option['name'], $option['value'], $record[$field['key']])}}
                        </div>
                    @endforeach

                @else

                    @foreach($field['options'] as $option)
                        <div class="form-group">
                            {{Form::checkbox($option['name'], $option['value'])}}
                        </div>
                    @endforeach
                @endif



            @elseif($field['type'] == 'upload_form')

                @if (isset ($record[$field['key']]))

                    <td><img src={{asset ($record[$field['key']])}} , class="img-rounded" width="150"></td>
                @else
                    <td></td>
                @endif
                <div class="form-group">
                    {!! Form::file('file', null) !!}
                </div>

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