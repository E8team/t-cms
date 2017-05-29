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
            <li @if(URL::current() == URL::to('/'))class="active"@endif><a class="nav-link" href="{!! URL::to('/') !!}">网站首页</a></li>
            @foreach($navbars as $nav)
                <li @if(!is_null($topNav) && $nav->equals($topNav)) class="active" @endif>
                    <a class="nav-link"{!! $nav->present()->aProperty() !!}>{!! $nav->cate_name !!}</a>
                    @if(!$nav->children->isEmpty())
                        <div class="sub-nav">
                            @foreach($nav->children as $children)
                                <div class="sub-nav-item">
                                    <a{!! $children->present()->aProperty() !!}>{!! $children->cate_name !!}</a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>