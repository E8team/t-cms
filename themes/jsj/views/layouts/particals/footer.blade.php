<div class="about">
    <div class="container">
        <img class="footer-logo" src="{!! asset('static/jsj/images/footer-logo.png') !!}" alt="">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <ul class="footer-nav">
                @foreach(Facades\App\T\Navigation\Navigation::getAllNavFromCache()->take(9) as $nav)
                    <li><a{!! $nav->present()->aProperty(false) !!}>{!! $nav->cate_name !!}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"></div>
    </div>
</div>
<div class="footer-copy">
    Copyright © 2017 <a href="http://e8net.cn" target="_blank">E8net</a>.  powered by <a target="_blank" href="https://github.com/3tnet/t-cms">t-cms</a>
    <span rel="show-github" data-user="3tnet" data-repo="t-cms"></span>
</div>