@extends('admin.core')
@section('content')
    <div id='list'>
<div class="container">
        @if(sizeof($list) > 0 )
            <table  class="table table-hover" >
                <tr>
                    @foreach($list[0] as $key => $value)
                        <th> {{$key}}</th>
                    @endforeach
                </tr>
                <tr>
                    @foreach($list as $record)
                        @foreach($record as $value)
                            <td>{{$value}}</td>
                        @endforeach

                </tr>
                @endforeach


            </table>
        @else
            <h3>{{trans('app.no_data')}}</h3>

        @endif
</div>
    </div>
@endsection