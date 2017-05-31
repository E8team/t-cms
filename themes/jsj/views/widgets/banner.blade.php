@push('js')
<script type="text/javascript">
    // 轮播图
    $(function () {
        var $banner = $("#banner");
        $banner.slick({
            dots: true,
            infinite: true,
            centerMode: true,
            variableWidth: true,
            autoplay: true,
            autoplaySpeed: 5000,
            slidesToShow: 3,
            slidesToScroll: 3,
            arrows: false
        });
        $banner.on('afterChange',function(event, slick, currentSlide){
            showCurrent();
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
        function showCurrent() {
            var $currentText = $banner.find('.slick-current p.text');
            $currentText.css('display', 'block');
            $currentText.animate({
                opacity: .65,
                'margin-left': 130
            }, 300)
        }
        showCurrent();
    })
</script>
@endpush
<section id="banner" class="slider">
    @foreach($banners as $banner)
        <div>
            <a href="{{ $banner->url }}" target="_blank" title="{{ $banner->title }}">
                <img lazy src="{{ $banner->getPictureUrl('optimize') }}">
            </a>
            <p class="text">{{ $banner->title }}</p>
        </div>
    @endforeach
        @foreach($banners as $banner)
            <div>
                <a href="{{ $banner->url }}" target="_blank" {{ $banner->title }}>
                    <img lazy src="{{ $banner->getPictureUrl('optimize') }}">
                </a>
                <p class="text">{{ $banner->title }}</p>
            </div>
        @endforeach
</section>