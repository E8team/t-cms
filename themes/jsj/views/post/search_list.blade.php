@extends('layouts.app')

@section('title')"{!! $keywords !!}" 搜索结果@endsection

@section('js')
<script type="text/javascript">
    $(function () {
        var $pageBg = $('#page-bg');
        $pageBg.fadeIn(300);
    })
</script>
@endsection
@section('content')
    <div class="page-bg-wrapper">
        <div id="page-bg" class="page-bg" style="background-image: url('{!! asset('static/jsj/images/page-bg-'.rand(1,4).'.png') !!}')">
            <div class="title">
                <div class="mask"></div>
                <h2>"{!! $keywords !!}" 搜索结果</h2>
            </div>
        </div>
    </div>
    <div class="list-body" id="list">
        <div class="container">
            <div class="nav_menu col-md-3 col-lg-3">
                <ul>
                    <li class="active">
                        <span class="pendant"></span>
                        <a href="{!! route('search', ['keywords' => $keywords]) !!}">"<em>{!! $keywords !!}</em>" 搜索结果</a>
                        <span class="arrow glyphicon glyphicon-chevron-right"></span>
                    </li>
                </ul>
            </div>
            <div class="main-page col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="header">
                    {!! Breadcrumbs::render('search_list', $keywords) !!}
                </div>
                <ul class="list">
                    @php
                        $keywordsWithEm = "<em>$keywords</em>";
                    @endphp
                    @if($postList->isEmpty())
                        <li>暂无记录</li>
                        @else
                            @foreach($postList as $post)
                                <li>
                                    @if(!is_null($post->cover))
                                        <a class="cover" href="{!! $post->present()->getUrl() !!}" title="{!! $post->title !!}">
                                            <img lazy src="{!! $post->getCover('cover_sm') !!}"/>
                                        </a>
                                    @endif
                                    <div class="info @if(is_null($post->cover)) no_cover @endif">
                                        <a href="{!! $post->present()->getUrl() !!}" title="{!! $post->title !!}">
                                            <h3>@if($post->isTop())<span class="label label-danger">置顶</span>@endif{!! str_replace($keywords, $keywordsWithEm, $post->present()->suitedTitle()) !!}</h3>
                                        </a>
                                        <p class="describe">{!! str_replace($keywords, $keywordsWithEm, $post->excerpt) !!}</p>
                                        <div class="list_footer">
                                            <p class="avatar">
                                                <img src="{!! $post->user->getAvatar('xs', asset('images/default_avatar.jpg')) !!}">
                                                <span class="uname">{!! isset($post->user->nick_name)?$post->user->nick_name:$post->user->user_name !!}</span>
                                            </p>
                                            <p class="time">{!! $post->published_at !!}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                    @endif
                </ul>
                {{--分页--}}
                {!! $postList->fragment('list')->links() !!}
            </div>
        </div>
    </div>
@endsection