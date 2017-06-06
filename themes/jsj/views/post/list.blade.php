@extends('layouts.app')

@inject('navigation', 'App\T\Navigation\Navigation')

@section('title'){!! $navigation->getActiveNav()->cate_name!!}@endsection

@section('content')
    @include('post.particals.category_bg')
    <div class="list-body" id="list">
        <div class="container">
            @include('post.particals.category_side_nav')
            <div class="main-page col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="header">
                    {!! Breadcrumbs::render('category', $navigation) !!}
                </div>
                <ul class="list">
                    @if($postList->isEmpty())
                        <li>暂无文章</li>
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
                                            <h3>@if($post->isTop())<span class="label label-danger">置顶</span>@endif{!! $post->title !!}</h3>
                                        </a>
                                        @if(is_null($post->excerpt))
                                            <p class="describe">{!! $post->excerpt !!}</p>
                                        @endif
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