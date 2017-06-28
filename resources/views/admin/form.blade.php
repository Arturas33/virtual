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

                    <td><img src="{{asset ($record[$field['key']])}}" , class="img-rounded" width="150"></td>
                @else
                    <td></td>
                @endif
                <div class="form-group">
                    {!! Form::file('file') !!}
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

        var $time = $('#time');
        var $virtual_room = $('#virtual_room');


        if ($('#time').length > 0 && $('#virtual_room').length > 0) {

            $time.bind('change', getAvailableHour);

            $virtual_room.bind('change', getAvailableHour);

            function prepareForCheckBox(day) {


                // new date
                var date = new Date(day + ' 00:00:00');

                // checking if date is today
                if (date.toDateString() == new Date().toDateString())
                    date = new Date();

                // closing time property
                var closingTime = 22;

                // opening time property
                var openingTime = 10;

                // available times for this
                var availableTimes = [];

                // allow rezervation 2 hours from now
                date.setHours(date.getHours() + 2);

                // moving minutes to dividable by 10
                date.setMinutes(Math.ceil(date.getMinutes() / 10) * 10);

                // while it is not closing time execute
                while (date.getHours() < closingTime) {
                    // cheking if hours are more than opening time
                    if (date.getHours() >= openingTime) {
                        // creating rezervation time visible for users
                        var time = date.getHours() + ':' + pad(date.getMinutes(), 2);
                        // creating dateTime / id which will be recorded in the databse
                        var dateTime = day + ' ' + time + ':00';

                        // adding data to array
                        availableTimes.push(
                            {
                                title: time,
                                id: dateTime,
                                // cheking if time is reserved
                                reserved: reserved.indexOf(dateTime) >= 0 ? 1 : 0
                            });
                    }

                    // interval each 10 minutes
                    // increasing time by 10 minutes
                    date.setMinutes(date.getMinutes() + 10);
                }

                // function which adds zeros from left size of the number 1 -> 001
                function pad(num, size) {
                    var s = num + "";
                    while (s.length < size) s = "0" + s;
                    return s;
                }

           return availableTimes ;
            }


        }

        function generateCheckBoxes(list) {

            return prepareForCheckBox (reserved , day);
        }

        function getAvailableHour() {
            $.ajax({
                url: '{{route('app.orders.reserv')}}',
                type: 'GET',
                data: {
                    time: $time.val(),
                    experience_id: $virtual_room.val(),

                },


                success: function (response) {

                    console.log(generateCheckBoxe($time.val(), response))
                },
                error: function () {
                    alert('ERROR')
                }
            });

        }


        console.log('all good')
        // console.log($('#language_code'));


    </script>
@endsection




