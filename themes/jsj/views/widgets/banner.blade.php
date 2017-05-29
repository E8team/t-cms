@push('js')
<script type="text/javascript">
    // 轮播图
    var $banner = $("#banner");
    $banner.slick({
        dots: true,
        infinite: true,
        centerMode: true,
        variableWidth: true,
        slidesToShow: 3,
        slidesToScroll: 3
    });
    $banner.on('afterChange',function(event, slick, currentSlide){
        var $currentText = $banner.find('.slick-current p.text');
        $currentText.css('display', 'block');
        $currentText.animate({
            opacity: .65,
            'margin-left': 130
        }, 300)
    })
    $banner.on('beforeChange', function(event, slick, currentSlide, nextSlide){
        var $currentText = $banner.find('.slick-current p.text');
        $currentText.animate({
            opacity: 0,
            'margin-left': 0
        }, 300, function () {
            $currentText.css('display', 'none');
        })
    });
</script>
@endpush
<section id="banner" class="slider">
    <div>
        <img src="http://www.pku.edu.cn/images/content/2017-05/20170524123828405775.jpg">
        <p class="text">百廿北大 因你而新：北大2017年校园开放日暨“引领未来”本科生招生咨询会举行0</p>
    </div>
    <div>
        <img src="http://www.pku.edu.cn/images/content/2017-05/20170514192853790577.jpg">
        <p class="text">百廿北大 因你而新：北大2017年校园开放日暨“引领未来”本科生招生咨询会举行1</p>
    </div>
    <div>
        <img src="http://www.pku.edu.cn/images/content/2017-05/20170529133458089409.jpg">
        <p class="text">百廿北大 因你而新：北大2017年校园开放日暨“引领未来”本科生招生咨询会举行2</p>
    </div>
    <div>
        <img src="http://www.pku.edu.cn/images/content/2017-05/20170522101204651052.jpg">
        <p class="text">百廿北大 因你而新：北大2017年校园开放日暨“引领未来”本科生招生咨询会举行3</p>
    </div>
</section>