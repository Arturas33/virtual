<!DOCTYPE html>
<html>
<head>
    <title>admin</title>
    @include('admin.style')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

</head>
<body>


@include('admin.nav')

<div id="page">
 @yield('content')
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@yield('scripts')
</html>