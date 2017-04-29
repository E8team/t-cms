@push('js')
<script type="text/javascript">
    // 轮播图
    $(function(){
        var $banner = $('#banner');
        var $item = $banner.find('.item');
        var $items = $banner.find('ul');
        var $img = $item.find('img');
        $items.css('height', $img.height());
        function change(dir){
            var $current = $banner.find('.active');
            var $next = $current[dir]();
            if($next.length  == 0){
                $next = $current.index() == 0 ? $item.last() : $item.first();
            }
            $current.removeClass('active');
            $next.addClass('active');
        }
        $(window).resize(function(){
            $items.css('height', $img.height());
        });
        $('#prev').on('click', function(){
            change('prev');
        });
        $('#next').on('click', function(){
            change('next');
        });
    });
</script>
@endpush
<div id="banner" class="banner">
    <div id="prev"><i class="glyphicon glyphicon-chevron-left"></i></div>
    <div id="next"><i class="glyphicon glyphicon-chevron-right"></i></div>
    <ul>
        <li class="item active">
            <a href="#">
                <img src="http://upload.jianshu.io/admin_banners/web_images/2474/44053de694a07f93b53582218e322c849be1a616.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/1250/h/540"/>
            </a>
        </li>
        <li class="item">
            <a href="#">
                <img src="http://upload.jianshu.io/admin_banners/web_images/2295/2dbb6d6e2abd9f7e50c56adfff92f9613ad9c502.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/1250/h/540"/>
            </a>
        </li>
        <li class="item">
            <a href="#">
                <img src="http://upload.jianshu.io/admin_banners/web_images/2977/26d58c4b2b808b962bef6cf205db0c5aa68db189.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/1250/h/540"/>
            </a>
        </li>
    </ul>
</div>