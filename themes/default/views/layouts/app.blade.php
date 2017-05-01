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