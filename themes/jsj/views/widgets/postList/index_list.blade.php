<div class="news-panel col-xs-12 col-sm-12 col-md-4 col-lg-4">
    <div class="header">
        <h3>{!! $category->cate_name !!}</h3>
        <a class="more"{!! $category->present()->aProperty() !!}>更多</a>
    </div>
    <div class="body">
        <ul class="currency-list">
            @foreach($posts as $post)
            <li class="item @if($loop->first) open @endif">
                <a class="title" href="{!! $post->present()->getUrl() !!}" title="{!! $post->title !!}">{!! $post->present()->suitedTitle() !!}</a>
                <div class="info">
                    @if(!is_null($post->cover))
                    <a class="image" href="{!! $post->present()->getUrl() !!}">
                        <img lazy src="{!! $post->getCover('cover_sm') !!}" alt="{!! $post->title !!}">
                    </a>
                    @endif
                    <a href="{!! $post->present()->getUrl() !!}" @if(!is_null($post->cover))class="has-cover"@endif>{!! $post->excerpt !!}</a>
                </div>
                <div class="time">{!! $post->published_at->diffForHumans() !!}</div>
            </li>
            @endforeach
                @foreach($posts as $post)
                    <li class="item">
                        <a class="title" href="{!! $post->present()->getUrl() !!}" title="{!! $post->title !!}">{!! $post->present()->suitedTitle() !!}</a>
                        <div class="info">
                            @if(!is_null($post->cover))
                                <a class="image" href="{!! $post->present()->getUrl() !!}">
                                    <img lazy src="{!! $post->getCover('cover_sm') !!}" alt="{!! $post->title !!}">
                                </a>
                            @endif
                            <a href="{!! $post->present()->getUrl() !!}" @if(!is_null($post->cover))class="has-cover"@endif>{!! $post->excerpt !!}</a>
                        </div>
                        <div class="time">{!! $post->published_at->diffForHumans() !!}</div>
                    </li>
                @endforeach
        </ul>
    </div>
</div>