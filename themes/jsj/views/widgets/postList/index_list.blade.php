<div class="news-panel col-xs-12 col-sm-12 col-md-4 col-lg-4">
    <div class="header">
        <h3>{!! $category->cate_name !!}</h3>
        <a class="more"{!! $category->present()->aProperty(true) !!}>更多</a>
    </div>
    <div class="body">
        <ul class="currency-list">
            @forelse($posts as $post)
            <li class="item @if($loop->first) open @endif">
                <a target="_blank" class="title" href="{!! $post->present()->getUrl() !!}" title="{!! $post->title !!}">{!! $post->present()->suitedTitle(30) !!}</a>
                <div class="info">
                    @if(!is_null($post->cover))
                    <a target="_blank" class="image" href="{!! $post->present()->getUrl() !!}">
                        <img lazy src="{!! $post->getCover('cover_sm') !!}" alt="{!! $post->title !!}">
                    </a>
                    @endif
                    <a href="{!! $post->present()->getUrl() !!}" @if(!is_null($post->cover))class="has-cover"@endif>{!! $post->excerpt !!}</a>
                </div>
                <div class="time" title="{!! $post->published_at !!}">{!! $post->published_at->diffForHumans() !!}</div>
            </li>
                @empty
                <li>暂无内容</li>
            @endforelse
        </ul>
    </div>
</div>