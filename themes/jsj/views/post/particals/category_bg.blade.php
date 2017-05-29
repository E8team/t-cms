@inject('navigation', 'App\T\Navigation\Navigation')
<div class="page-bg" style="background-image: url('{!! asset('static/jsj/images/page-bg-'.rand(1,4).'.png') !!}')">
    <div class="title">
        <div class="mask"></div>
        <h2>{!! $navigation->getTopNav()->cate_name !!}</h2>
    </div>
</div>