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
    <link rel="stylesheet" href="{!! asset('lib/bootstrap/dist/css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/comm.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/index.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/content.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/page.css') !!}">
    @yield('style')
    <script type="text/javascript" src="{!! asset('lib/jquery/dist/jquery.min.js') !!}"></script>
</head>
<body class="content">
@yield('content')
@yield('js')
@stack('js')
</body>
</html>