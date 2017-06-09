@extends('layouts.app')
@section('title')首页@endsection
@section('js')
<script type="text/javascript">
    $(function () {
        var $allItem = $('.news .currency-list>.item');
        $allItem.hover(function () {
            var _self = $(this);
            _self.parent().find('.open').removeClass('open');
            _self.addClass('open');
        }, function () {})
        try {
            $("#top-carousel").slick({
                dots: true,
                autoplay: true,
                autoplaySpeed: 6000,
                adaptiveHeight: true
            });
        }catch (e){}
    })
</script>
@endsection
@section('content')
{!! app(\App\Widgets\Banner::class)->setType(3)->render() !!}
<div class="focus-news">
    <div class="watermark left"></div>
    <div class="watermark right"></div>
    <div class="container">
        {!! app(App\Widgets\PostList::class)->setCategory('news')->setLimit(20)->render()!!}
        {!! app(App\Widgets\PostList::class)->setCategory('notice')->setLimit(20)->render()!!}
    </div>
</div>
<div class="splitter-bar">
    <div class="mask">工程&nbsp;&nbsp;&nbsp;应用&nbsp;&nbsp;&nbsp;实践&nbsp;&nbsp;&nbsp;创新</div>
    <div class="container"><img src="{!! asset('static/jsj/images/splitter.png') !!}" alt=""></div>
</div>
<div class="news">
    <div class="container">
        {!! app(App\Widgets\PostList::class)->setCategory('education-teach')->setViewName('widgets.postList.index_list')->setLimit(8)->render()!!}
        {!! app(App\Widgets\PostList::class)->setCategory('party-construction')->setViewName('widgets.postList.index_list')->setLimit(8)->render()!!}
        {!! app(App\Widgets\PostList::class)->setCategory('league-work')->setViewName('widgets.postList.index_list')->setLimit(8)->render()!!}
    </div>
</div>
{!! app(App\Widgets\PostList::class)->setCategory('special-recommendation')->setLimit(4)->render() !!}
<div class="image-link">
    <div class="container">
        @foreach(Facades\App\T\Link\Link::getLinkByTypeIdFromCache(4) as $link)
        <div class="image-link-item col-md-3 col-lg-3 col-xs-12 col-sm-6">
            <a href="{!! $link->url !!}" target="_blank">
                <div class="inner">
                    <img lazy src="{!! $link->getLogoUrl('index_link_image') !!}" title="{!! $link->name !!}">
                    <div class="desc">
                        <div class="mask"></div>
                        <p>{!! $link->name !!}</p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection