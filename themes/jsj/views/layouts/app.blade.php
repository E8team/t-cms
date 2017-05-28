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
    <meta http-equiv="x-pjax-version" content="{!! asset(mix('/js/app.js', 'static/jsj')) !!} . {!! asset(mix('/css/app.css', 'static/jsj')) !!} }}">
    <script type="text/javascript" src="{!! asset(mix('/js/app.js', 'static/jsj')) !!}"></script>
    <link rel="stylesheet" href="{!! asset('static/jsj/css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! asset(mix('/css/app.css', 'static/jsj')) !!}">
    @yield('style')
</head>
<body>
<div class="body">
	<div class="header-nav">
        <div class="mask-left"></div>
        <div class="mask-right"></div>
        <div class="container">
            <a class="logo" href="#"><img src="{!! asset('static/jsj/images/logo.png') !!}"></a>
            <form method="get" class="search">
                <input class="input-box" type="text" placeholder="请输入关键字">
                <i class="submit glyphicon glyphicon-search"></i>
            </form>
        </div>
    	{!! Facades\App\T\Widgets\Navbar::render() !!}
	</div>
    {!! Facades\App\T\Widgets\Alert::render() !!}
    @yield('content')
    @yield('js')
    @stack('js')
</div>
</body>
</html>