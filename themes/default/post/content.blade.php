@extends('layouts.content')
@section('style')
    <link rel="stylesheet" href="{!! asset('css/content.css') !!}">
@endsection
@section('content')
    <div class="header">
        <a href="#" class="title">t-cms</a>
    </div>
    <div class="container">
        <h1 class="title">{!! $post->title !!}</h1>
        <p class="info">
            <span>{!! $post->views_count !!} 次阅读</span>
            <span>{!! $post->published_at !!}</span>
        </p>
        <div class="main">
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
    <div class="footer">
        <div class="container">
            <a href="#">
                <div class="nav-title">
                    <span>阅读下一篇</span>
                </div>
                <h1 class="title">charles中如何对https抓包</h1>
                <p class="info">
                    <span>4635人阅读</span>
                    <span>2015-11-12 10:55</span>
                </p>
            </a>
        </div>
    </div>
@endsection