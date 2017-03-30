<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @include('UEditor::head')
    </head>
    <body>
    <!-- 加载编辑器的容器 -->
    <form action="{!! route('admin.posts.store') !!}" method="post">
        {{csrf_field()}}
        <!-- 加载编辑器的容器 -->
        <script id="container" name="content" type="text/plain">
            这里写你的初始化内容
        </script>
        <button type="submit">提交</button>
    </form>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
        });
    </script>
    </body>
</html>
