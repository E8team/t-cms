@extends('layouts.app')
@inject('navigation', 'App\T\Navigation\Navigation')
@section('style')
    <link rel="stylesheet" href="{!! asset('css/index.css') !!}">
@endsection
@section('content')
    <div class="content container">
        {!! Breadcrumbs::render('category', $navigation) !!}
        <div class="main col-lg-9 col-md-9 col-sm-12 col-xs-12">
            @include('layouts.particals.banner')
            <div id="order" class="header">
                @php
                    $request = request();
                    $order = $request->get('order', 'default');
                @endphp
                @foreach(['default', 'recent', 'popular'] as $item)
                    <a href="{!! $request->fullUrlWithQuery(['order' => $item]).'#order' !!}"@if($order==$item) class="active"@endif>{!! trans('app.'.$item) !!}</a>
                @endforeach
            </div>
            <ul class="list">
                @foreach($postList as $post)
                    <li>
                        <a class="cover" href="{!! $post->present()->getUrl() !!}" title="{!! $post->title !!}" target="_blank" style="background-image: url('http://i0.hdslb.com/bfs/archive/dfa4385619bc1833c8c38d47146b0b857bc6813a.jpg@.webp')"></a>
                        <div class="info">
                            <a href="{!! $post->present()->getUrl() !!}" target="_blank" title="{!! $post->title !!}">
                                <h3>@if($post->isTop())<span class="label label-danger">置顶</span>@endif{!! $post->present()->suitedTitle() !!}</h3>
                            </a>
                            <p class="describe">{!! $post->excerpt !!}</p>
                            <p class="time">{!! $post->published_at !!}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
            {{--分页--}}
            {!! $postList->links() !!}
        </div>
        @component('layouts.particals.side', ['category' => $navigation->getCurrentNav()])@endcomponent
    </div>
@endsection