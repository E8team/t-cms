@push('js')
<script type="text/javascript">
    $(function () {
        var $side = $('#side');
        var $sideWrapper = $('.side');
        var $main = $('.main');
        var sideTop = $side.offset().top;
        $(window).resize(function(){
            $side.css('right', $main.offset().left);
            $side.css('width', $sideWrapper.width());
        });
        $(document).scroll(function(){
            if($(document).scrollTop() >= sideTop){
                $side.css('position', 'fixed');
                $side.css('right', $main.offset().left);
                $side.css('top', '10px');
                $side.css('width', $sideWrapper.width());
            }else{
                $side.css('position', 'static');
            }
        })
   })
</script>
@endpush
@inject('navigation', 'App\T\Navigation\Navigation')

<div class="side col-lg-3 col-md-3 hidden-sm hidden-xs">
    <div id="side" class="side_body">
        <div class="panel">
            <div class="title">
                热门文章
            </div>
            <div class="panel-body">
                @foreach($navigation->getActiveNav()->getHotPosts(10) as $post)
                    <div class="media media-number">
                        <div class="media-left">
                            <span class="num">{!! $loop->iteration !!}</span>
                        </div>
                        <div class="media-body">
                            <a class="link-dark" href="{!! $post->present()->getUrl() !!}" title="{!! $post->title !!}">{!! $post->present()->suitedTitle(29) !!}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>