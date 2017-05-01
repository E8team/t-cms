@extends('layouts.content')
@section('js')
    <script>
        $(function () {
            var $side = $('#side');
            var $main = $('.content_main');
            var sideTop = $side.offset().top;
            $(document).scroll(function(){
                if($(document).scrollTop() >= sideTop){
                    $side.css('position', 'fixed');
                    $side.css('right', $main.offset().left);
                }else{
                    $side.css('position', 'absolute');
                    $side.css('right', '0px');
                }
            })
        })
    </script>
@endsection
@section('content')
    <div class="content_header">
        <a href="#" class="title">t-cms</a>
    </div>
    <div class="container">
        <h1 class="content_title">{!! $post->title !!}</h1>
        <p class="info">
            <span>{!! $post->views_count !!} 次阅读</span>
            <span>{!! $post->published_at !!}</span>
        </p>
        <div class="content_main">
            <div class="content">
                {!! $post->content->content !!}
            </div>
            <div id="side" class="side hidden-xs hidden-sm">
                <h4>相关文章</h4>
                <ul class="related_article">
                    <li><a href="#" target="#">AlphaGo：人工智能的曙光？</a></li>
                    <li><a href="#" target="#">思维的巴别塔：语言、认知和心理学</a></li>
                    <li><a href="#" target="#">AlphaGo：人工智能的曙光？</a></li>
                    <li><a href="#" target="#">AlphaGo：人工智能的曙光？</a></li>
                    <li><a href="#" target="#">思维的巴别塔：语言、认知和心理学</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="contnet_footer">
        <div class="container">
            <a href="#">
                <div class="nav-title">
                    <span>阅读下一篇</span>
                </div>
                <h1 class="content_title">charles中如何对https抓包</h1>
                <p class="info">
                    <span>4635人阅读</span>
                    <span>2015-11-12 10:55</span>
                </p>
            </a>
        </div>
    </div>
@endsection