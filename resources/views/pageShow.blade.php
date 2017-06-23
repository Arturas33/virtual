@extends('frontend')

@section('title', $title)
@section('content')

    {{--{{dd($page['upload']['path'])}}--}}
    {{--{{dd($page)}}--}}
    <div id="pages_title">
        {{$title}}<br>
    </div>


    <div>

        <img src="{{asset($page['upload']['path'])}}" class="img-circle" width="400" height="400"><br><br>

    </div>


    <h3>
        {{$description_long}}
    </h3>
@endsection