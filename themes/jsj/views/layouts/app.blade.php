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
    <div class="friendship-link">
        <div class="container">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <h3>院系设置</h3>
                <ul class="links">
                    <li>
                        <a href="#">计算机学院</a>
                    </li>
                    <li>
                        <a href="#">法学院</a>
                    </li>
                    <li>
                        <a href="#">文传学院</a>
                    </li>
                    <li>
                        <a href="#">化学与材料工程学院</a>
                    </li>
                    <li>
                        <a href="#">美术与设计学院</a>
                    </li>
                    <li>
                        <a href="#">电子工程学院</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <h3>院系设置</h3>
                <ul class="links">
                    <li>
                        <a href="#">计算机学院</a>
                    </li>
                    <li>
                        <a href="#">法学院</a>
                    </li>
                    <li>
                        <a href="#">文传学院</a>
                    </li>
                    <li>
                        <a href="#">化学与材料工程学院</a>
                    </li>
                    <li>
                        <a href="#">美术与设计学院</a>
                    </li>
                    <li>
                        <a href="#">电子工程学院</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="about">
        <div class="container">
            <img class="footer-logo" src="{!! asset('static/jsj/images/footer-logo.png') !!}" alt="">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <ul class="footer-nav">
                    <li><a href="#">学院概况</a></li>
                    <li><a href="#">院长寄语</a></li>
                    <li><a href="#">师资队伍</a></li>
                    <li><a href="#">教学管理</a></li>
                    <li><a href="#">科学研究</a></li>
                    <li><a href="#">党团建设</a></li>
                    <li><a href="#">招生就业</a></li>
                    <li><a href="#">校友风采</a></li>
                    <li><a href="#">资料下载</a></li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"></div>
        </div>
    </div>
    <div class="footer-copy">
        Copyright &copy; 2017 <a href="#">e8net</a>. All Rights Reserved.
    </div>
    @yield('js')
    @stack('js')
</div>
</body>
</html>