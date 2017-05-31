{{--通知公告--}}
@push('js')
<script type="text/javascript">
    $(function (){
        var $notice = $('#notice');
        setInterval(function () {
            $notice.append($notice.children().first());
            $notice.animate({
                top: '-90px'
            }, 300, function () {
                $notice.css('top', 0);
            })
        }, 3000)
    });
</script>
@endpush
<div class="news-panel col-xs-12 col-sm-12 col-md-4 col-lg-4 notice">
    <div class="header">
        <h3>{!! $category->cate_name !!}</h3>
        <a class="more" {!! $category->present()->aProperty() !!}>更多</a>
    </div>
    <div class="body">
        <ul id="notice" class="notice-list">
            @foreach($posts as $post)
                <li>
                    <div class="notice-time">
                        <div class="day">{!! $post->published_at->day !!}</div>
                        <div class="month">{!! $post->published_at->month !!}月</div>
                    </div>
                    <div class="title">
                        <a href="{!! $post->present()->getUrl() !!}" title="{!! $post->title !!}">{!! $post->present()->suitedTitle() !!}</a>
                        <span class="author">{!! isset($post->user->nick_name)?$post->user->nick_name:$post->user->user_name !!}</span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>