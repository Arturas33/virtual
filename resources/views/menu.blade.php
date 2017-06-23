{{--{{dd($vr_room)}}--}}

<div>
    <ul class="nav navbar-nav">
        {{--{{dd($menu)}}--}}
        @foreach( $menu as $record)

            @if (sizeof($record['sub_menu'])>0)
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">{{($record['translations']['name'])}} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @foreach($record['sub_menu'] as $element)
                            <li><a href="{{$element['translations']['url']}}">{{$element['translations']['name']}}</a>
                            </li>
                        @endforeach
                    </ul>
            @else
                <li class="active"><a href="{{$record['translations']['url']}}"> {{$record['translations']['name']}}
                        <span class="sr-only">(current)</span></a></li>
                </li>
            @endif
        @endforeach

        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
               aria-expanded="false">{{trans('app.language')}} <span class="caret"></span></a>
            <ul class="dropdown-menu">
                @foreach($lang_menu as $key => $value)
                    <li><a href="{{$key}}">{{$value}}</a></li>
                @endforeach
            </ul>
        </li>

        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
               aria-expanded="false">{{trans('app.room')}} <span class="caret"></span></a>
            <ul class="dropdown-menu">
                @foreach($vr_room as $key => $value)
                    <li>
                        <a href=" /{{app()->getLocale(). '/pages/' . ($value['translations']['slug'])}}">{{($value['translations']['title'])}}</a>
                    </li>
                @endforeach
            </ul>
        </li>


    </ul>
</div>


