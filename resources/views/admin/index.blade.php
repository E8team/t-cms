<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>管理_t-cms</title>
    <link rel="stylesheet" href="{{asset(mix('static/admin/css/app.css'))}}">
    <script>
        window.t_meta = {!! json_encode([
            'csrfToken' => csrf_token(),
            'base_url' => url('/'),
            'ueditor_include' => [
                asset('vendor/ueditor/ueditor.config.js'),
                asset('vendor/ueditor/ueditor.all.min.js')
            ],
            'ueditor_server_url' => config('ueditor.route.name'),
            'public' => asset('/')
        ]) !!};
    </script>
</head>
<body>
    <div id="app"></div>
</body>
<script type="text/javascript" src="{{asset(mix('static/admin/js/app.js'))}}"></script>
</html>
