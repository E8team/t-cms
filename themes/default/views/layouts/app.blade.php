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
    <link rel="stylesheet" href="{!! asset('lib/nprogress/nprogress.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/comm.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/index.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/content.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/page.css') !!}">

    @yield('style')
    <script type="text/javascript" src="{!! asset('lib/jquery/dist/jquery.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('lib/jquery-pjax/jquery.pjax.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('lib/nprogress/nprogress.js') !!}"></script>
    <script type="text/javascript">
        $(function (){
            $(document).pjax('a:not(a[target="_blank"])', 'body', {
                timeout: 1600,
                maxCacheLength: 500
            });
            $(document).on('pjax:start', function() {
                NProgress.start();
            });
            $(document).on('pjax:end', function() {
                NProgress.done();
            });
            $(document).on('pjax:complete', function() {
                original_title = document.title;
                NProgress.done();
                //self._resetTitle();
            });
            // Exclude links with a specific class
            $(document).on("pjax:click", "a.no-pjax", false);
        });
    </script>
</head>
<body>
@include('layouts.particals.navbar')
@yield('content')
@include('layouts.particals.link')
@include('layouts.particals.footer')
@yield('js')
@stack('js')
</body>
</html>