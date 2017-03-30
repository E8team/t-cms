<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>登录_t-cms</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <script>
        window.t_meta = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div  id="app">
    <div class="login_container">
        <h2>登录</h2>
        <form action="">
            <el-form label-position="top" label-width="80px">
                <el-form-item label="用户名">
                    <el-input></el-input>
                </el-form-item>
                <el-form-item label="密码">
                    <el-input></el-input>
                </el-form-item>
                <el-checkbox class="remove_pwd_checkbox">记住密码</el-checkbox>
                <el-form-item>
                    <el-button class="login_button" type="primary">登录</el-button>
                </el-form-item>
            </el-form>
        </form>
    </div>
</div>
</body>
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</html>