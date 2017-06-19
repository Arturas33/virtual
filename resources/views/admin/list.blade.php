@extends('admin.core')
@section('content')
    <div id='list'>

        <div><h3>{{ $title }} </h3></div>
        <div> @if(isset($create))
                <a class="btn btn-success" href="{{route($create)}}"> New one </a>
            @endif
        </div>

        <div class="container">
            @if(sizeof($list) > 0 )
                <table class="table table-hover">
                    <h3>{{ trans('app.language_codes_list') }}</h3>
                    <tr>

                        @foreach($list[0] as $key => $value)
                            <th> {{$key}}</th>

                        @endforeach
                        @if(isset($edit))
                        <th>Edit</th>
                        <th>Delete</th>
                            @endif
                    </tr>
                    <tr>
                    @foreach($list as $record)
                        <tr id="{{ $record['id'] }}">

                            @foreach($record as $key => $value)

                                @if($key == 'is_active')
                                    <td>     @if($value == 1 )
                                            <button onclick="toggleActive('{{ route($callAction, $record['id'] )}}',1)"
                                                    type="button" style="display:none"
                                                    class="btn btn-success">{{trans('app.active')}}</button>
                                            <button onclick="toggleActive('{{ route($callAction, $record['id'] )}}',0 )"
                                                    type="button"
                                                    class="btn btn-danger">{{trans('app.disable')}}</button>
                                        @else
                                            <button onclick="toggleActive('{{ route($callAction, $record['id'] ) }}',1)"
                                                    type="button"
                                                    class="btn btn-success">{{trans('app.active')}}</button>
                                            <button onclick="toggleActive('{{ route($callAction, $record['id'] )}}', 0)"
                                                    type="button" style="display:none"
                                                    class="btn btn-danger">{{trans('app.disable')}}</button>
                                        @endif
                                    </td>

                                @elseif($key == 'translations')
                                    @if(isset($value['name']))

                                    <td>{{$value['name']. ' ' . $value['language_code']}}</td>
                                        
                                        @endif
                                    @if(isset($value['title']))
                                        <td></td>
                                            <td>{{$value['title']. ' ' . $value['language_code']}}</td>
                                        @else
                                        @endif

                                @elseif($key == 'role')
                                <td>{{$value['role_id']}}}</td>

                                @else
                                    <td>{{$value}}</td>
                                @endif

                            @endforeach

                                @if(isset($edit))

                                    <td>
                                        <a href="{{ route($edit, $record['id']) }}">
                                            <button type="button" class="btn btn-primary">Edit</button>
                                        </a>
                                    </td>

                                    <td>
                                        <button onclick="deleteItem( '{{ route($delete, $record['id']) }}' )"
                                                class="btn btn-danger">Delete
                                        </button>
                                    </td>
                                @endif

                        </tr>
                    @endforeach


                </table>
            @else
                <h3>{{trans('app.no_data')}}</h3>

            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function toggleActive(URL, value) {
//            console.log(URL, value);
            $.ajax({
                url: URL,
                type: 'POST',
                data: {
                    is_active: value
                },


                success: function (response) {

//                  console.log($('#' + response.id))
//                    console.log($('#' + response.id).hide());
//                        $('#' + response.id).css({
//                            opacity:0.5,
//                            backgroundColor:'red'
//
//                        })

//                    console.log($('#' + response.id).find('button'))
                    var $disable = ($('#' + response.id).find('.btn-danger'))
                    var $enable = ($('#' + response.id).find('.btn-success'))

//                    console.log(disable, enable)
//
//                    if(response.is_active == 0)
//                    {
//                     alert('respons is active' + response.is_active)
//                    }

                    if (response.is_active === '1') {

                        $enable.hide();
                        $disable.show();
                    } else {

                        $enable.show();
                        $disable.hide();
                    }
                }

            })
        }
        function deleteItem(route) {
            $.ajax({
                url: route,
                type: 'DELETE',
                dataType: 'json',
                success: function (response) {
                    $('#' + response.id).remove();
                },
                error: function () {
                    alert('ERROR')
                }
            });
        }


    </script>
@endsection