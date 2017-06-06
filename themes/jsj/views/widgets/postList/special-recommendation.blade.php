{{--首页专题推荐板块--}}
@php
    if($posts->isEmpty()) return;
    $topPost = $posts->where('top', '!==', null)->first();
    if(is_null($topPost))
        $topPost = $posts->first();
    $otherPosts = $posts->where('id', '!==', $topPost->id);
@endphp
<div class="special">
    <div class="container">
        <h3 class="title">{!! $category->cate_name !!}</h3>
        <div class="body">
            <div class="top_special">
                <a href="{!! $topPost->present()->getUrl() !!}" title="{!! $topPost->title !!}">
                    <div class="image">
                        <img lazy src="{!! $topPost->getCover('optimize') !!}" alt="{!! $topPost->title !!}">
                    </div>
                    <div class="footer">
                        <h4>{!! $topPost->present()->suitedTitle(30) !!}</h4>
                        <p>{!! $topPost->excerpt !!}</p>
                    </div>
                </a>
            </div>
            <ul class="special-list">
                @foreach($otherPosts as $otherPost)
                <li>
                    <div class="detail">
                        <a class="title" href="{!! $otherPost->present()->getUrl() !!}" title="{!! $otherPost->title !!}">{!! $otherPost->present()->suitedTitle() !!}</a>
                        <p>{!! $otherPost->excerpt !!}</p>
                    </div>
                    <a lazy class="image" href="{!! $otherPost->present()->getUrl() !!}" title="{!! $otherPost->title !!}">
                        <img lazy src="{!! $otherPost->getCover('optimize') !!}" alt="{!! $otherPost->title !!}">
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="mask"></div>
</div>