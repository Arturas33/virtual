@extends('admin.core')
@section('content')
    <div id='list'>
        <div class="container">
            @if(sizeof($list) > 0 )
                <table class="table table-hover">
                    <tr>
                        @foreach($list[0] as $key => $value)
                            <th> {{$key}}</th>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach($list as $record)

                            @foreach($record as $key => $value)

                                @if($key == 'is_active')
                                    <td>     @if($value == 1 )
                                            <button onclick="enableaDisableLanguage({{route('app.language.edit'), $record['id'], 0}})" type="button" style="display:none"
                                                    class="btn btn-success">{{trans('app.active')}}</button>
                                            <button onclick="enableaDisableLanguage({{route('app.language.edit'), $record['id'], 1}})" type="button"
                                                    class="btn btn-danger">{{trans('app.disable')}}</button>
                                        @else
                                            <button onclick="enableaDisableLanguage({{route('app.language.edit'), $record['id'],0}})" type="button"
                                                    class="btn btn-success">{{trans('app.active')}}</button>
                                            <button onclick="enableaDisableLanguage({{route('app.language.edit'), $record['id'],1}})" type="button" style="display:none"
                                                    class="btn btn-danger">{{trans('app.disable')}}</button>
                                        @endif
                                    </td>
                                @else
                                    <td>{{$value}}</td>
                                @endif


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

@section('scripts')
<script>
    function enableaDisableLanguage(url,value)
    {
        alert('Hello')
    }

</script>
@endsection