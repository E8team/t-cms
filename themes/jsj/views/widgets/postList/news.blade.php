{{--学院要闻模块--}}
@php
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
                @forelse($topPosts as $topPost)
                <div class="top-carousel-item">
                    <a target="_blank" href="{!! $topPost->present()->getUrl() !!}" title="{!! $topPost->title !!}">
                        <img src="{!! $topPost->getCover('optimize') !!}">
                        <h3>{!! $topPost->present()->suitedTitle(32) !!}</h3>
                        <p>{!! $topPost->excerpt !!}</p>
                    </a>
                </div>
                @empty
                    暂无内容
                @endforelse
            </div>
        </div>

        <ul class="currency-list focus-currency-list col-md-7 col-lg-7 col-xs-12 col-sm-12">
            @forelse($otherPosts as $otherPost)
            <li class="item">
                <a class="title" target="_blank" href="{!! $otherPost->present()->getUrl() !!}" title="{!! $otherPost->title !!}">{!! $otherPost->present()->suitedTitle(38) !!}</a>
                <div class="time" title="{!! $otherPost->published_at !!}">{!! $otherPost->published_at->diffForHumans() !!}</div>
            </li>
                @empty
                <li>暂无内容</li>
            @endforelse
        </ul>
    </div>
</div>