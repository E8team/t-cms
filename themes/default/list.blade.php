@extends('layouts.app')
@inject('navigation', 'App\T\Navigation\Navigation')
@section('style')
    <link rel="stylesheet" href="{!! asset('css/index.css') !!}">
@endsection
@section('content')
    @include('particals.navbar')
    <div class="content container">
        {!! Breadcrumbs::render('category', $navigation) !!}
        <div class="main col-lg-9 col-md-9 col-sm-12 col-xs-12">
            @include('particals.banner')
            <div class="header">
                <a href="#" class="active">热门</a>
                <a href="#">最新</a>
            </div>
            <ul class="list">
                @foreach($postList as $post)
                    <li>
                        <a class="cover" href="{!! route('post', [$navigation->getCurrentNav()->cate_slug, $post->id]) !!}" title="{!! $post->title !!}" target="_blank" style="background-image: url('http://i0.hdslb.com/bfs/archive/dfa4385619bc1833c8c38d47146b0b857bc6813a.jpg@.webp')"></a>
                        <div class="info">
                            <a href="{!! route('post', [$navigation->getCurrentNav()->cate_slug, $post->id]) !!}" target="_blank" title="{!! $post->title !!}"><h3>{!! $post->present()->suitedTitle() !!}</h3></a>
                            <p class="describe">{!! $post->excerpt !!}</p>
                            <p class="time">{!! $post->published_at !!}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
            {{--分页--}}
            {!! $postList->links() !!}
        </div>
        @include('particals.side')
    </div>
    @include('particals.link')
    @include('particals.footer')
@endsection