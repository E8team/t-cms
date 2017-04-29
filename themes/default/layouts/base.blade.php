<!DOCTYPE html>
<html lang="{!! config('app.locale') !!}">
<head>

</head>
<body>
@yield('content')
@yield('js')
@stack('js')
</body>
</html>