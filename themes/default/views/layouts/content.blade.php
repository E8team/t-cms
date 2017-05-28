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
    <link rel="stylesheet" href="{!! asset('static/default/css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! mix('/css/app.css', 'static/default') !!}">
    @yield('style')
</head>
<body>
<div class="body content">
    {!! Facades\App\Widgets\Navbar::render() !!}
    {!! Facades\App\Widgets\Alert::render() !!}
    @yield('content')
    @yield('js')
    @stack('js')
</div>
<script>
    var $nav = $('.nav_container');
    var lastTop = 0;
    var $title = $('.content_title');
    $(document).scroll(function (e) {
        if($nav.length == 0){$nav = $('.nav_container')};
        if($title.length == 0){$title = $('.content_title')};
        var currentTop = $(this).scrollTop();
        if(currentTop <= lastTop){
            if($nav.css('position') != 'fixed'){
                $nav.css({
                    'position': 'fixed',
                    'top': '-62px'
                });
                $nav.animate({
                    top: '0'
                }, 300 );
            }
        }else{
            $nav.css({
                'position': 'absolute'
            });
        }
        lastTop = currentTop;
    })
</script>
</body>
</html>