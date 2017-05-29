@inject('navigation', 'App\T\Navigation\Navigation')
@push('js')
<script type="text/javascript">
    $(function () {
        var $pageBg = $('#page-bg');
        $pageBg.fadeIn(300);
    })
</script>
@endpush
<div class="page-bg-wrapper">
    <div id="page-bg" class="page-bg" style="background-image: url('{!! asset('static/jsj/images/page-bg-'.rand(1,4).'.png') !!}')">
        <div class="title">
            <div class="mask"></div>
            <h2>{!! $navigation->getTopNav()->cate_name !!}</h2>
        </div>
    </div>
</div>