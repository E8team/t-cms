@extends('layouts.app')

@inject('navigation', 'App\T\Navigation\Navigation')

@section('content')
    <div class="content container">
        {!! Breadcrumbs::render('category', $navigation) !!}
        <div class="main col-lg-9 col-md-9 col-sm-12 col-xs-12">
            {!! Facades\App\Widgets\Banner::render() !!}
            <div id="list" class="header">
                @php
                    $request = request();
                    $order = $request->get('order', 'default');
                @endphp
                @foreach(['default', 'recent', 'popular'] as $item)
                    <a href="{!! $request->fullUrlWithQuery(['order' => $item]).'#list' !!}"@if($order==$item) class="active"@endif>{!! trans('app.'.$item) !!}</a>
                @endforeach
            </div>
            <ul class="list">
                @foreach($postList as $post)
                    <li>
                        @if(!is_null($post->cover))
                        <a class="cover" href="{!! $post->present()->getUrl() !!}" title="{!! $post->title !!}">
                            <img lazy src="{!! $post->getCover('cover_sm') !!}"/>
                        </a>
                        @endif
                        <div class="info @if(is_null($post->cover)) no_cover @endif">
                            <a href="{!! $post->present()->getUrl() !!}" title="{!! $post->title !!}">
                                <h3>@if($post->isTop())<span class="label label-danger">置顶</span>@endif{!! $post->present()->suitedTitle() !!}</h3>
                            </a>
                            <p class="describe">{!! $post->excerpt !!}</p>
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
            </ul>
            {{--分页--}}
            {!! $postList->fragment('list')->links() !!}
        </div>
        @include('post.particals.list_side')
    </div>
@endsection