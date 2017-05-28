{{--导肮栏--}}
@push('js')
<script type="text/javascript">
    $(function () {
        $('#nav>li').hover(function () {
            var $list = $(this).find('.sub-nav')
            $list.css('display', 'block');
            $list.stop().animate({
                'opacity': 1,
                'top': '65px'
            }, 200)
        }, function () {
            var $list = $(this).find('.sub-nav')
            $list.stop().animate({
                'opacity': 0,
                'top': '80px'
            }, 200, function () {
                if($list.css('top') == '80px'){
                    $list.css('display', 'none');
                }
            })
        })
    });

</script>
@endpush
<div class="nav">
    <div class="container">
        <ul id="nav">
            <li class="active"><a class="nav-link" href="#">网站首页</a></li>
            <li>
                <a class="nav-link" href="#">学院概况</a>
                <div class="sub-nav">
                    <div class="sub-nav-item">
                        <a href="#">学院概况</a>
                    </div>
                    <div class="sub-nav-item">
                        <a href="#">学院概况</a>
                    </div>
                    <div class="sub-nav-item">
                        <a href="#">学院概况</a>
                    </div>
                </div>
            </li>
            <li><a class="nav-link" href="#">院长寄予</a></li>
            <li><a class="nav-link" href="#">师资队伍</a></li>
            <li><a class="nav-link" href="#">教学管理</a></li>
            <li><a class="nav-link" href="#">科学研究</a></li>
            <li><a class="nav-link" href="#">党团建设</a></li>
            <li><a class="nav-link" href="#">招生就业</a></li>
            <li><a class="nav-link" href="#">校友风采</a></li>
            <li><a class="nav-link" href="#">资料下载</a></li>
            <li><a class="nav-link" href="#">联系我们</a></li>
        </ul>
    </div>
</div>