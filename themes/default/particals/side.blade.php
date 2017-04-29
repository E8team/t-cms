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
<div class="side col-lg-3 col-md-3 hidden-sm hidden-xs">
    <div id="side" class="side_body">
        <div class="panel">
            <div class="title">
                热门文章
            </div>
            <div class="panel-body">
                <div class="media media-number">
                    <div class="media-left">
                        <span class="num">1</span>
                    </div>
                    <div class="media-body">
                        <a class="link-dark" href="#" title="UI设计常用字体规范">UI设计常用字体规范...</a>
                    </div>
                </div>
                <div class="media media-number">
                    <div class="media-left">
                        <span class="num">2</span>
                    </div>
                    <div class="media-body">
                        <a class="link-dark" href="#" title="APP界面切图命名和文件整理规范">APP界面切图命名和文..</a>
                    </div>
                </div>
                <div class="media media-number">
                    <div class="media-left">
                        <span class="num">3</span>
                    </div>
                    <div class="media-body">
                        <a class="link-dark" href="#" title="如何做一份让工程师泪流满面的标注？">如何一让工程师泪流满面的？...</a>
                    </div>
                </div>
                <div class="media media-number">
                    <div class="media-left">
                        <span class="num">4</span>
                    </div>
                    <div class="media-body">
                        <a class="link-dark" href="#" title="Material Design 「底部导航栏」设计规范解析">Material Design 「底部导...</a>
                    </div>
                </div>
                <div class="media media-number">
                    <div class="media-left">
                        <span class="num">5</span>
                    </div>
                    <div class="media-body">
                        <a class="link-dark" href="#" title="教你iOS APP设计一稿支持iPhone5/iPhone6/Plus">教你iOS APP设计一稿支持iPhon...</a>
                    </div>
                </div>
                <div class="media media-number">
                    <div class="media-left">
                        <span class="num">6</span>
                    </div>
                    <div class="media-body">
                        <a class="link-dark" href="#" title="移动H5页面设计的那些事">移动H5页面设计的那些事...</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>