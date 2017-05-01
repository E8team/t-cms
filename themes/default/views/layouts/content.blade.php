<!DOCTYPE html>
<html lang="{!! config('app.locale') !!}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')">
    {{--<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />--}}
    <title>@section('title')我的站点@show - powered by t-cms</title>
    <meta http-equiv="x-pjax-version" content="{!! mix('/js/app.js', 'static/default') !!} . {!! mix('/css/app.css', 'static/default') !!} }}">
    <script type="text/javascript" src="{!! mix('/js/app.js', 'static/default') !!}"></script>
    <link rel="stylesheet" href="{!! mix('/css/app.css', 'static/default') !!}">
    @yield('style')
</head>
<body class="content">
@yield('content')
@yield('js')
@stack('js')
</body>
</html>