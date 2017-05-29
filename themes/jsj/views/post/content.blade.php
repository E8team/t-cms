@extends('layouts.app')

@inject('navigation', 'App\T\Navigation\Navigation')

@section('content')
    <div class="container content-body">
        <div class="header">
            {!! Breadcrumbs::render('post', $navigation, $post) !!}
        </div>
        <div class="title_container">
            <h1>{!! $post->title !!}</h1>
            <p class="info">
                <span>{!! $post->published_at !!}</span>
                <span>{!! $post->views_count !!} 人阅读</span>
                <span class="avatar">
                    上传：
                    <img lazy src="{!! $post->user->getAvatar('xs', asset('images/default_avatar.jpg')) !!}">
                    <span class="uname">{!! isset($post->user->nick_name)?$post->user->nick_name:$post->user->user_name !!}</span>
                </span>
            </p>
        </div>
        <div class="body">{!! $post->content->content !!}</div>
    </div>
@endsection