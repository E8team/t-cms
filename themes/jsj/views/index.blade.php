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
        $("#top-carousel").slick({
            dots: true,
            autoplay: true,
            autoplaySpeed: 6000,
            adaptiveHeight: true
        });
    })
</script>
@endsection
@section('content')
{!! app(\App\Widgets\Banner::class)->setType(3)->render() !!}
<div class="focus-news">
    <div class="watermark left"></div>
    <div class="watermark right"></div>
    <div class="container">
        <div class="news-panel col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="header">
                <h3>学院要闻</h3>
                <a class="more" href="#" target="_blank">更多</a>
            </div>
            <div class="body">
                <div class="top-carousel col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    <div id="top-carousel" class="wrapper">
                        <div class="top-carousel-item">
                            <a href="#">
                                <img src="http://www.pku.edu.cn/img/news/484d7eb258891a6d376b27.JPG" alt="">
                                <h3>拓展合作共赢局面，推进生源基地建设工作</h3>
                                <p>为了加强校际联系，扩大我校招生宣传，根据学校统一部署，5月16日-18日，计算机学院学院党政领导与党政办主任等一行五人先后走访了源潭中学、</p>
                            </a>
                        </div>
                        <div class="top-carousel-item">
                            <a href="#">
                                <img src="http://www.pku.edu.cn/img/news/484d7eb258891a6d376b27.JPG" alt="">
                                <h3>拓展合作共赢局面，推进生源基地建设工作</h3>
                                <p>为了加强校际联系，扩大我校招生宣传，根据学校统一部署，5月16日-18日，计算机学院学院党政领导与党政办主任等一行五人先后走访了源潭中学、</p>
                            </a>
                        </div>
                        <div class="top-carousel-item">
                            <a href="#">
                                <img src="http://www.pku.edu.cn/img/news/484d7eb258891a6d376b27.JPG" alt="">
                                <h3>拓展合作共赢局面，推进生源基地建设工作</h3>
                                <p>为了加强校际联系，扩大我校招生宣传，根据学校统一部署，5月16日-18日，计算机学院学院党政领导与党政办主任等一行五人先后走访了源潭中学、</p>
                            </a>
                        </div>
                    </div>
                </div>
                <ul class="currency-list focus-currency-list col-md-7 col-lg-7 col-xs-12 col-sm-12">
                    <li class="item">
                        <a class="title" href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a class="title" href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a class="title" href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a class="title" href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a class="title" href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a class="title" href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a class="title" href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a class="title" href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                    <li class="item">
                        <a class="title" href="#">附属中山医院多学科协作与精细化发展</a>
                        <div class="time">6个小时前</div>
                    </li>
                </ul>
            </div>
        </div>
        {!! app(App\Widgets\PostList::class)->setCategory('notice')->setLimit(20)->render()!!}
    </div>
</div>
<div class="splitter-bar">
    <div class="mask">工程&nbsp;&nbsp;&nbsp;应用&nbsp;&nbsp;&nbsp;实践&nbsp;&nbsp;&nbsp;创新</div>
    <div class="container"><img src="{!! asset('static/jsj/images/splitter.png') !!}" alt=""></div>
</div>
<div class="news">
    <div class="container">
        {!! app(App\Widgets\PostList::class)->setCategory('zttj')->setViewName('widgets.postList.index_list')->setLimit(8)->render()!!}
        {!! app(App\Widgets\PostList::class)->setCategory('zttj')->setViewName('widgets.postList.index_list')->setLimit(8)->render()!!}
        {!! app(App\Widgets\PostList::class)->setCategory('zttj')->setViewName('widgets.postList.index_list')->setLimit(8)->render()!!}
    </div>
</div>
{!! app(App\Widgets\PostList::class)->setCategory('zttj')->setLimit(4)->render() !!}
<div class="image-link">
    <div class="container">
        <div class="image-link-item col-md-3 col-lg-3 col-xs-12 col-sm-6">
            <a href="#">
                <img src="http://www.xinhuanet.com/titlepic/112052/1120522872_1489022225269_title0h.jpg" alt="">
            </a>
        </div>
        <div class="image-link-item col-md-3 col-lg-3 col-xs-12 col-sm-6">
            <a href="#">
                <img src="http://211.70.176.141/jxx/Public/e8admin/upload/image/2017-02-23/58ae7b538dc3a.png" alt="">
            </a>
        </div>
        <div class="image-link-item col-md-3 col-lg-3 col-xs-12 col-sm-6">
            <a href="#">
                <img src="http://211.70.176.141/fxy/Public/upload/image/20170324/58d52e505f0fd.png" alt="">
            </a>
        </div>
        <div class="image-link-item col-md-3 col-lg-3 col-xs-12 col-sm-6">
            <a href="#">
                <img src="http://211.70.176.141/fxy/Public/upload/image/20170324/58d5280d497a8.jpg" alt="">
            </a>
        </div>
    </div>
</div>
@endsection