<!DOCTYPE html>
<html>
<head>
    <title>admin</title>
    @include('admin.style')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

</head>
<body>


@include('admin.nav')


@yield('content')
</body>
@yield('scripts')
</html>