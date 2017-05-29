<!DOCTYPE html>
<html lang="{!! config('app.locale') !!}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')">
    {{--<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />--}}
    <title>@yield('title')_计算机学院_powered by t-cms</title>
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
            <form method="get" id="search-form" class="search" action="/">
                <input class="input-box" name="keywords" type="text" @if(isset($keywords))value="{!! $keywords !!}"@endif placeholder="请输入关键字">
                <i class="submit glyphicon glyphicon-search"></i>
            </form>
        </div>
        {!! Facades\App\Widgets\Navbar::render() !!}
	</div>
    {!! Facades\App\Widgets\Alert::render() !!}
    @yield('content')
    @include('layouts.particals.link')
    @include('layouts.particals.footer')
    <script>
        $(function () {
            var $searchForm = $('#search-form');
            $searchForm.find('input').keydown(function (e) {
                if(e.keyCode == 13){
                    $searchForm.submit();
                }
            })
            $searchForm.find('i').click(function () {
                $searchForm.submit();
            })
            $searchForm.submit(function (e) {
                var $this = $(this), keywords = encodeURIComponent($this.find("input[name=keywords]").val());
                if(!keywords){
                    location.href = "/";
                    return false;
                }
                location.href = "{!! route('search', ['keywords'=>'__KEYWORDS__']) !!}".replace("__KEYWORDS__", keywords);
                return false;
            });
        })
    </script>
    @yield('js')
    @stack('js')
</div>
</body>
</html>