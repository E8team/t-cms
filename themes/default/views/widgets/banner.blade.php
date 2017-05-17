@push('js')
<script type="text/javascript">
    // 轮播图
    $(function(){
        var $banner = $('#banner');
        var $item = $banner.find('.item');
        var $items = $banner.find('ul');
        var $img = $item.find('img');
        $items.css('height', $img.height());
        $img.load(function(){
            $items.css('height', $img.height());
        })
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
        @foreach($banners as $banner)
        <li class="item active">
            <a href="{!! $banner->url !!}" title="{!! $banner->title !!}">
                <img src="{!! $banner->getPictureUrl('lg') !!}"/>
            </a>
        </li>
        @endforeach
    </ul>
</div>