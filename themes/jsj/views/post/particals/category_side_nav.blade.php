@inject('navigation', 'App\T\Navigation\Navigation')
<div class="nav_menu col-md-3 col-lg-3">
    <ul>
        <li @if($navigation->getTopNav()->equals($navigation->getActiveNav()))class="active"@endif>
            <span class="pendant"></span>
            <a{!! $navigation->getTopNav()->present()->aProperty !!}>{!! $navigation->getTopNav()->cate_name !!}</a>
            <span class="arrow glyphicon glyphicon-chevron-right"></span>
        </li>
        @foreach($navigation->getChildrenNav() as $childNav)
            <li @if($childNav->equals($navigation->getActiveNav()))class="active"@endif>
                <span class="pendant"></span>
                <a{!! $childNav->present()->aProperty !!}>{!! $childNav->cate_name !!}</a>
                <span class="arrow glyphicon glyphicon-chevron-right"></span>
            </li>
        @endforeach
    </ul>
</div>