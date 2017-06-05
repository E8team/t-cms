{{--学院要闻模块--}}
@php
    if($posts->isEmpty()) return;
    $topPosts = $posts->take(3);
    $otherPosts = $posts->whereNotIn('id', $topPosts->pluck('id'));
@endphp
<div class="news-panel col-xs-12 col-sm-12 col-md-8 col-lg-8">
    <div class="header">
        <h3>{!! $category->cate_name !!}</h3>
        <a class="more" {!! $category->present()->aProperty(true) !!}>更多</a>
    </div>

    <div class="body">
        <div class="top-carousel col-xs-12 col-sm-12 col-md-5 col-lg-5">
            <div id="top-carousel" class="wrapper">
                @foreach($topPosts as $topPost)
                <div class="top-carousel-item">
                    <a href="{!! $topPost->present()->getUrl() !!}" title="{!! $topPost->title !!}">
                        <img src="{!! $topPost->getCover('optimize') !!}">
                        <h3>{!! $topPost->present()->suitedTitle() !!}</h3>
                        <p>{!! $topPost->excerpt !!}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>

        <ul class="currency-list focus-currency-list col-md-7 col-lg-7 col-xs-12 col-sm-12">
            @foreach($otherPosts as $otherPost)
            <li class="item">
                <a class="title" href="{!! $otherPost->present()->getUrl() !!}" title="{!! $otherPost->title !!}">{!! $otherPost->present()->suitedTitle() !!}</a>
                <div class="time" title="{!! $otherPost->published_at !!}">{!! $otherPost->published_at->diffForHumans() !!}</div>
            </li>
            @endforeach
        </ul>
    </div>
</div>