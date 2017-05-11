@push('js')
    <script>
        $(function () {
            var $side = $('#side');
            var $main = $('.content_main');
            var sideTop = 190;
            $(document).scroll(function(){
                if($(document).scrollTop() >= sideTop){
                    $side.css('position', 'fixed');
                    $side.css('right', $main.offset().left);
                }else{
                    $side.css('position', 'absolute');
                    $side.css('right', '0px');
                }
            })
        })
    </script>
@endpush
@inject('navigation', 'App\T\Navigation\Navigation')
<div id="side" class="side hidden-xs hidden-sm">
    <h4>热门文章</h4>
    <ul class="related_article">
        @foreach($navigation->getActiveNav()->getHotPosts(11, $thisPost) as $post)
            <li><a href="{!! $post->present()->getUrl() !!}" title="{!! $post->title !!}">{!! $post->present()->suitedTitle(29) !!}</a></li>
        @endforeach
    </ul>
</div>