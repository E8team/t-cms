{{--导肮栏--}}
@push('js')
<script type="text/javascript">
    $(function () {
        $('#nav_list>li').hover(function () {
            var $list = $(this).find('.sub_nav')
            $list.css('display', 'block');
            $list.stop().animate({
                'opacity': 1,
                'top': '56px'
            }, 200)
        }, function () {
            var $list = $(this).find('.sub_nav')
            $list.stop().animate({
                'opacity': 0,
                'top': '70px'
            }, 200, function () {
                if($list.css('top') == '70px'){
                    $list.css('display', 'none');
                }
            })
        })
    });
</script>
@endpush
<div class="nav_container">
    <div class="container">
        <a href="{!! URL::to('/') !!}" class="logo"><img src="http://ooqq2vj4w.bkt.clouddn.com/logo.png" alt="logo"></a>
        <ul class="nav_list" id="nav_list">
            @foreach($navbars as $nav)
                <li @if(!is_null($topNav) && $nav->equals($topNav)) class="active" @endif>
                    <a {!! $nav->present()->aProperty() !!}>{!! $nav->cate_name !!}</a>
                    @if(!$nav->children->isEmpty())
                        <span class="glyphicon glyphicon-chevron-down"></span>
                        <ul class="sub_nav">
                            @foreach($nav->children as $children)
                                <li><a {!! $children->present()->aProperty() !!}>{!! $children->cate_name !!}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>